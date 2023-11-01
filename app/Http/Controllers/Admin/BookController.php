<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreOrUpdateBookRequest;
use App\Models\Book;
use Brian2694\Toastr\Facades\Toastr;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;


class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $books = Book::latest()->paginate(10);
        return view('admin.books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        return view('admin.books.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrUpdateBookRequest $request) {
        try{
            $book = $this->createOrUpdate($request);
            Toastr::success('Book has been added!', 'Success!');
            return response()->json(['success' => true, 'redirectUrl' => route('books.index')]);
        }catch (Exception $e) {
            Log::error($e);
            return response()->json(['success' => false]);
        }
    }

    public function createOrUpdate($request, $book = null) {
        $input = $request->all();
        $path = Book::STORAGE_PATH;
        if(!empty($request->image) && $request->file('image')->isValid()) {
            if(!empty($book->image) && \File::exists(public_path($path .$book->image))){
                \File::delete(public_path($path .$book->image));
            }
            if (!file_exists($path)) {
                mkdir($path, 0755, true); // Create the directory with necessary permissions
            }
            $fileName = strtotime(now()) ."-". $request->image->getClientOriginalName();
            $file = $request->image->move($path, $fileName);
            $input['image'] = $fileName;
        }
        $book = Book::updateOrCreate(['id' => ($book) ? $book->id : null], $input);

        return $book;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book) {
        return view('admin.books.form', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreOrUpdateBookRequest $request, Book $book) {
        try{
            $book = $this->createOrUpdate($request, $book);
            Toastr::success('Book has been added!', 'Success!');
            return response()->json(['success' => true, 'redirectUrl' => route('books.index')]);
        }catch (Exception $e) {
            Log::error($e);
            return response()->json(['success' => false]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book) {
        $book->delete();
        Toastr::success('Book has been deleted!', 'Success!');

        return redirect(route('books.index'));
    }

    public function frontPage() {
        return view('front.books.index');
    }
}

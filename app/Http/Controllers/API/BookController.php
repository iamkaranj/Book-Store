<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrUpdateBookRequest;
use App\Models\Book;
use Brian2694\Toastr\Facades\Toastr;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BookController extends Controller
{

    public function frontPageApi(Request $request) {
        $query = Book::search($request->title ?? null);

        if (!empty($request->author)) {
            $query->where('author', $request->input('author'));
        }
        if (!empty($request->isbn)) {
            $query->where('isbn', $request->input('isbn'));
        }
        if (!empty($request->publisher)) {
            $query->where('publisher', $request->input('publisher'));
        }
        // dd($query->first());
        $books = $query->paginate(12);
        return response()->json($books);
    }

    public function getDropdownData(Request $request) {
        $books = Book::select(['author', 'publisher', 'genre'])
        ->distinct()
        ->get()->toArray();
        $data['authors'] = array_column($books, 'author');
        $data['genre'] = array_column($books, 'genre');
        $data['publishers'] = array_column($books, 'publisher');
        return response()->json($data);
    }


}

@extends('adminlte::page')

@section('css')
    <style>
        #selectedImage {
            height: 250px;
            margin-top: 10px;
        }
    </style>
@endsection

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header border-transparent">
                    <h3 class="card-title">Books List</h3>
                    <div class="card-tools">
                        <a href="{{ route('books.create') }}" class="btn btn-sm btn-info float-left">Add New Book</a>
                    </div>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table m-0">
                            <thead>
                                <tr>
                                    <th>title</th>
                                    <th>author</th>
                                    <th>genre</th>
                                    <th>isbn</th>
                                    <th>published</th>
                                    <th>publisher</th>
                                    <th>action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($books as $book)
                                    <tr>
                                        <td>{{ $book->title }}</a></td>
                                        <td>{{ $book->author }}</td>
                                        <td><span class="badge badge-success">{{ $book->genre }}</span></td>
                                        <td>{{ $book->isbn }}</td>
                                        <td>{{ $book->published }}</td>
                                        <td>{{ $book->publisher }}</td>
                                        <td>
                                            <!-- Edit icon with a link to edit route -->
                                            <a href="{{ route('books.edit', $book) }}" class="btn btn-sm btn-primary">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>

                                            <!-- Delete icon with a form for delete action -->
                                            <form action="{{ route('books.destroy', $book) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                                    <i class="fas fa-trash"></i> Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    {{ $books->links('pagination::bootstrap-4') }} <!-- Display pagination links -->
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
    {!! Toastr::message() !!}
@stop

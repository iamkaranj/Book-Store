@extends('adminlte::page')

@section('css')
<!-- Include Bootstrap CSS (optional if not already included) -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

<!-- Include datetimepicker CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/css/tempusdominus-bootstrap-4.min.css">

<style>
    #selectedImage {
        height: 250px;
        margin-top: 10px;
    }
</style>
@endsection

@section('content')
    <section class="container">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Book Details</h3>
                </div>
                <div class="card-body">
                    @php
                        if(!empty($book)) {
                            $actionUrl = route('books.update', ['book' => $book->id]);
                            $methodField = method_field('PUT');
                        } else {
                            $actionUrl = route('books.store');
                            $methodField = method_field('POST');
                        }
                    @endphp
                    <form id="bookForm" action="{{ $actionUrl }}" method="POST" enctype="multipart/form-data">
                        {{ $methodField }}
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" id="title" name="title" value="{{ $book->title ?? null }}" placeholder="First Name">
                            </div>
                            <div class="form-group col-md-6 ">
                                <label for="author">Author</label>
                                <input type="text" class="form-control" id="author" name="author" value="{{ $book->author ?? null }}" placeholder="Author">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="genre">Genre</label>
                                <input type="text" class="form-control" id="genre" name="genre" value="{{ $book->genre ?? null}}" placeholder="Genre">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="isbn">isbn</label>
                                <input type="text" class="form-control" id="isbn" name="isbn" value="{{ $book->isbn ?? null }}" placeholder="isbn">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="publisher">Publisher</label>
                                <input type="text" class="form-control" id="publisher" name="publisher" value="{{ $book->publisher ?? null }}" placeholder="Publisher">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="datepicker">Date of Birth</label>
                                <div class="input-group date" id="datepicker" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" data-target="#datepicker" name="published" value="{{ $book->published ?? null }}">
                                    <div class="input-group-append" data-target="#datepicker" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="far fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" name="description" placeholder="Description" rows="10">{{ $book->description ?? null}}</textarea>
                            </div>

                            <div class="form-group col-md-12">
                                <label for="image">Image</label>
                                 <!-- Image preview container -->
                                <div id="imagePreview">
                                    <img id="selectedImage" src="{{ $book->image_url ?? asset('images/thumbnail.png') }}" alt="Selected Image">
                                </div>
                                <input type="file" class="form-control" id="imageInput" name="image" placeholder="Image">
                            </div>

                            <div class="col-12 text-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
<!-- Include jQuery (required) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Include moment.js (required for datetimepicker) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

<!-- Include Bootstrap JavaScript (required for datetimepicker) -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

<!-- Include datetimepicker JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/js/tempusdominus-bootstrap-4.min.js"></script>

<script src="{{ asset('js/books.js') }}"></script>
@stop

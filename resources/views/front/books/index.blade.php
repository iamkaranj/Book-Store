@extends('layouts.app')

@push('css')
    @vite('resources/css/app.css')
@endpush
@section('content')
    <div id="app">
        <book-list></book-list>
    </div>
@endsection

@push('scripts')
    @vite('resources/js/app.js')
@endpush

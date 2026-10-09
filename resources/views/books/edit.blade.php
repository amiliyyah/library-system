@extends('layouts.app')

@section('content')
    <h1>Edit Buku</h1>

    <form action="{{ route('books.update', $book) }}" method="POST">
        @csrf
        @method('PUT')
        <input type="text" name="title" value="{{ $book->title }}"><br>
        <input type="text" name="author" value="{{ $book->author }}"><br>
        <input type="number" name="year" value="{{ $book->year }}"><br>
        <input type="number" name="stock" value="{{ $book->stock }}"><br>
        <button type="submit">Update</button>
    </form>

    <a href="{{ route('books.index') }}">Kembali</a>
@endsection
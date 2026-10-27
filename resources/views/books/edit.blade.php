@extends('layouts.app')

@section('content')
    <style>
        form div { margin-bottom: 16px; }
        form label { display: block; margin-bottom: 4px; font-weight: bold; }
        form input, form select { width: 300px; padding: 6px; }
        form p { margin: 4px 0 0; font-size: 14px; }
        form button { padding: 6px 16px; margin-top: 4px; }
    </style>

    <h1>Edit Buku</h1>

    <form action="{{ route('books.update', $book) }}" method="POST" novalidate>
        @csrf
        @method('PUT')

        <div>
            <label for="title">Judul Buku</label>
            <input type="text" id="title" name="title" value="{{ old('title', $book->title) }}">
            @error('title')
                <p style="color:red">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="author">Penulis</label>
            <input type="text" id="author" name="author" value="{{ old('author', $book->author) }}">
            @error('author')
                <p style="color:red">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="year">Tahun Terbit</label>
            <input type="text" id="year" name="year" value="{{ old('year', $book->year) }}">
            @error('year')
                <p style="color:red">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="stock">Stok</label>
            <input type="text" id="stock" name="stock" value="{{ old('stock', $book->stock) }}">
            @error('stock')
                <p style="color:red">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="category_id">Kategori</label>
            <select name="category_id" id="category_id">
                <option value="">Pilih kategori</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @selected(old('category_id', $book->category_id) == $category->id)>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <p style="color:red">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit">Perbarui</button>
    </form>

    <a href="{{ route('books.index') }}">Kembali</a>
@endsection
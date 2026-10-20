@extends('layouts.app')

@section('content')
    <style>
        form div { margin-bottom: 16px; }
        form label { display: block; margin-bottom: 4px; font-weight: bold; }
        form input { width: 300px; padding: 6px; }
        form p { margin: 4px 0 0; font-size: 14px; }
        form button { padding: 6px 16px; margin-top: 4px; }
    </style>

    <h1>Tambah Buku</h1>

    <form action="{{ route('books.store') }}" method="POST" novalidate>
        @csrf

        <div>
            <label for="title">Judul Buku</label>
            <input type="text" id="title" name="title" value="{{ old('title') }}" placeholder="Judul">
            @error('title')
                <p style="color:red">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="author">Penulis</label>
            <input type="text" id="author" name="author" value="{{ old('author') }}" placeholder="Penulis">
            @error('author')
                <p style="color:red">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="year">Tahun Terbit</label>
            <input type="text" id="year" name="year" value="{{ old('year') }}" placeholder="Tahun">
            @error('year')
                <p style="color:red">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="stock">Stok</label>
            <input type="text" id="stock" name="stock" value="{{ old('stock') }}" placeholder="Stok">
            @error('stock')
                <p style="color:red">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit">Simpan</button>
    </form>

    <a href="{{ route('books.index') }}">Kembali</a>
@endsection
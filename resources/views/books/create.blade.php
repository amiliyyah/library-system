@extends('layouts.app')

@section('content')
    <h1>Tambah Buku</h1>

    <form action="{{ route('books.store') }}" method="POST">
        @csrf
        <input type="text" name="title" placeholder="Judul"><br>
        <input type="text" name="author" placeholder="Penulis"><br>
        <input type="number" name="year" placeholder="Tahun"><br>
        <input type="number" name="stock" placeholder="Stok"><br>
        <button type="submit">Simpan</button>
    </form>

    <a href="{{ route('books.index') }}">Kembali</a>
@endsection
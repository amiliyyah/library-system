@extends('layouts.app')

@section('title', 'Detail Buku')

@section('content')
    <h2>Detail Buku</h2>
    <p>ID Buku: {{ $book->id }}</p>
    <p>Judul: {{ $book->title }}</p>
    <p>Penulis: {{ $book->author }}</p>
    <p>Tahun: {{ $book->year }}</p>

    @if($book->stock > 0)
        <p>Stok tersedia: {{ $book->stock }}</p>
    @else
        <p>Stok sedang habis.</p>
    @endif

    <a href="{{ route('books.index') }}">← Kembali ke Daftar Buku</a>
@endsection
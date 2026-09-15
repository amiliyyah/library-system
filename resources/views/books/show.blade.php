@extends('layouts.app')

@section('title', 'Detail Buku')

@section('content')
    <h2>Detail Buku</h2>
    <p>ID Buku: {{ $id }}</p>

    @if($stock > 0)
        <p>Stok tersedia: {{ $stock }}</p>
    @else
        <p>Stok sedang habis.</p>
    @endif

    <a href="/books">← Kembali ke Daftar Buku</a>
@endsection
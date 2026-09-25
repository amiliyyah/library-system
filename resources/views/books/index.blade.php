@extends('layouts.app')

@section('title', 'Daftar Buku')

@section('content')
    <h2>Daftar Buku</h2>
    <ul>
        @foreach($books as $book)
            <li>
                <strong>{{ $book->title }}</strong>
                — {{ $book->author }} ({{ $book->year }})
                | Stok: {{ $book->stock }}
                | <a href="/books/{{ $book->id }}">Lihat Detail</a>
            </li>
        @endforeach
    </ul>
@endsection
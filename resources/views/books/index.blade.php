@extends('layouts.app')

@section('content')
    <h1>{{ $title }}</h1>
    <h2>Daftar Buku</h2>

    <a href="{{ route('books.create') }}">+ Tambah Buku</a>

    <ul>
        @foreach($books as $book)
            <li>
                <strong>{{ $book->title }}</strong>
                — {{ $book->author }} ({{ $book->year }})
                | Stok: {{ $book->stock }}
                | <a href="{{ route('books.show', $book) }}">Lihat Detail</a>
                | <a href="{{ route('books.edit', $book) }}">Edit</a>
                |
                <form action="{{ route('books.destroy', $book) }}" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Hapus</button>
                </form>
            </li>
        @endforeach
    </ul>
@endsection
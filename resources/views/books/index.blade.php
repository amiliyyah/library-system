@extends('layouts.app')

@section('title', $title)

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h3>Daftar Buku</h3>
    @can('manage-master')
        <a href="{{ route('books.create') }}" class="btn btn-primary">+ Tambah Buku</a>
    @endcan
</div>

<table class="table table-bordered bg-white align-middle">
    <thead class="table-dark">
        <tr>
            <th>#</th><th>Judul</th><th>Penulis</th><th>Tahun</th>
            <th>Stok</th><th>Kategori</th><th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($books as $book)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $book->title }}</td>
                <td>{{ $book->author }}</td>
                <td>{{ $book->year }}</td>
                <td><strong>{{ $book->stock }}</strong></td>
                <td>{{ $book->category?->name ?? 'Belum ada kategori' }}</td>
                <td>
                    <a href="{{ route('books.show', $book) }}" class="btn btn-sm btn-info">Detail</a>
                    @can('manage-master')
                        <a href="{{ route('books.edit', $book) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('books.destroy', $book) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Hapus buku ini?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    @endcan
                </td>
            </tr>
        @empty
            <tr><td colspan="7" class="text-center">Belum ada buku.</td></tr>
        @endforelse
    </tbody>
</table>
@endsection
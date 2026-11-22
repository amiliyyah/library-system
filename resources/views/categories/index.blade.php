@extends('layouts.app')

@section('title', 'Kategori')

@section('content')
<h3>Daftar Kategori</h3>

<table class="table table-bordered bg-white">
    <thead class="table-dark">
        <tr><th>#</th><th>Nama Kategori</th><th>Jumlah Buku</th></tr>
    </thead>
    <tbody>
        @forelse ($categories as $c)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $c->name }}</td>
                <td>{{ $c->books_count }}</td>
            </tr>
        @empty
            <tr><td colspan="3" class="text-center">Belum ada kategori.</td></tr>
        @endforelse
    </tbody>
</table>
@endsection
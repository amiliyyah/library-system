@extends('layouts.app')

@section('title', 'Detail Peminjaman')

@section('content')
<h3>Detail Peminjaman #{{ $borrowing->id }}</h3>

<table class="table table-bordered bg-white w-50">
    <tr><th>Anggota</th><td>{{ $borrowing->member->name }} ({{ $borrowing->member->member_code }})</td></tr>
    <tr><th>Petugas</th><td>{{ $borrowing->user->name }}</td></tr>
    <tr><th>Tanggal Pinjam</th><td>{{ $borrowing->borrowing_date }}</td></tr>
    <tr><th>Jatuh Tempo</th><td>{{ $borrowing->due_date }}</td></tr>
    <tr><th>Tanggal Kembali</th><td>{{ $borrowing->return_date ?? '-' }}</td></tr>
    <tr><th>Status</th><td>{{ $borrowing->status }}</td></tr>
</table>

<h5>Buku yang dipinjam</h5>
<table class="table table-bordered bg-white w-50">
    <thead class="table-dark"><tr><th>Judul</th><th>Jumlah</th></tr></thead>
    <tbody>
        @foreach ($borrowing->details as $d)
            <tr><td>{{ $d->book->title }}</td><td>{{ $d->quantity }}</td></tr>
        @endforeach
    </tbody>
</table>

<a href="{{ route('borrowings.index') }}" class="btn btn-secondary">Kembali</a>
@endsection
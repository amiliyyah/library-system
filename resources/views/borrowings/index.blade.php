@extends('layouts.app')

@section('title', 'Peminjaman')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h3>Transaksi Peminjaman</h3>
    <a href="{{ route('borrowings.create') }}" class="btn btn-primary">+ Peminjaman Baru</a>
</div>

<table class="table table-bordered bg-white align-middle">
    <thead class="table-dark">
        <tr>
            <th>#</th><th>Anggota</th><th>Petugas</th><th>Buku</th>
            <th>Tgl Pinjam</th><th>Jatuh Tempo</th><th>Tgl Kembali</th><th>Status</th><th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($borrowings as $b)
            <tr>
                <td>{{ $borrowings->firstItem() + $loop->index }}</td>
                <td>{{ $b->member->name }}</td>
                <td>{{ $b->user->name }}</td>
                <td>
                    @foreach ($b->details as $d)
                        {{ $d->book->title }} ({{ $d->quantity }})<br>
                    @endforeach
                </td>
                <td>{{ $b->borrowing_date }}</td>
                <td>{{ $b->due_date }}</td>
                <td>{{ $b->return_date ?? '-' }}</td>
                <td>
                    @if ($b->status === 'borrowed')
                        <span class="badge bg-warning text-dark">Dipinjam</span>
                    @else
                        <span class="badge bg-success">Dikembalikan</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('borrowings.show', $b) }}" class="btn btn-sm btn-info">Detail</a>
                    @if ($b->status === 'borrowed')
                        <form action="{{ route('borrowings.return', $b) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Proses pengembalian buku?')">
                            @csrf @method('PATCH')
                            <button class="btn btn-sm btn-success">Kembalikan</button>
                        </form>
                    @endif
                </td>
            </tr>
        @empty
            <tr><td colspan="9" class="text-center">Belum ada transaksi.</td></tr>
        @endforelse
    </tbody>
</table>

{{ $borrowings->links() }}
@endsection
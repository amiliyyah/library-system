@extends('layouts.app')

@section('title', 'Data Anggota')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h3>Data Anggota</h3>
    <a href="{{ route('members.create') }}" class="btn btn-primary">+ Tambah Anggota</a>
</div>

<table class="table table-bordered bg-white">
    <thead class="table-dark">
        <tr><th>#</th><th>Kode</th><th>Nama</th><th>Telepon</th><th>Alamat</th><th>Aksi</th></tr>
    </thead>
    <tbody>
        @forelse ($members as $m)
            <tr>
                <td>{{ $members->firstItem() + $loop->index }}</td>
                <td>{{ $m->member_code }}</td>
                <td>{{ $m->name }}</td>
                <td>{{ $m->phone }}</td>
                <td>{{ $m->address }}</td>
                <td>
                    <a href="{{ route('members.edit', $m) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('members.destroy', $m) }}" method="POST" class="d-inline"
                          onsubmit="return confirm('Hapus anggota ini?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="6" class="text-center">Belum ada anggota.</td></tr>
        @endforelse
    </tbody>
</table>

{{ $members->links() }}
@endsection
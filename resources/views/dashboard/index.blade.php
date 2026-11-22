@extends('layouts.app')

@section('title', $title)

@section('content')
<h3>{{ $title }}</h3>
<p class="text-muted">{{ $description }}</p>

<div class="row">
    @foreach ([
        'Kategori'            => $totalCategories,
        'Buku'                => $totalBooks,
        'Anggota'             => $totalMembers,
        'Total Peminjaman'    => $totalBorrowings,
        'Peminjaman Berjalan' => $activeBorrowings,
    ] as $label => $value)
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h6 class="text-muted">{{ $label }}</h6>
                    <h2 class="mb-0">{{ $value }}</h2>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection
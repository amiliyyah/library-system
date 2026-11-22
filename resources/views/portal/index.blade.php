@extends('layouts.app')

@section('title', 'Pinjam Buku')

@section('content')
<h3>Pinjam Buku</h3>

<form action="{{ route('portal.borrowings.store') }}" method="POST">
    @csrf

    <label class="form-label">Buku</label>
    <div id="book-rows">
        <div class="row mb-2 book-row">
            <div class="col-md-8">
                <select name="books[0][book_id]" class="form-select">
                    <option value="">-- Pilih Buku --</option>
                    @foreach ($books as $b)
                        <option value="{{ $b->id }}">{{ $b->title }} (stok: {{ $b->stock }})</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <input type="number" name="books[0][quantity]" class="form-control" value="1" min="1">
            </div>
            <div class="col-md-1">
                <button type="button" class="btn btn-outline-danger remove-row">&times;</button>
            </div>
        </div>
    </div>

    <button type="button" class="btn btn-sm btn-secondary mb-3" id="add-row">+ Tambah Buku</button>
    <br>
    <button class="btn btn-primary">Pinjam</button>
    <a href="{{ route('portal.borrowings.index') }}" class="btn btn-secondary">Batal</a>
</form>

<script>
    let idx = 1;
    const rows = document.getElementById('book-rows');

    document.getElementById('add-row').addEventListener('click', () => {
        const clone  = rows.querySelector('.book-row').cloneNode(true);
        const select = clone.querySelector('select');
        const input  = clone.querySelector('input');
        select.name  = `books[${idx}][book_id]`;
        select.value = '';
        input.name   = `books[${idx}][quantity]`;
        input.value  = 1;
        rows.appendChild(clone);
        idx++;
    });

    rows.addEventListener('click', (e) => {
        if (e.target.classList.contains('remove-row') && rows.querySelectorAll('.book-row').length > 1) {
            e.target.closest('.book-row').remove();
        }
    });
</script>
@endsection
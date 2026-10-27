<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with('category')->get();
        $title = 'Perpustakaan';
        return view('books.index', compact('books', 'title'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('books.create', compact('categories'));
    }

    private function bookRules(?int $ignoreId = null): array
    {
        return [
            'title' => [
                'required',
                'string',
                'min:3',
                'max:255',
                Rule::unique('books', 'title')->ignore($ignoreId),
            ],
            'author' => [
                'required',
                'string',
                'min:3',
                'max:255',
                "regex:/^[\pL\s.,'-]+$/u",
            ],
            'year' => [
                'required',
                'integer',
                'min:1900',
                'max:' . date('Y'),
            ],
            'stock' => [
                'required',
                'integer',
                'min:0',
                'max:10000',
            ],
            'category_id' => [
                'required',
                'exists:categories,id',
            ],
        ];
    }

    private function bookMessages(): array
    {
        return [
            'required'      => ':attribute wajib diisi.',
            'string'        => ':attribute harus berupa teks.',
            'integer'       => ':attribute harus berupa bilangan bulat.',
            'title.min'     => 'Judul buku minimal :min karakter.',
            'title.max'     => 'Judul buku maksimal :max karakter.',
            'title.unique'  => 'Judul buku sudah terdaftar.',
            'author.min'    => 'Nama penulis minimal :min karakter.',
            'author.max'    => 'Nama penulis maksimal :max karakter.',
            'author.regex'  => 'Nama penulis hanya boleh berisi huruf, spasi, titik, koma, apostrof, dan tanda hubung.',
            'year.min'      => 'Tahun terbit minimal :min.',
            'year.max'      => 'Tahun terbit tidak boleh lebih dari tahun ini (:max).',
            'stock.min'     => 'Stok tidak boleh negatif.',
            'stock.max'     => 'Stok maksimal :max.',
            'category_id.exists' => 'Kategori yang dipilih tidak tersedia.',
        ];
    }

    private function bookAttributes(): array
    {
        return [
            'title'       => 'Judul buku',
            'author'      => 'Penulis',
            'year'        => 'Tahun terbit',
            'stock'       => 'Stok',
            'category_id' => 'Kategori',
        ];
    }

    public function store(Request $request)
    {
        $validated = $request->validate(
            $this->bookRules(),
            $this->bookMessages(),
            $this->bookAttributes()
        );

        Book::create($validated);

        return redirect()
            ->route('books.index')
            ->with('success', 'Data buku berhasil ditambahkan.');
    }

    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }

    public function edit(Book $book)
    {
        $categories = Category::orderBy('name')->get();
        return view('books.edit', compact('book', 'categories'));
    }

    public function update(Request $request, Book $book)
    {
        $validated = $request->validate(
            $this->bookRules($book->id),
            $this->bookMessages(),
            $this->bookAttributes()
        );

        $book->update($validated);

        return redirect()
            ->route('books.index')
            ->with('success', 'Data buku berhasil diperbarui.');
    }

    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()->route('books.index');
    }
}
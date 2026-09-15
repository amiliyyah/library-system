<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = [
            ['id' => 1, 'judul' => 'Bumi', 'penulis' => 'Tere Liye', 'tahun' => 2014],
            ['id' => 2, 'judul' => 'Seporsi Mie Ayam Sebelum Mati', 'penulis' => 'Brian Khrisna', 'tahun' => 2025],
            ['id' => 3, 'judul' => 'Btuesday with morrie', 'penulis' => 'Mitch Albom', 'tahun' => 1997],
            ['id' => 4, 'judul' => 'Sang Alkemis', 'penulis' => 'Paulo Coelho', 'tahun' => 1998],
            ['id' => 5, 'judul' => 'mindset', 'penulis' => 'Carol S. Dweck', 'tahun' => 2006],
        ];

        return view('books.index', compact('books'));
    }

    public function show($id)
    {
        $stock = $id % 2 == 0 ? 0 : 5;

        return view('books.show', compact('id', 'stock'));
    }
}
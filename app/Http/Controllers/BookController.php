<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = [
            ['id' => 1, 'judul' => 'Pemrograman PHP', 'penulis' => 'Andi Wijaya', 'tahun' => 2020],
            ['id' => 2, 'judul' => 'Laravel untuk Pemula', 'penulis' => 'Budi Santoso', 'tahun' => 2021],
            ['id' => 3, 'judul' => 'Basis Data', 'penulis' => 'Citra Dewi', 'tahun' => 2019],
            ['id' => 4, 'judul' => 'Algoritma dan Pemrograman', 'penulis' => 'Dedi Kurniawan', 'tahun' => 2022],
            ['id' => 5, 'judul' => 'Pemrograman Berorientasi Objek', 'penulis' => 'Eka Putri', 'tahun' => 2018],
        ];

        return view('books.index', compact('books'));
    }

    public function show($id)
    {
        $stock = $id % 2 == 0 ? 0 : 5;

        return view('books.show', compact('id', 'stock'));
    }
}
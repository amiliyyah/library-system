<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::all();

        return view('books.index', compact('books'));
    }

    public function show($id)
    {
        $stock = $id % 2 == 0 ? 0 : 5;

        return view('books.show', compact('id', 'stock'));
    }
}
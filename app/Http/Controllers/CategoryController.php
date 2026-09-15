<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
       $categories = [
        'Fiksi',
        'Motivasi',
        'Pengembangan Diri',
        'Filosofi',
        'Novel Terjemahan',
        ];

        return view('categories.index', compact('categories'));
    }
}

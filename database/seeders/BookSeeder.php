<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Book::create([
            'title' => 'Bumi',
            'author' => 'Tere Liye',
            'year' => 2014,
            'stock' => 5,
        ]);

        Book::create([
            'title' => 'Seporsi Mie Ayam Sebelum Mati',
            'author' => 'Brian Khrisna',
            'year' => 2025,
            'stock' => 3,
        ]);

        Book::create([
            'title' => 'Tuesday with Morrie',
            'author' => 'Mitch Albom',
            'year' => 1997,
            'stock' => 4,
        ]);

        Book::create([
            'title' => 'Sang Alkemis',
            'author' => 'Paulo Coelho',
            'year' => 1998,
            'stock' => 2,
        ]);

        Book::create([
            'title' => 'Mindset',
            'author' => 'Carol S. Dweck',
            'year' => 2006,
            'stock' => 6,
        ]);
    }
}
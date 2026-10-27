<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $names = ['Novel', 'Pengembangan Diri', 'Psikologi', 'Keuangan', 'Nonfiksi', 'Sejarah', 'Pendidikan', 'Komik'];

        Category::whereNotIn('name', $names)
            ->whereDoesntHave('books')
            ->delete();

        foreach ($names as $name) {
            Category::firstOrCreate(['name' => $name]);
        }
    }
}
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
        $categories = [
            ['nama_kategori' => 'Elektronik'],
            ['nama_kategori' => 'Alat Laboratorium'],
            ['nama_kategori' => 'Buku & Referensi'],
            ['nama_kategori' => 'Perlengkapan Umum'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}

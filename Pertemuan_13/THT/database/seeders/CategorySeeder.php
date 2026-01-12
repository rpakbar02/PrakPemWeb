<?php

namespace Database\Seeders;

use App\Models\Category;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'name' => 'IT & Jaringan',
        ]);

        Category::create([
            'name' => 'Kebersihan',
        ]);

        Category::create([
            'name' => 'Fasilitas Kelas',
        ]);
    }
}

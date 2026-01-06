<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
public function run(): void
    {
        $items = [
            [
                'name' => 'Mikroskop',
                'stock' => 5,
                'description' => 'Mikroskop digital untuk penelitian mikrobiologi',
                'kategori_id' => 2
            ],
            [
                'name' => 'Beaker Glass 250ml',
                'stock' => 10,
                'description' => 'Gelas ukur untuk percobaan kimia',
                'kategori_id' => 2
            ],
            [
                'name' => 'Laptop Dell',
                'stock' => 3,
                'description' => 'Laptop untuk praktikum pemrograman',
                'kategori_id' => 1
            ],
            [
                'name' => 'Proyektor',
                'stock' => 1,
                'description' => 'Proyektor untuk presentasi',
                'kategori_id' => 1
            ],
        ];

        foreach ($items as $item) {
            Item::create($item);
        }       
    }
}

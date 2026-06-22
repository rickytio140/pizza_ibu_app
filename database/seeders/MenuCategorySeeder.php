<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['nama' => 'Pizza', 'deskripsi' => 'Aneka Pizza Khas Ibu'],
            ['nama' => 'Minuman', 'deskripsi' => 'Minuman Segar'],
            ['nama' => 'Snack', 'deskripsi' => 'Cemilan Pelengkap'],
        ];

        foreach ($categories as $category) {
            \App\Models\MenuCategory::create($category);
        }
    }
}

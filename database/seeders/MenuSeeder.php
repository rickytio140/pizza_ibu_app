<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $menus = [
            ['menu_category_id' => 1, 'nama' => 'Pizza Meat Lover', 'deskripsi' => 'Sosis, Daging Cincang, Keju', 'harga' => 85000, 'gambar' => ''],
            ['menu_category_id' => 1, 'nama' => 'Pizza Margherita', 'deskripsi' => 'Tomat, Daun Basil, Mozzarella', 'harga' => 70000, 'gambar' => ''],
            ['menu_category_id' => 2, 'nama' => 'Es Teh Manis', 'deskripsi' => 'Segar dan manis', 'harga' => 10000, 'gambar' => ''],
            ['menu_category_id' => 2, 'nama' => 'Jus Jeruk', 'deskripsi' => 'Jeruk peras asli', 'harga' => 15000, 'gambar' => ''],
            ['menu_category_id' => 3, 'nama' => 'Kentang Goreng', 'deskripsi' => 'Gurih dan renyah', 'harga' => 20000, 'gambar' => ''],
        ];

        foreach ($menus as $menu) {
            \App\Models\Menu::create($menu);
        }
    }
}

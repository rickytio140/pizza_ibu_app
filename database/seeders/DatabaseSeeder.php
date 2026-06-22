<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin Pizza Ibu',
            'email' => 'admin@pizzaibu.com',
            'role' => 'admin',
        ]);

        User::factory()->create([
            'name' => 'Kasir Utama',
            'email' => 'kasir@pizzaibu.com',
            'role' => 'kasir',
        ]);

        $this->call([
            TableSeeder::class,
            MenuCategorySeeder::class,
            MenuSeeder::class,
        ]);
    }
}

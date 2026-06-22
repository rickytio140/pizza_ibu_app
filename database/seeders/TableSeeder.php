<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            \App\Models\Table::create([
                'nomor_meja' => 'Meja ' . $i,
                'kode_qr' => 'meja-' . $i,
            ]);
        }
    }
}

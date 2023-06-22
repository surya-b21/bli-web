<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'sku' => rand(1000000, 9999999),
                'nama' => 'Kaca',
                'harga' => 100000,
                'stok' => 1000,
                'unit_of_material' => 'pcs'
            ],
            [
                'sku' => rand(1000000, 9999999),
                'nama' => 'Kran Besi',
                'harga' => 150000,
                'stok' => 1000,
                'unit_of_material' => 'pcs'
            ],
        ];

        DB::table('items')->insert($data);
    }
}

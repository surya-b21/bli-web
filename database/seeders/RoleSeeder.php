<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                "nama" => "Kasir"
            ],
            [
                "nama" => "Admin Stock"
            ],
            [
                "nama" => "Superadmin"
            ]
        ];

        DB::table('roles')->insert($data);
    }
}
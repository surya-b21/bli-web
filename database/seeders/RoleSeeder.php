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
                "id" => 1,
                "nama" => "Kasir"
            ],
            [
                "id" => 2,
                "nama" => "Admin Stock"
            ],
            [
                "id" => 3,
                "nama" => "Superadmin"
            ]
        ];

        DB::table('roles')->insert($data);
    }
}

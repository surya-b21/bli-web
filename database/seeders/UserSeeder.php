<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                "name" => "Super Admin",
                "email" => "superadmin@mail.com",
                "role_id" => 3,
                "password" => Hash::make("super123"),
            ],
            [
                "name" => "Admin Stock",
                "email" => "adminstok@mail.com",
                "role_id" => 2,
                "password" => Hash::make("admin123"),
            ],
            [
                "name" => "Kasir",
                "email" => "kasir@mail.com",
                "role_id" => 1,
                "password" => Hash::make("kasir123"),
            ],
        ];

        DB::table('users')->insert($data);
    }
}

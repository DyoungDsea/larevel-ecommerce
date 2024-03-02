<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //admin
        DB::table('users')->insert([
            [
                'name' => 'Admin',
                'username' => 'Admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('111'),
                'role' => 'admin',
                'status' => 'active',
            ],
            [
                'name' => 'Vendor',
                'username' => 'Vendor',
                'email' => 'vendor@example.com',
                'password' => Hash::make('111'),
                'role' => 'vendor',
                'status' => 'active',
            ],
            [
                'name' => 'User',
                'username' => 'User',
                'email' => 'user@example.com',
                'password' => Hash::make('111'),
                'role' => 'user',
                'status' => 'active',
            ],
        ]);
    }
}

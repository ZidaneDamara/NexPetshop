<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Administrator
        User::create([
            'name' => 'Admin Petshop',
            'email' => 'admin@petshop.test',
            'password' => Hash::make('password'), // ganti dengan password yang aman
            'role' => 'Administrator',
        ]);

        // Customer
        User::create([
            'name' => 'Customer Petshop',
            'email' => 'customer@petshop.test',
            'password' => Hash::make('password'), // ganti dengan password yang aman
            'role' => 'Customer',
        ]);
    }
}
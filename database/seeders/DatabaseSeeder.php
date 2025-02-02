<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345678'),
            'telephone' => '08123456789',
            'status' => 'admin',
        ]);

        User::create([
            'name' => 'pengguna',
            'email' => 'pengguna@gmail.com',
            'password' => bcrypt('12345678'),
            'telephone' => '08123456789',
            'status' => 'user',
        ]);
    }
}

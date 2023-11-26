<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class ResponsableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Mohammed Amin doss',
            'email' => 'doss@gmail.com',
            'password' => bcrypt('password'), // You can use bcrypt() or Hash::make() to hash the password
            'role' => 'responsable',
        ]);
    }
}

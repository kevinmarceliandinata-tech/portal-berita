<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@berita.test'],
            ['name' => 'Administrator', 'password' => 'password', 'role' => 'admin']
        );

        User::updateOrCreate(
            ['email' => 'user@berita.test'],
            ['name' => 'Penulis Berita', 'password' => 'password', 'role' => 'user']
        );
    }
}
<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create(['id' => 1, 'name' => 'Kev', 'town' => 'Belfast', 'email' => 'kev@gmail.com', 'password' => bcrypt('password'), 'isAdmin' => 1]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@vote.id',
            'password' => Hash::make('q1w2e3r4'),
        ]);

        User::create([
            'name' => 'Admin',
            'email' => 'admin@vote.id',
            'password' => Hash::make('q1w2e3r4'),
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Voter;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VoterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Voter::create([
            'name' => 'Alumni Pertama',
            'email' => 'alumni1@example.com',
            'phone' => '081234567890',
            'id_card_number' => '1234567890123456',
            'birth_date' => '1995-05-10',
            'status' => 'not_voted',
        ]);

        Voter::create([
            'name' => 'Alumni Kedua',
            'email' => 'alumni2@example.com',
            'phone' => '082345678901',
            'id_card_number' => '2345678901234567',
            'birth_date' => '1996-06-15',
            'status' => 'not_voted',
        ]);
    }
}

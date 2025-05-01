<?php

namespace Database\Seeders;

use App\Models\Candidate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CandidateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Candidate::create([
            'ketua_name' => 'Andi Saputra',
            'wakil_name' => 'Budi Santoso',
            'description' => 'Pasangan calon dengan visi membangun alumni lebih kuat.',
            'ketua_image_path' => 'images/ketua_andi.jpg',
            'wakil_image_path' => 'images/wakil_budi.jpg',
        ]);

        Candidate::create([
            'ketua_name' => 'Citra Lestari',
            'wakil_name' => 'Dewi Rahayu',
            'description' => 'Pasangan calon dengan misi menguatkan jaringan alumni.',
            'ketua_image_path' => 'images/ketua_citra.jpg',
            'wakil_image_path' => 'images/wakil_dewi.jpg',
        ]);
    }
}

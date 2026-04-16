<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FakultetSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('fakultet')->insert([
            [
                'FAK_ID' => 'FTI',
                'FAK_EM' => 'Fakulteti i Teknologjisë së Informacionit',
                'PED_ID' => 'P12345678A',
            ],
            [
                'FAK_ID' => 'FSP',
                'FAK_EM' => 'Fakulteti i Shkencave Politike',
                'PED_ID' => 'P23456789B',
            ],
            [
                'FAK_ID' => 'EDU',
                'FAK_EM' => 'Fakulteti i Edukimit',
                'PED_ID' => 'P34567890C',
            ],
            [
                'FAK_ID' => 'BIZ',
                'FAK_EM' => 'Fakulteti i Biznesit',
                'PED_ID' => 'P45678901D',
            ],
            [
                'FAK_ID' => 'SHP',
                'FAK_EM' => 'Fakulteti i Shëndetit Publik',
                'PED_ID' => 'P56789012E',
            ],
        ]);
    }
}

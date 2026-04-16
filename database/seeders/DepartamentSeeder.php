<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartamentSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('departament')->insert([
            [
                'DEP_ID' => 'DTI',
                'DEP_EM' => 'Departamenti i Teknologjisë së Informacionit',
                'FAK_ID' => 'FTI',
                'PED_ID' => 'P12345678A',
            ],
            [
                'DEP_ID' => 'MAT',
                'DEP_EM' => 'Departamenti i Matematikës',
                'FAK_ID' => 'FTI',
                'PED_ID' => 'P23456789B',
            ],
            [
                'DEP_ID' => 'SHK',
                'DEP_EM' => 'Departamenti i Shkencave',
                'FAK_ID' => 'FSP',
                'PED_ID' => 'P34567890C',
            ],
            [
                'DEP_ID' => 'XXX',
                'DEP_EM' => 'Departament Eksperimental',
                'FAK_ID' => 'EDU',
                'PED_ID' => 'P45678901D',
            ],
        ]);
    }
}

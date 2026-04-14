<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PedagogSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('pedagog')->insert([
            [
                'PED_ID' => 'P12345678A',
                'PED_EM' => 'Arben',
                'PED_MB' => 'HOXHA',
                'PED_GJIN' => 'M',
                'PED_TIT' => 'Prof.Dr.',
                'PED_DL' => '1975-05-10',
                'PED_TEL' => '0672345678',
                'PED_EMAIL' => 'arben@uamd.edu.al',
                'PED_DT' => '2010-09-01',
                'DEP_ID' => 'DTI',
                'USER_ID' => NULL,
            ],
            [
                'PED_ID' => 'P23456789B',
                'PED_EM' => 'Elira',
                'PED_MB' => 'KOLA',
                'PED_GJIN' => 'F',
                'PED_TIT' => 'Dr.',
                'PED_DL' => '1985-03-15',
                'PED_TEL' => '0683456789',
                'PED_EMAIL' => 'elira@uamd.edu.al',
                'PED_DT' => '2012-10-10',
                'DEP_ID' => 'MAT',
                'USER_ID' => NULL,
            ],
            [
                'PED_ID' => 'P34567890C',
                'PED_EM' => 'Bledi',
                'PED_MB' => 'SHEHU',
                'PED_GJIN' => 'M',
                'PED_TIT' => 'Msc.',
                'PED_DL' => '1990-07-20',
                'PED_TEL' => '0694567891',
                'PED_EMAIL' => 'bledi@uamd.edu.al',
                'PED_DT' => '2018-01-15',
                'DEP_ID' => 'SHK',
                'USER_ID' => NULL,
            ],
            [
                'PED_ID' => 'P45678901D',
                'PED_EM' => 'Sara',
                'PED_MB' => 'META',
                'PED_GJIN' => 'F',
                'PED_TIT' => 'Doc.',
                'PED_DL' => '1980-11-25',
                'PED_TEL' => '0675678912',
                'PED_EMAIL' => 'sara@uamd.edu.al',
                'PED_DT' => '2008-05-20',
                'DEP_ID' => 'XXX',
                'USER_ID' => NULL,
            ],
            [
                'PED_ID' => 'P56789012E',
                'PED_EM' => 'Ilir',
                'PED_MB' => 'DERVISHI',
                'PED_GJIN' => 'M',
                'PED_TIT' => 'Prof.As.Dr.',
                'PED_DL' => '1978-09-12',
                'PED_TEL' => '0686789123',
                'PED_EMAIL' => 'ilir@uamd.edu.al',
                'PED_DT' => '2007-03-03',
                'DEP_ID' => 'DTI',
                'USER_ID' => NULL,
            ],
        ]);
    }
}
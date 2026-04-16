<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LendaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('lenda')->insert([
            ['lend_emer' => 'Programim i Orientuar nga Objektet', 'lend_kod' => 'INF101', 'dep_id' => 'DTI'],
            ['lend_emer' => 'Bazat e të Dhënave', 'lend_kod' => 'INF202', 'dep_id' => 'DTI'],
            ['lend_emer' => 'Algoritme dhe Struktura të të Dhënave', 'lend_kod' => 'INF303', 'dep_id' => 'DTI'],
            ['lend_emer' => 'Matematikë Diskrete', 'lend_kod' => 'MAT101', 'dep_id' => 'MAT'],
            ['lend_emer' => 'Kalkulus', 'lend_kod' => 'MAT202', 'dep_id' => 'MAT'],
            ['lend_emer' => 'Mikroekonomiks', 'lend_kod' => 'EKO101', 'dep_id' => 'SHK'],
            ['lend_emer' => 'Makroekonomiks', 'lend_kod' => 'EKO202', 'dep_id' => 'SHK'],
            ['lend_emer' => 'E Drejtë Civile', 'lend_kod' => 'DRE101', 'dep_id' => 'XXX'],
            ['lend_emer' => 'Gjuhë Angleze I', 'lend_kod' => 'GJU101', 'dep_id' => 'XXX'],
            ['lend_emer' => 'Gjuhë Angleze II', 'lend_kod' => 'GJU202', 'dep_id' => 'XXX'],
        ]);
    }
}

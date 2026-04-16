<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GodinaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('godina')->insert([
            [
                'god_id' => 1,
                'god_emer' => 'Currila',
                'god_adresa' => 'Rruga Currila, Durrës'
            ],
            [
                'god_id' => 2,
                'god_emer' => 'Spitalla 1',
                'god_adresa' => 'Rruga Spitalla, Durrës'
            ],
            [
                'god_id' => 3,
                'god_emer' => 'Spitalla 2',
                'god_adresa' => 'Rruga Spitalla, Durrës'
            ],
        ]);
    }
}

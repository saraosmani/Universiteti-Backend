<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SalleSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('salle')->insert([
            ['salle_id' => 1, 'salle_nr' => 101, 'salle_kati'
            => 1, 'salle_kapacitet' => 30, 'salle_tip' => 'Z', 'god_id' =>
            1],
            ['salle_id' => 2, 'salle_nr' => 102, 'salle_kati'
            => 1, 'salle_kapacitet' => 60, 'salle_tip' => 'A', 'god_id' =>
            1],
            ['salle_id' => 3, 'salle_nr' => 201, 'salle_kati'
            => 2, 'salle_kapacitet' => 30, 'salle_tip' => 'Z', 'god_id' =>
            1],
            ['salle_id' => 4, 'salle_nr' => 101, 'salle_kati'
            => 1, 'salle_kapacitet' => 40, 'salle_tip' => 'A', 'god_id' =>
            2],
            ['salle_id' => 5, 'salle_nr' => 102, 'salle_kati'
            => 1, 'salle_kapacitet' => 25, 'salle_tip' => 'Z', 'god_id' =>
            2],
        ]);
    }
}

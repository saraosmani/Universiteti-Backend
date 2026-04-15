<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeksionSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('seksion')->insert([
            [
                'sek_dita' => 'Hene',
                'sek_ore_fillimi' => '08:00:00',
                'sek_ore_mbarimi' => '09:30:00',
                'sek_grupi' => 'A',
                'sek_lloji' => 'Leksion',
                'lend_id' => 1,
                'ped_id' => 'P12345678A',
                'salle_id' => 2,
                'sem_id' => 6,
                'prog_id' => 'INF01',
            ],
            [
                'sek_dita' => 'Marte',
                'sek_ore_fillimi' => '10:00:00',
                'sek_ore_mbarimi' => '11:30:00',
                'sek_grupi' => 'A',
                'sek_lloji' => 'Seminar',
                'lend_id' => 1,
                'ped_id' => 'P12345678A',
                'salle_id' => 1,
                'sem_id' => 6,
                'prog_id' => 'INF01',
            ],
            [
                'sek_dita' => 'Merkure',
                'sek_ore_fillimi' => '08:00:00',
                'sek_ore_mbarimi' => '09:30:00',
                'sek_grupi' => 'A',
                'sek_lloji' => 'Leksion',
                'lend_id' => 2,
                'ped_id' => 'P23456789B',
                'salle_id' => 4,
                'sem_id' => 6,
                'prog_id' => 'INF01',
            ],
            [
                'sek_dita' => 'Enjte',
                'sek_ore_fillimi' => '12:00:00',
                'sek_ore_mbarimi' => '13:30:00',
                'sek_grupi' => 'B',
                'sek_lloji' => 'Laborator',
                'lend_id' => 3,
                'ped_id' => 'P34567890C',
                'salle_id' => 3,
                'sem_id' => 6,
                'prog_id' => 'INF01',
            ],
        ]);
    }
}
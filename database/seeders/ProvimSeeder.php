<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProvimSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('provim')->insert([
            [
                'prov_data'  => '2025-01-15',
                'prov_ora'   => '09:00:00',
                'prov_lloji' => 'Midterm',
                'lend_id'    => 1,
                'ped_id'     => 'P12345678A',
                'salle_id'   => 1,
                'sem_id'     => 3,
            ],
            [
                'prov_data'  => '2025-01-20',
                'prov_ora'   => '11:00:00',
                'prov_lloji' => 'Midterm',
                'lend_id'    => 2,
                'ped_id'     => 'P12345678A',
                'salle_id'   => 2,
                'sem_id'     => 3,
            ],
            [
                'prov_data'  => '2025-01-22',
                'prov_ora'   => '10:00:00',
                'prov_lloji' => 'Midterm',
                'lend_id'    => 3,
                'ped_id'     => 'P23456789B',
                'salle_id'   => 3,
                'sem_id'     => 3,
            ],
            [
                'prov_data'  => '2025-06-10',
                'prov_ora'   => '09:00:00',
                'prov_lloji' => 'Final',
                'lend_id'    => 1,
                'ped_id'     => 'P12345678A',
                'salle_id'   => 1,
                'sem_id'     => 4,
            ],
            [
                'prov_data'  => '2025-06-12',
                'prov_ora'   => '11:00:00',
                'prov_lloji' => 'Final',
                'lend_id'    => 2,
                'ped_id'     => 'P12345678A',
                'salle_id'   => 2,
                'sem_id'     => 4,
            ],
            [
                'prov_data'  => '2025-06-14',
                'prov_ora'   => '13:00:00',
                'prov_lloji' => 'Final',
                'lend_id'    => 3,
                'ped_id'     => 'P23456789B',
                'salle_id'   => 4,
                'sem_id'     => 4,
            ],
            [
                'prov_data'  => '2025-06-16',
                'prov_ora'   => '09:00:00',
                'prov_lloji' => 'Final',
                'lend_id'    => 4,
                'ped_id'     => 'P34567890C',
                'salle_id'   => 5,
                'sem_id'     => 4,
            ],
            [
                'prov_data'  => '2025-06-18',
                'prov_ora'   => '10:00:00',
                'prov_lloji' => 'Final',
                'lend_id'    => 5,
                'ped_id'     => 'P34567890C',
                'salle_id'   => 3,
                'sem_id'     => 4,
            ],
            [
                'prov_data'  => '2025-07-05',
                'prov_ora'   => '09:00:00',
                'prov_lloji' => 'Rikuperim',
                'lend_id'    => 1,
                'ped_id'     => 'P12345678A',
                'salle_id'   => 1,
                'sem_id'     => 4,
            ],
            [
                'prov_data'  => '2025-07-07',
                'prov_ora'   => '11:00:00',
                'prov_lloji' => 'Rikuperim',
                'lend_id'    => 3,
                'ped_id'     => 'P23456789B',
                'salle_id'   => 2,
                'sem_id'     => 4,
            ],
        ]);
    }
}
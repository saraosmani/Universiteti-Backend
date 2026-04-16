<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegjistrimSeeder extends Seeder
{
    public function run(): void
    {
        // Merr studentët real nga databaza
        $students = DB::table('student')->pluck('stu_id')->toArray();

        // Kontroll nëse ka studentë
        if (count($students) < 2) {
            echo "Nuk ka mjaftueshëm studentë!\n";
            return;
        }

        DB::table('regjistrim')->insert([
            [
                'dat_regj' => '2026-02-01',
                'lend_id' => 1,
                'pik_detyra' => 85,
                'pik_midterm' => 280,
                'pik_final' => 350,
                'regj_status' => 'Kalon',
                'sek_id' => 1,
                'stu_id' => $students[0],
            ],
            [
                'dat_regj' => '2026-02-01',
                'lend_id' => 1,
                'pik_detyra' => 40,
                'pik_midterm' => 150,
                'pik_final' => 200,
                'regj_status' => 'Nuk kalon',
                'sek_id' => 1,
                'stu_id' => $students[1],
            ],
        ]);
    }
}

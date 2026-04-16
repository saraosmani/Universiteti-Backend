<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class StudentSeeder extends Seeder
{
    /**
     * Generate a valid STU_ID
     */
    private function generateStuId(): string
    {
        $letters = strtoupper(Str::random(3));
        $abc = ['A', 'B', 'C'];
        $letter4 = $abc[array_rand($abc)];
        $numbers = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);

        return "DR{$letters}{$letter4}{$numbers}";
    }

    public function run(): void
    {
        $students = [
            [
                'stu_em' => 'John',
                'stu_mb' => 'Doe',
                'stu_atesi' => 'James',
                'stu_gjini' => 'M',
                'stu_dl' => '2000-01-15',
                'stu_nuid' => '1234567895',
                'stu_email' => 'john.doe1@university.edu',
                'stu_dat_regjistrim' => '2026-04-01',
                'stu_status' => 'Aktiv',
                'user_id' => null,

            ],
            [
                'stu_em' => 'Elira',
                'stu_mb' => 'Kola',
                'stu_atesi' => 'Ben',
                'stu_gjini' => 'F',
                'stu_dl' => '2001-05-20',
                'stu_nuid' => '1234567891',
                'stu_email' => 'elira.kola@university.edu',
                'stu_dat_regjistrim' => '2025-09-01',
                'stu_status' => 'Aktiv',
                'user_id' => null,

            ],
            // add more students here...
        ];

        foreach ($students as &$student) {
            $student['stu_id'] = $this->generateStuId();
            $student['created_at'] = now();
            $student['updated_at'] = now();
        }

        DB::table('student')->insert($students);
    }
}

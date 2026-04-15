<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProgramStudimiSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('program_studimi')->insert([
            ['prog_id' => 'INF01', 'prog_em' => 'Informatikë', 'prog_niv' => 'Bachelor', 'prog_krd' => 180, 'dep_id' => 'DTI'],
            ['prog_id' => 'INF02', 'prog_em' => 'Informatikë - Master Profesional', 'prog_niv' => 'Master Prof', 'prog_krd' => 120, 'dep_id' => 'DTI'],
            ['prog_id' => 'MAT01', 'prog_em' => 'Matematikë', 'prog_niv' => 'Bachelor', 'prog_krd' => 180, 'dep_id' => 'MAT'],
            ['prog_id' => 'EKO01', 'prog_em' => 'Ekonomiks', 'prog_niv' => 'Bachelor', 'prog_krd' => 180, 'dep_id' => 'SHK'],
            ['prog_id' => 'DRE01', 'prog_em' => 'Drejtësi - Master i Integruar', 'prog_niv' => 'Master Int', 'prog_krd' => 300, 'dep_id' => 'XXX'],
        ]);
    }
}
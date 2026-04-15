<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class SemestriSeeder extends Seeder
{
 public function run(): void
 {
 DB::table('semestri')->insert([
 ['sem_id' => 1, 'sem_nr' => 1, 'sem_data_fillimit'
=> '2023-10-01', 'sem_data_mbarimi' => '2024-01-31',
'sem_aktiv' => false, 'vit_id' => 1],
 ['sem_id' => 2, 'sem_nr' => 2, 'sem_data_fillimit'
=> '2024-02-01', 'sem_data_mbarimi' => '2024-06-30',
'sem_aktiv' => false, 'vit_id' => 1],
 ['sem_id' => 3, 'sem_nr' => 1, 'sem_data_fillimit'
=> '2024-10-01', 'sem_data_mbarimi' => '2025-01-31',
'sem_aktiv' => false, 'vit_id' => 2],
 ['sem_id' => 4, 'sem_nr' => 2, 'sem_data_fillimit'
=> '2025-02-01', 'sem_data_mbarimi' => '2025-06-30',
'sem_aktiv' => false, 'vit_id' => 2],
 ['sem_id' => 5, 'sem_nr' => 1, 'sem_data_fillimit'
=> '2025-10-01', 'sem_data_mbarimi' => '2026-01-31',
'sem_aktiv' => false, 'vit_id' => 3],
 ['sem_id' => 6, 'sem_nr' => 2, 'sem_data_fillimit'
=> '2026-02-01', 'sem_data_mbarimi' => '2026-06-30',
'sem_aktiv' => true, 'vit_id' => 3],
 ]);
 }
}
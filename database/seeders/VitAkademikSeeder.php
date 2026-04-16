<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VitAkademikSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('vit_akademik')->insert([
            [
                'vit_id' => 1,
                'emer_id' => 'VIT2023-2024',
                'vit_emer' => '2023-2024',
                'vit_data_fillimit' =>
                '2023-10-01',
                'vit_data_mbarimi' => '2024-06-30',
                'vit_aktiv'
                => false
            ],
            [
                'vit_id' => 2,
                'emer_id' => 'VIT2024-2025',
                'vit_emer' => '2024-2025',
                'vit_data_fillimit' =>
                '2024-10-01',
                'vit_data_mbarimi' => '2025-06-30',
                'vit_aktiv'
                => false
            ],
            [
                'vit_id' => 3,
                'emer_id' => 'VIT2025-2026',
                'vit_emer' => '2025-2026',
                'vit_data_fillimit' =>
                '2025-10-01',
                'vit_data_mbarimi' => '2026-06-30',
                'vit_aktiv'
                => true
            ],
        ]);
    }
}

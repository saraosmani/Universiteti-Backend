<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class AuditorSeeder extends Seeder
{
 public function run(): void
 {
 DB::table('auditor')->insert([
 ['salle_id' => 1, 'aud_ka_aircon' => true,
'aud_ka_wifi' => true, 'aud_tip' => 'X'],
 ['salle_id' => 2, 'aud_ka_aircon' => true,
'aud_ka_wifi' => true, 'aud_tip' => 'L'],
 ['salle_id' => 3, 'aud_ka_aircon' => false,
'aud_ka_wifi' => true, 'aud_tip' => 'X'],
 ['salle_id' => 4, 'aud_ka_aircon' => true,
'aud_ka_wifi' => false, 'aud_tip' => 'L'],
 ['salle_id' => 5, 'aud_ka_aircon' => false,
'aud_ka_wifi' => true, 'aud_tip' => 'X'],
 ]);
 }
}
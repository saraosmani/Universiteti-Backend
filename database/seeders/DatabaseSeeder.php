<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
class DatabaseSeeder extends Seeder
{
 public function run(): void
 {
 $this->call([
 GodinaSeeder::class,
 SalleSeeder::class,
 AuditorSeeder::class,
 DepartamentSeeder::class,
 PedagogSeeder::class,
 LendaSeeder::class,
 ProgramStudimiSeeder::class,
 VitAkademikSeeder::class,
 SemestriSeeder::class,
 StudentSeeder::class,
 SeksionSeeder::class,
 RegjistrimSeeder::class,
 ]);
 }
}
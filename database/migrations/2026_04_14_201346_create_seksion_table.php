<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration
{
 public function up(): void
 {
 Schema::create('seksion', function (Blueprint $table)
{
 $table->increments('sek_id');
 $table->string('sek_dita', 10);
 $table->time('sek_ore_fillimi');
 $table->time('sek_ore_mbarimi');
 $table->string('sek_grupi', 2)->default('A');
 $table->string('sek_lloji', 15);
 $table->unsignedSmallInteger('lend_id');
 $table->char('ped_id', 10);
 $table->smallInteger('salle_id');
 $table->smallInteger('sem_id');
 $table->char('prog_id', 5);
 $table->unique(['ped_id', 'sek_dita',
'sek_ore_fillimi']);
 $table->unique(['salle_id', 'sek_dita',
'sek_ore_fillimi']);
 $table->foreign('lend_id')->references('lend_id')->on('lenda');
 $table->foreign('ped_id')->references('ped_id')->on('pedagog');
 $table->foreign('salle_id')->references('salle_id')->on('auditor');
 $table->foreign('sem_id')->references('sem_id')->on('semestri');
 $table->foreign('prog_id')->references('prog_id')->on('program_studimi');
 });
 }
 public function down(): void
 {
 Schema::dropIfExists('seksion');
 }
};
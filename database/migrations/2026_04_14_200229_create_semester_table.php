<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration
{
 public function up(): void
 {
 Schema::create('semestri', function (Blueprint $table)
{
 $table->smallInteger('sem_id')->primary();
 $table->tinyInteger('sem_nr')->unsigned();
 $table->date('sem_data_fillimit');
 $table->date('sem_data_mbarimi');
 $table->boolean('sem_aktiv')->default(false);
 $table->smallInteger('vit_id');
 $table->foreign('vit_id')->references('vit_id')->on('vit_akademik');
 });
 }
 public function down(): void
 {
 Schema::dropIfExists('semestri');
 }
};
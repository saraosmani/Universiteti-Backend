<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration
{
 public function up(): void
 {
 Schema::create('lenda', function (Blueprint $table) {
 $table->smallIncrements('lend_id');
 $table->string('lend_emer', 70);
 $table->char('lend_kod', 6)->unique();
 $table->char('dep_id', 3);
 $table->foreign('dep_id')->references('dep_id')->on('departament');
 });
 }
 public function down(): void
 {
 Schema::dropIfExists('lenda');
 }
};
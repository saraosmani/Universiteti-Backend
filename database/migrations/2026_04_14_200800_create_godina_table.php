<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration
{
 public function up(): void
 {
 Schema::create('godina', function (Blueprint $table) {
 $table->tinyIncrements('god_id');
 $table->string('god_emer', 20);
 $table->string('god_adresa', 100)->nullable();
 });
 }
 public function down(): void
 {
 Schema::dropIfExists('godina');
 }
};
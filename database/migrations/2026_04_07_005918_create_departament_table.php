<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('departament', function (Blueprint $table) {
        $table->char('dep_id', 3)->primary();
        $table->string('dep_em', 50)->unique();
        $table->char('fak_id', 3);
        $table->char('ped_id', 10);
        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('departament');
}
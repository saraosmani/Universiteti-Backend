<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('program_studimi', function (Blueprint
        $table) {
            $table->char('prog_id', 5)->primary();
            $table->string('prog_em', 60)->unique();
            $table->string('prog_niv', 15);
            $table->smallInteger('prog_krd');
            $table->char('dep_id', 3);
            $table->foreign('dep_id')->references('dep_id')->on('departament');
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('program_studimi');
    }
};

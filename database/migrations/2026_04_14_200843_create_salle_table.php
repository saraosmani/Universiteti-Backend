<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('salle', function (Blueprint $table) {
            $table->smallInteger('salle_id')->primary();
            $table->smallInteger('salle_nr');
            $table->tinyInteger('salle_kati')->unsigned();
            $table->tinyInteger('salle_kapacitet')->unsigned();
            $table->char('salle_tip', 1);
            $table->tinyInteger('god_id')->unsigned();
            $table->unique(['salle_nr', 'god_id']);
            $table->foreign('god_id')->references('god_id')->on('godina');
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('salle');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('provim', function (Blueprint $table) {
            $table->increments('prov_id');
            $table->date('prov_data');
            $table->time('prov_ora');
            $table->string('prov_lloji', 20)->default('Final'); // Final | Midterm | Rikuperim
            $table->unsignedSmallInteger('lend_id');
            $table->char('ped_id', 10);
            $table->smallInteger('salle_id');
            $table->smallInteger('sem_id');

            $table->foreign('lend_id')->references('lend_id')->on('lenda');
            $table->foreign('ped_id')->references('ped_id')->on('pedagog');
            $table->foreign('salle_id')->references('salle_id')->on('auditor');
            $table->foreign('sem_id')->references('sem_id')->on('semestri');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('provim');
    }
};
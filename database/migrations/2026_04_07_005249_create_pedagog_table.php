<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pedagog', function (Blueprint $table) {
            $table->char('ped_id', 10)->primary();
            $table->string('ped_em', 20);
            $table->string('ped_mb', 20);
            $table->char('ped_gjin', 1);
            $table->string('ped_tit', 20)->default('Msc.');
            $table->date('ped_dl');
            $table->char('ped_tel', 10)->unique();
            $table->string('ped_email', 100)->unique();
            $table->date('ped_dt');
            $table->char('dep_id', 3)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pedagog');
    }
};
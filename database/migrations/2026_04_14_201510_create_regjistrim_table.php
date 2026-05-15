<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('regjistrim', function (Blueprint $table) {
            $table->increments('regj_id');
            $table->date('dat_regj')->nullable();
            $table->decimal('pik_midterm', 5, 2)->nullable()->default(null);
            $table->decimal('pik_final', 5, 2)->nullable()->default(null);
            $table->decimal('pik_detyra', 5, 2)->nullable()->default(null);
            $table->string('regj_status', 10);
            $table->unsignedInteger('sek_id');
            $table->unsignedSmallInteger('lend_id');
            $table->char('stu_id', 12);
            $table->unique(['stu_id', 'lend_id', 'sek_id']);
            $table->foreign('sek_id')->references('sek_id')->on('seksion');
            $table->foreign('lend_id')->references('lend_id')->on('lenda');
            $table->foreign('stu_id')->references('stu_id')->on('student');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('regjistrim');
    }
};

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
    Schema::create('student', function (Blueprint $table) {
        $table->char('stu_id', 12)->primary();
        $table->string('stu_em', 100);
        $table->string('stu_mb', 100);
        $table->string('stu_atesi', 100)->default('I panjohur');
        $table->char('stu_gjini', 1);
        $table->date('stu_dl');
        $table->char('stu_nuid', 10)->unique();
        $table->string('stu_email', 150)->unique();
        $table->date('stu_dat_regjistrim');
        $table->string('stu_status')->default('Aktiv');
        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('student');
}
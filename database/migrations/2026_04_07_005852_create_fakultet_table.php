<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fakultet', function (Blueprint $table) {
            $table->char('fak_id', 3)->primary();
            $table->string('fak_em', 41)->unique();
            $table->char('ped_id', 10);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fakultet');
    }
};

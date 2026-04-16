<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('auditor', function (Blueprint $table) {
            $table->smallInteger('salle_id')->primary();
            $table->boolean('aud_ka_aircon')->default(true);
            $table->boolean('aud_ka_wifi')->default(true);
            $table->char('aud_tip', 1)->default('X');
            $table->foreign('salle_id')
                ->references('salle_id')
                ->on('salle')
                ->onDelete('cascade');
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('auditor');
    }
};

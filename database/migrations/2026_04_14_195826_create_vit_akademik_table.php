<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vit_akademik', function (Blueprint
        $table) {
            $table->smallInteger('vit_id')->primary();
            $table->string('emer_id', 20);
            $table->char('vit_emer', 9);
            $table->date('vit_data_fillimit');
            $table->date('vit_data_mbarimi');
            $table->boolean('vit_aktiv')->default(false);
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('vit_akademik');
    }
};

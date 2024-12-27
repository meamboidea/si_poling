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
        Schema::disableForeignKeyConstraints();

        Schema::create('suaras', function (Blueprint $table) {
            $table->id();
            $table->foreignId('calon_id')->constrained();
            $table->foreignId('tps_id')->constrained();
            $table->integer('jumlah_suara');
            $table->foreignId('saksi_id')->constrained();
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suaras');
    }
};

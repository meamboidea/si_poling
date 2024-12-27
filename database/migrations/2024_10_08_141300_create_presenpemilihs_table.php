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

        Schema::create('presenpemilihs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pemilih_id')->constrained();
            $table->foreignId('tps_id')->constrained();
            $table->foreignId('saksi_id')->constrained();
            $table->enum('status', ["hadir","tidak_hadir"]);
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presenpemilihs');
    }
};

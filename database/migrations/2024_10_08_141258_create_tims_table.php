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

        Schema::create('tims', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('email');
            $table->foreignId('jabatan_id')->constrained();
            $table->foreignId('kecamatan_id')->constrained();
            $table->foreignId('desa_id')->nullable();
            $table->foreignId('jabatantim_id');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tims');
    }
};

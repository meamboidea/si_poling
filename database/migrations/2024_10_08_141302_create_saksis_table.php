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

        Schema::create('saksis', function (Blueprint $table) {
            $table->id();
            $table->string('nama_saksi');
            $table->string('no_hp');
            $table->string('email');
            $table->string('foto');
            $table->enum('status', ["verified","unverified"]);
            $table->foreignId('kecamatan_id')->constrained();
            $table->foreignId('desa_id')->constrained();
            $table->foreignId('tps_id')->constrained();
            $table->foreignId('tim_id')->constrained();
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('saksis');
    }
};

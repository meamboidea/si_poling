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

        Schema::create('pemilihs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pemilih');
            $table->string('nik');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('jk');
            $table->string('alamat');
            $table->string('agama');
            $table->string('pekerjaan');
            $table->string('suku');
            $table->string('no_hp');
            $table->enum('status', ["verified","unverified"]);
            $table->foreignId('kecamatan_id')->constrained();
            $table->foreignId('desa_id')->constrained();
            $table->foreignId('tps_id')->nullable();
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
        Schema::dropIfExists('pemilihs');
    }
};

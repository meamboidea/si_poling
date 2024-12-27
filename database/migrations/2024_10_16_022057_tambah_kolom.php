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
        Schema::table('suaras', function (Blueprint $table) {
            $table->integer('jml_suara')->after('saksi_id');
            $table->integer('jml_suara_sah')->after('jml_suara');
            $table->integer('jml_suara_tidak_sah')->after('jml_suara_sah');
            $table->integer('jml_suara_tidak_digunakan')->after('jml_suara_tidak_sah');
            $table->integer('jml_suara_rusak')->after('jml_suara_tidak_digunakan');
            $table->integer('jml_suara_cadangan')->after('jml_suara_rusak');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('suaras', function (Blueprint $table) {
            //
        });
    }
};

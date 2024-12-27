<?php

namespace Database\Seeders;

use App\Models\Pemilih;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PemilihSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //171986
        Pemilih::factory()->count(20000)->create();
    }
}

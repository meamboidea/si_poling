<?php

namespace Database\Seeders;

use App\Models\Saksi;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Saksi::factory()->count(380)->create();
    }
}

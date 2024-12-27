<?php

namespace Database\Seeders;

use App\Models\Tps;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TpsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         Tps::factory()->count(380)->create();
    }
}

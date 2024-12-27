<?php

namespace Database\Seeders;

use App\Models\Tim;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TimSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tim::factory()->count(300)->create();
    }
}

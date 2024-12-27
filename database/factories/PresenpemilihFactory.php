<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Pemilih;
use App\Models\Presenpemilih;
use App\Models\Saksi;
use App\Models\Tp;

class PresenpemilihFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Presenpemilih::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'pemilih_id' => Pemilih::factory(),
            'tps_id' => Tp::factory(),
            'saksi_id' => Saksi::factory(),
            'status' => $this->faker->randomElement(["hadir","tidak_hadir"]),
        ];
    }
}

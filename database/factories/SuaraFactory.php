<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Calon;
use App\Models\Saksi;
use App\Models\Suara;
use App\Models\Tp;

class SuaraFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Suara::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'calon_id' => Calon::factory(),
            'tps_id' => Tp::factory(),
            'jumlah_suara' => $this->faker->numberBetween(-10000, 10000),
            'saksi_id' => Saksi::factory(),
        ];
    }
}

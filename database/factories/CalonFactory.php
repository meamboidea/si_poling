<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Calon;

class CalonFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Calon::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'nama_calon_bupati' => $this->faker->word(),
            'nama_calon_wakil_bupati' => $this->faker->word(),
            'nomor_urut' => $this->faker->numberBetween(-10000, 10000),
            'foto' => $this->faker->word(),
        ];
    }
}

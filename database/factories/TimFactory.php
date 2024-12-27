<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Desa;
use App\Models\Jabatantim;
use App\Models\Kecamatan;
use App\Models\Tim;

class TimFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Tim::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'nama' => $this->faker->name(),
            'email' => $this->faker->safeEmail(),
            'kecamatan_id' => Kecamatan::inRandomOrder()->first()->id,
            'desa_id' => Desa::inRandomOrder()->first()->id,
            'jabatantim_id' => Jabatantim::inRandomOrder()->first()->id,
        ];
    }
}

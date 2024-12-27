<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Desa;
use App\Models\Kecamatan;
use App\Models\Saksi;
use App\Models\Tim;
use App\Models\Tps;

class SaksiFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Saksi::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $kecamatan = Kecamatan::inRandomOrder()->first();
        $desa = Desa::where('kecamatan_id', $kecamatan->id)->inRandomOrder()->first();
        $tps = Tps::where('desa_id', $desa->id)->inRandomOrder()->first();

        return [
            'nama_saksi' => $this->faker->name(),
            'no_hp' => $this->faker->numerify('08###########'),
            'email' => $this->faker->safeEmail(),
            'foto' => null,
            'status' => $this->faker->randomElement(["verified","unverified"]),
            'kecamatan_id' => $kecamatan->id,
            'desa_id' => $desa->id,
            'tps_id' => $tps ? $tps->id : 1,
            'tim_id' => Tim::inRandomOrder()->first()->id,
        ];
    }
}

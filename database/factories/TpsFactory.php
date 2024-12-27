<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Desa;
use App\Models\Kecamatan;
use App\Models\Tps;

class TpsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Tps::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        static $tpsCounts = [];

        $kecamatan = Kecamatan::inRandomOrder()->first();
        $desa = Desa::where('kecamatan_id', $kecamatan->id)->inRandomOrder()->first();

        // Jika desa belum ada dalam array, inisialisasi dengan 0
        if (!isset($tpsCounts[$desa->id])) {
            $tpsCounts[$desa->id] = 0;
        }

        // Tambahkan nomor TPS untuk desa ini
        $tpsCounts[$desa->id]++;

        return [
            'nama_tps' => $tpsCounts[$desa->id],
            'kecamatan_id' => $kecamatan->id,
            'desa_id' => $desa->id,
            'alamat' => $this->faker->streetAddress(),
            'latitude' => $this->faker->latitude(),
            'longitude' => $this->faker->longitude(),
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Tps;
use App\Models\Desa;
use App\Models\Kecamatan;
use App\Models\Pemilih;
use App\Models\Tim;

class PemilihFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Pemilih::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $kecamatan = Kecamatan::inRandomOrder()->first();
        $desa = Desa::where('kecamatan_id', $kecamatan->id)->inRandomOrder()->first();
        $tps = Tps::where('desa_id', $desa->id)->inRandomOrder()->first();

        return [
            'nama_pemilih' => $this->faker->name(),
            'nik' => $this->faker->numerify('740#############'),
            'tempat_lahir' => $this->faker->city(),
            'tanggal_lahir' => $this->faker->date(),
            'jk' => $this->faker->randomElement(["L","P"]),
            'alamat' => $this->faker->streetAddress(),
            'agama' => $this->faker->randomElement(["Islam","Kristen","Katolik","Hindu","Budha","Konghucu"]),
            'pekerjaan' => $this->faker->jobTitle(),
            'suku' => $this->faker->randomElement(["Tolaki","Bugis","Buton","Muna","Moronene","Jawa","Jawa","Makassar","Toraja","Lainnya"]),
            'no_hp' => $this->faker->numerify('08###########'),
            'status' => $this->faker->randomElement(["verified","unverified"]),
            'kecamatan_id' => $kecamatan->id,
            'desa_id' => $desa->id,
            'tps_id' => $tps ? $tps->id : 1,
            'tim_id' => Tim::inRandomOrder()->first()->id,
        ];
    }
}

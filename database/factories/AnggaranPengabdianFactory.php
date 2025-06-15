<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AnggaranPengabdian>
 */
class AnggaranPengabdianFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'kode' => $this->faker->numerify('######'), // 6 digit angka acak
            'kegiatan' => $this->faker->sentence(),
            'volume_usulan' => $this->faker->numberBetween(1, 10),
            'skema' => 'Skema ' . $this->faker->word(),
            'total_anggaran' => $this->faker->randomFloat(2, 1000000, 50000000),
            'file' => 'dummy_file_' . $this->faker->randomNumber(3) . '.pdf', // contoh dummy file
        ];
    }
}

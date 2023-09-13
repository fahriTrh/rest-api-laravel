<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama' => fake()->name(),
            'nim' => strval(mt_rand(10000000, 99999999)),
            'jk' => (mt_rand(1,2) == 1) ? 'L' : 'P',
            'alamat' => fake()->address(),
            'jurusan' => (mt_rand(1,2) == 1) ? 'Teknik Informatika' : 'Sistem Informasi'
        ];
    }
}

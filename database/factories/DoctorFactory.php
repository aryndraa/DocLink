<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Specialist;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class DoctorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'           => fake()->unique()->name(),
            'email'          => fake()->unique()->email(),
            'number'         => fake()->phoneNumber(),
            'specialist_id'  => Specialist::inRandomOrder()->first()->id,
            'working_days'   => json_encode(fake()->randomElements(
                ['senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu', 'minggu'], 
                4
            )),
        ];
    }
}

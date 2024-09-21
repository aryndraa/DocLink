<?php

namespace Database\Factories;

use App\Models\Doctor;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Patient;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ScheduleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'patient_id'        => Patient::inRandomOrder()->first()->id,
            'queue_number'      => fake()->unique()->numberBetween(),
            'complaint'         => fake()->sentence(),
            'payment'           => fake()->randomElement(['BPJS', 'tunai', 'asuransi']),
            'doctor_id'         => Doctor::inRandomOrder()->first()->id,
            'consultation_time' => now(),
            'created_at'        => now(),
            'updated_at'        => now(),
        ];
    }
}

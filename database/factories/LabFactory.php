<?php

namespace Database\Factories;

use App\Models\Status;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lab>
 */
class LabFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->company() . ' Lab',
            'location' => fake()->randomElement(['Gedung A Lt. 1', 'Gedung A Lt. 2', 'Gedung B Lt. 1', 'Gedung B Lt. 2', 'Gedung C Lt. 1']),
            'description' => fake()->sentence(),
            'status_id' => Status::factory(),
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Plan>
 */
class PlanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'slug' => $this->faker->slug(),
            'price' => $this->faker->randomFloat(2, 1, 10),
            'description' => $this->faker->paragraph(),
            'duration' => $this->faker->numberBetween(1, 12),
            'duration_unit' => $this->faker->randomElement(['day', 'week', 'month', 'year']),
        ];
    }

    /**
     * Indicate that the plan is free.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function trial(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => 'Free Trial',
                'slug' => 'free-trial',
                'description' => 'A free trial plan with limited features.',
                'price' => 0.00,
                'duration' => 3, // Default trial period of 3 days
                'duration_unit' => 'day',
            ];
        });
    }
}

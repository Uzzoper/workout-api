<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Exercise>
 */
class ExerciseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'workout_id' => \App\Models\Workout::factory(),
            'name' => $this->faker->word(),
            'sets' => $this->faker->numberBetween(1, 5),
            'reps' => $this->faker->numberBetween(8, 15),
            'weight' => $this->faker->randomFloat(2, 10, 100),
            'position' => $this->faker->numberBetween(0, 10),
            'rest_time' => $this->faker->numberBetween(30, 120),
            'notes' => $this->faker->sentence(),
        ];
    }
}

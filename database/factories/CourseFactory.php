<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(3),
            'shortcut' => $this->faker->word,
            'price' => $this->faker->numberBetween(100, 10000),
            'image' => 'default.jpg', // Placeholder, as file uploads are handled separately
            'description' => $this->faker->paragraph,
            'user_id' => \App\Models\User::factory(),
            'status' => $this->faker->randomElement([0, 1, 2, -1]),
            'trending' => $this->faker->boolean,
        ];
    }
}

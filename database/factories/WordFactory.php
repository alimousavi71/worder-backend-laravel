<?php

namespace Database\Factories;

use App\Enums\Database\Word\WordStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory
 */
class WordFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'word' => fake()->word,
            'translate' => fake()->word,
            'description' => fake()->text,
            'user_id' => fake()->randomElement([rand(1, 50), null]),
            'category_id' => rand(1, 10),
            'status' => WordStatus::getRandomValue(),
        ];
    }
}

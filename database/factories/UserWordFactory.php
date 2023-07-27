<?php

namespace Database\Factories;

use App\Models\UserWord;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory
 */
class UserWordFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'word_id' => rand(1, 500),
            'user_id' => rand(1, 50),
            'is_knew' => fake()->boolean,
            'correct_answer' => rand(1, 10),
            'wrong_answer' => rand(1, 10),
            'repeat' => rand(1, 10),
        ];
    }
}

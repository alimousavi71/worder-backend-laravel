<?php

namespace Database\Factories;

use App\Enums\Database\Exam\ExamType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory
 */
class ExamFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => 'Exam '.fake()->numerify('##'),
            'type' => ExamType::Random,
            'user_id' => rand(1, 10),
            'grade' => rand(1, 100),
            'is_timer_on' => fake()->boolean,
            'is_word_knew' => fake()->boolean,
            'is_my_words' => fake()->boolean,
        ];
    }
}

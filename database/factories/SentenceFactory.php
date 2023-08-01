<?php

namespace Database\Factories;

use App\Enums\Database\Sentence\SentenceStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory
 */
class SentenceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'sentence' => $this->faker->text,
            'translate' => $this->faker->text,
            'status' => SentenceStatus::getRandomValue(),
            'category_id' => rand(1, 10),
        ];
    }
}

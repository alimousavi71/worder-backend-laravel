<?php

namespace Database\Factories;

use App\Enums\Database\Category\CategoryType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => 'Category '.$this->faker->unique()->numerify('##'),
            'type' => CategoryType::getRandomValue(),
        ];
    }
}

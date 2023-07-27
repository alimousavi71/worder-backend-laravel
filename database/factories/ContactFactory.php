<?php

namespace Database\Factories;

use App\Enums\Database\Contact\Rate;
use App\Models\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory
 */
class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'comment' => $this->faker->sentence,
            'user_id' => rand(1,10),
            'rate' => Rate::getRandomValue(),
            'is_seen' => $this->faker->boolean,
            'is_public' => $this->faker->boolean,
            'is_collaboration' => $this->faker->boolean,
            'agent' => $this->faker->userAgent,
        ];
    }
}

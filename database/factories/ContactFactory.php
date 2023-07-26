<?php

namespace Database\Factories;

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
            'email'=>$this->faker->email,
            'figma_link'=>$this->faker->url,
            'dribble_link'=>$this->faker->url,
            'is_seen'=>$this->faker->boolean,
        ];
    }
}

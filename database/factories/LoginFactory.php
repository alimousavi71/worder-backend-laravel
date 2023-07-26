<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class LoginFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id'=>$this->faker->uuid(),
            'login_at'=>$this->faker->date(),
            'agent'=>$this->faker->userAgent(),
            'ip'=>$this->faker->ipv4(),
        ];
    }
}

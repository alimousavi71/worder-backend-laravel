<?php

namespace Database\Factories;

use App\Models\Admin;
use App\Models\User;
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
            'user_type' => $this->faker->randomElement([Admin::class, User::class]),
            'user_id' => rand(1, 10),
            'login_at' => $this->faker->date,
            'agent' => $this->faker->userAgent,
            'ip' => $this->faker->ipv4,
        ];
    }
}

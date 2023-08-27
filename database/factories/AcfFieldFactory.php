<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class AcfFieldFactory extends Factory
{
    public function definition(): array
    {
        return [
            'label' => $this->faker->word(),
            'name' => $this->faker->name(),
            'description' => $this->faker->text(),
            'required' => $this->faker->boolean(),
            'type' => $this->faker->word(),
            'parent' => $this->faker->randomNumber(),
            'acf_template_id' => $this->faker->randomNumber(),
            'props' => $this->faker->words(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{

    public function definition(): array
    {
        return [
            'title' => $this->faker->word(),
            'author' => $this->faker->name(),
            'description' => $this->faker->text(),
            'published_year' => $this->faker->year(),
            'pages' => $this->faker->biasedNumberBetween(1, 1000),
            'user_id' => \App\Models\User::factory()
        ];
    }
}

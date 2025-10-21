<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->unique()->sentence(3),
            'author' => $this->faker->name(),
            'published_date' => $this->faker->date(),
            'genre' => $this->faker->word(),
            'quantity' => $this->faker->numberBetween(0, 100),
        ];
    }
}

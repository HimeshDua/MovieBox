<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Movie>
 */
class MovieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->catchPhrase(), 
            'description' => fake()->paragraph(),
            'rating' => fake()->randomFloat(1, 1, 10),
            'poster' => "https://placehold.co/300x450/png",
            'link' => fake()->url(),
            'category' => fake()->randomElement(['Action', 'Drama', 'Comedy', 'Thriller', 'Sci-Fi', 'Romance']),
            'language' => fake()->randomElement(['English', 'Urdu', 'Hindi', 'Spanish', 'French']),
            'duration' => fake()->numberBetween(80, 180),
            'year' => fake()->numberBetween(1990, now()->year),
        ];
    }
}

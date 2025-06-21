<?php

namespace Database\Factories;

use App\Models\Movie;
use App\Models\Show;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Show>
 */
class ShowFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Show::class;

    public function definition(): array
    {
        return [
            'platform' => fake()->randomElement(['Cinema', 'OTT']),
            'location' => fake()->optional()->streetAddress(),
            'city' => fake()->city(),
            'show_date' => fake()->dateTimeBetween('now', '+2 months')->format('Y-m-d'),
            'show_time' => fake()->time('H:i:s'),
            'movie_id' => Movie::inRandomOrder()->first()?->id ?? Movie::factory(),
        ];
    }
}

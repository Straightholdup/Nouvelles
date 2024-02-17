<?php

namespace Database\Factories;

use App\Models\Author;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\News>
 */
class NewsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'announcement' => $this->faker->paragraph,
            'text' => $this->faker->paragraphs(3, true),
            'publication_date' => $this->faker->dateTimeThisMonth,
            'author_id' => Author::all()->random()->id,
        ];
    }
}

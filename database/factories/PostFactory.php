<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => 9,
            'title' => fake()->sentence(),
            'article' => fake()->paragraphs(3, true),
            'category' => fake()->word(),
            'multimedia' => fake()->boolean(),
            'image' => fake()->imageUrl(750, 645, true),
        ];
    }
}

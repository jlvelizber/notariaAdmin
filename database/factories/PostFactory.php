<?php

namespace Database\Factories;

use App\Enums\PostStatusEnum;
use App\Models\Category;
use App\Models\User;
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
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'title' => fake()->title(),
            'content' => fake()->paragraph(),
            'slug' => fake()->slug(),
            'description' => fake()->text(180),
            'image' => fake()->imageUrl(),
            'status' => PostStatusEnum::PUBLISHED->value,
            'category_id' => Category::factory(),
        ];
    }
}

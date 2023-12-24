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
    public function definition(): array
    {
        $categories = \App\Models\Category::pluck('id')->toArray();
        $users = \App\Models\User::pluck('id')->toArray();
        $is_publishedArr = [1, 2];
        return [
            'title' => $this->faker->unique()->sentence,
            'slug' => $this->faker->unique()->slug,
            'desc' => $this->faker->paragraph,
            'image' => $this->faker->sentence,
            'is_published' => $this->faker->randomElement($is_publishedArr),
            'category_id' => $this->faker->randomElement($categories),
            'user_id' => $this->faker->randomElement($users),

        ];
    }
}

<?php

namespace Database\Factories;

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
        fake()->addProvider(new \Mmo\Faker\PicsumProvider(fake()));

        return [
            'titulo' => fake()->unique()->sentence(),
            'contenido' => fake()->text(),
            'estado' => fake()->randomElement(['Publicado', 'Borrador']),
            'user_id' => User::all()->random()->id,
            'category_id' => Category::all()->random()->id,
            'imagen' => 'images/posts-images/'. fake()->picsum('public/storage/images/posts-images', 640, 480, false),
        ];
    }
}

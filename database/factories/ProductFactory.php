<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->name('products'),
            'description' => fake()->paragraph(),
            'price' => fake()->randomFloat(2, 10, 1000),
            'stock' => fake()->numberBetween(1, 100),
            'status' => fake()->randomElement(['available', 'unavailable',]),
            'image' => fake()->image(storage_path('app/public/images'), 250, 300, 'products', null),
            'category_id' => function () {
                return Category::inRandomOrder()->first()->id;
            }

            //
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @method static \Illuminate\Database\Eloquent\Factories\Factory create(array $attributes = [])
 *
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
            'description' => fake()->paragraph(1),
            'price' => fake()->numberBetween(10000, 50000),
            'stock' => fake()->numberBetween(1, 100),
            'status' => fake()->randomElement(['available', 'unavailable',]),
            'image' => fake()->image(storage_path('app/public/images'), 250, 300, 'products', null),
            'category_id' => function () {
                return Category::inRandomOrder()->first()->id;
            },

            //
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Store;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
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
        DB::table('products')->delete();

        return [
            'store_id' => Store::pluck('id')->random(),
            'category_id' => Category::pluck('id')->random(),
            'name' => $this->faker->word(),
            'slug' => $this->faker->unique()->slug(),
            'description' => $this->faker->optional()->sentence(),
            'image' => $this->faker->optional()->imageUrl(),
            'price' => $this->faker->numberBetween(1, 100),
            'compare_price' => $this->faker->optional()->numberBetween(1, 100),
            'options' => json_encode(['color' => 'red', 'size' => 'L']),
            'rating' => $this->faker->numberBetween(1, 5),
            'featured' => $this->faker->boolean(20),
            'status' => $this->faker->randomElement(['active', 'draft', 'archived']),
        ];
    }
}

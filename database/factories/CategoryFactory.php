<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Store;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
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
            'parent_id' => Category::pluck('id')->count() ? Category::pluck('id')->random() : null,
            'store_id' => Store::pluck('id')->random(),
            'name' => $this->faker->word(),
            'slug' => $this->faker->unique()->slug(),
            'description' => $this->faker->optional()->sentence(),
            'image' => $this->faker->optional()->imageUrl(),
            'status' => $this->faker->randomElement(['active', 'archived']),
        ];
    }
}

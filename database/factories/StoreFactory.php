<?php

namespace Database\Factories;

use App\Models\Store;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Store>
 */
class StoreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->company();

        DB::table('stores')->delete();

        return [
            'parent_id' => Store::inRandomOrder()->first()?->id,
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => $this->faker->optional()->sentence(),
            'logo_image' => $this->faker->optional()->imageUrl(),
            'cover_image' => $this->faker->optional()->imageUrl(),
            'status' => $this->faker->randomElement(['active', 'archived']),
        ];
    }

}

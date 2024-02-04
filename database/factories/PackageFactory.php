<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Group;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Package>
 */
class PackageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $title = fake()->sentence(5),
            'slug' => Str::slug($title),
            'description' => fake()->text(400),
            'total_time' => random_int(10, 1000),
            'level' => rand(1, 3),
            'price' => rand(0, 300000),
            'group_id' => rand(1, 10),
            'user_id' => 1,
        ];
    }
}

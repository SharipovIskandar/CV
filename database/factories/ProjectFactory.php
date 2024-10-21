<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(2), // 2 so'zli tasodifiy nom
            'description' => $this->faker->paragraph(), // Tasodifiy tavsif
            'link' => $this->faker->url(), // Tasodifiy havola
            'source_link' => $this->faker->url(), // Tasodifiy manba havolasi
            'demo_link' => $this->faker->url(), // Tasodifiy demo havolasi
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Language>
 */
class LanguageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(), // Tasodifiy til nomi
            'level' => $this->faker->randomElement(['beginner', 'intermediate', 'advanced', 'fluent']), // Tasodifiy daraja
        ];
    }
}

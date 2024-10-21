<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Education>
 */
class EducationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'student_id' => $this->faker->numberBetween(1, 10), // Tasodifiy student_id
            'name' => $this->faker->sentence(3), // 3 so'zli tasodifiy nom
            'description' => $this->faker->paragraph(), // Tasodifiy tavsif
            'start_date' => $this->faker->dateTimeBetween('-5 years', 'now'), // 5 yil ichidagi sanalar
            'end_date' => $this->faker->dateTimeBetween('now', '+5 years'), // Hozirdan 5 yil ichidagi sanalar
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

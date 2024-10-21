<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => substr($this->faker->firstName(), 0, 32),
            'last_name' => substr($this->faker->lastName(), 0, 32),
            'hhid' => $this->faker->unique()->randomNumber(8),
            'photo' => substr($this->faker->imageUrl(640, 480, 'people'), 0, 64),
            'phone' => substr($this->faker->phoneNumber(), 0, 64),
            'profession' => substr($this->faker->word(), 0, 100),
            'biography' => $this->faker->paragraph(),




        ];
    }
}

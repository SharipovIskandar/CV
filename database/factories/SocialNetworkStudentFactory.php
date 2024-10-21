<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SocialNetworkStudent>
 */
class SocialNetworkStudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'student_id' => \App\Models\Student::factory(), // Tasodifiy o'quvchi
            'social_network_id' => \App\Models\SocialNetwork::factory(), // Tasodifiy ijtimoiy tarmoq
            'username' => $this->faker->userName(), // Tasodifiy foydalanuvc
        ];
    }
}

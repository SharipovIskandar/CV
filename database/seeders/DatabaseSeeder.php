<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(StudentSeeder::class);
        $this->call(ExperienceSeeder::class);
        $this->call(EducationSeeder::class);
        $this->call(ProjectSeeder::class);;
        $this->call(SkillSeeder::class);
        $this->call(SkillStudentSeeder::class);
        $this->call(SocialNetworkSeeder::class);
        $this->call(SocialNetworkStudentSeeder::class);
        $this->call(LanguageSeeder::class);
        $this->call(LanguageStudentSeeder::class);

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}

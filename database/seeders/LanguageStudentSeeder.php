<?php

namespace Database\Seeders;

use App\Models\LanguageStudent;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LanguageStudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LanguageStudent::factory()->count(10)->create();
    }
}

<?php

namespace Tests\Feature;

use App\Models\Student;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class StudentControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $user = User::factory()->create();
        Sanctum::actingAs($user);
    }

    public function test_index_returns_successful_response()
    {
        Student::factory(3)->create();

        $response = $this->getJson('/api/students');

        $response->assertStatus(200)
            ->assertJsonCount(3);
    }

    public function test_store_creates_new_student()
    {
        $response = $this->postJson('/api/students', [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'hhid' => 123456,
            'photo' => null,
            'phone' => null,
            'profession' => null,
            'biography' => null,
        ]);

        $response->assertStatus(201)
            ->assertJsonFragment(['first_name' => 'John']);

        $this->assertDatabaseHas('students', ['first_name' => 'John']);
    }

    public function test_store_fails_with_invalid_data()
    {
        $response = $this->postJson('/api/students', [
            'first_name' => '',
            'last_name' => 'Doe',
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors('first_name');
    }

    public function test_show_returns_student()
    {
        $student = Student::factory()->create();

        $response = $this->getJson("/api/students/{$student->id}");

        $response->assertStatus(200)
            ->assertJsonFragment(['first_name' => $student->first_name]);
    }

    public function test_show_fails_for_nonexistent_student()
    {
        $response = $this->getJson('/api/students/9999');

        $response->assertStatus(404);
    }

    public function test_update_modifies_existing_student()
    {
        $student = Student::factory()->create();

        $response = $this->putJson("/api/students/{$student->id}", [
            'first_name' => 'Jane',
            'last_name' => 'Doe',
            'hhid' => 123456,
            'photo' => null,
            'phone' => null,
            'profession' => null,
            'biography' => null,
        ]);

        $response->assertStatus(200)
            ->assertJsonFragment(['first_name' => 'Jane']);

        $this->assertDatabaseHas('students', ['first_name' => 'Jane']);
    }

    public function test_update_fails_with_invalid_data()
    {
        $student = Student::factory()->create();

        $response = $this->putJson("/api/students/{$student->id}", [
            'first_name' => '',
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors('first_name');
    }

    public function test_destroy_removes_student()
    {
        $student = Student::factory()->create();

        $response = $this->deleteJson("/api/students/{$student->id}");

        $response->assertStatus(204);
        $this->assertDatabaseMissing('students', ['id' => $student->id]);
    }

    public function test_destroy_fails_for_nonexistent_student()
    {
        $response = $this->deleteJson('/api/students/999');

        $response->assertStatus(404);
    }
}

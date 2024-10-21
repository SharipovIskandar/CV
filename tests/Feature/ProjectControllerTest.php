<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ProjectControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $user = User::factory()->create();
        Sanctum::actingAs($user); // Autentifikatsiyani faollashtirish
    }

    /** @test */
    public function test_index_returns_successful_response()
    {
        Project::factory(3)->create(); // 3 ta project yaratish

        $response = $this->getJson('/api/projects'); // API ga GET so'rov yuborish

        $response->assertStatus(200)
            ->assertJsonCount(3); // 3 ta project borligini tasdiqlash
    }

    /** @test */
    public function test_store_creates_new_project()
    {
        $response = $this->postJson('/api/projects', [
            'name' => 'New Project',
            'description' => 'Project description',
            'link' => 'http://example.com',
            'source_link' => 'http://github.com/example',
            'demo_link' => 'http://demo.com',
        ]);

        $response->assertStatus(201) // 201 - Yaratildi
        ->assertJsonFragment(['name' => 'New Project']); // Yaratilgan loyihani tekshirish

        $this->assertDatabaseHas('projects', ['name' => 'New Project']); // Bazada mavjudligini tekshirish
    }

    /** @test */
    public function test_store_fails_with_invalid_data()
    {
        $response = $this->postJson('/api/projects', [
            'name' => '', // Noto'g'ri ma'lumot (bo'sh 'name')
        ]);

        $response->assertStatus(422) // 422 - Validation xatosi
        ->assertJsonValidationErrors('name'); // 'name' maydonida xatolik kutiladi
    }

    /** @test */
    public function test_show_returns_project()
    {
        $project = Project::factory()->create(); // Bir loyiha yaratish

        $response = $this->getJson("/api/projects/{$project->id}");

        $response->assertStatus(200)
            ->assertJsonFragment(['name' => $project->name]); // Loyihani qaytgan ma'lumot bilan tekshirish
    }

    /** @test */
    public function test_show_fails_for_nonexistent_project()
    {
        $response = $this->getJson('/api/projects/9999'); // Mavjud bo'lmagan loyiha ID

        $response->assertStatus(404); // 404 - Topilmadi xatosi
    }

    /** @test */
    public function test_update_modifies_existing_project()
    {
        $project = Project::factory()->create(); // Bir loyiha yaratish

        $response = $this->putJson("/api/projects/{$project->id}", [
            'name' => 'Updated Project',
            'description' => 'Updated description',
            'link' => 'http://newlink.com',
            'source_link' => 'http://newsource.com',
            'demo_link' => 'http://newdemo.com',
        ]);

        $response->assertStatus(200)
            ->assertJsonFragment(['name' => 'Updated Project']); // Yangilangan loyihani tekshirish

        $this->assertDatabaseHas('projects', ['name' => 'Updated Project']); // Yangilangan ma'lumotni bazada tekshirish
    }

    /** @test */
    public function test_update_fails_with_invalid_data()
    {
        $project = Project::factory()->create(); // Bir loyiha yaratish

        $response = $this->putJson("/api/projects/{$project->id}", [
            'name' => '', // Noto'g'ri ma'lumot (bo'sh 'name')
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors('name'); // 'name' maydonida xatolik kutiladi
    }

    /** @test */
    public function test_destroy_removes_project()
    {
        $project = Project::factory()->create(); // Bir loyiha yaratish

        $response = $this->deleteJson("/api/projects/{$project->id}");

        $response->assertStatus(204); // 204 - Muvaffaqiyatli o'chirildi
        $this->assertDatabaseMissing('projects', ['id' => $project->id]); // Bazada loyiha yo'qligini tekshirish
    }

    /** @test */
    public function test_destroy_fails_for_nonexistent_project()
    {
        $response = $this->deleteJson('/api/projects/999'); // Mavjud bo'lmagan loyiha ID

        $response->assertStatus(404); // 404 - Topilmadi xatosi
    }
}

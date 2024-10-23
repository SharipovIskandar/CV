<?php

namespace Tests\Feature;

use App\Models\Experience;
use App\Models\Student;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase;
use Laravel\Sanctum\Sanctum;

class ExperienceControllerTest extends TestCase
{
    use RefreshDatabase;
//
//    protected function setUp(): void
//    {
//        parent::setUp();
//        $user = User::factory()->create();
//        Sanctum::actingAs($user); // Autentifikatsiyani faollashtirish
//    }
//
//    /** @test */
//    public function index_returns_successful_response()
//    {
//        $student = Student::factory()->create();
//        Experience::factory(3)->create(['student_id' => $student->id]); // 3 ta experience yaratish
//
//        $response = $this->getJson("/api/students/{$student->id}/experiences");
//
//        $response->assertStatus(200)
//            ->assertJsonCount(3); // 3 ta tajriba borligini tekshirish
//    }
//
//    /** @test */
    public function test_store_creates_new_experience()
    {
        // Foydalanuvchi yoki studentni yarating
        $student = Student::factory()->create();

        // Post so'rovi orqali ma'lumot yuboring
        $response = $this->postJson("/api/students/{$student->id}/experiences", [
            'name' => 'Any Company',
            'position' => 'Any Position',
            'description' => 'Did some work',
            'start_date' => now()->toDateString(), // formatni moslashtiramiz
            'end_date' => null,
        ]);

        // Javobni tekshirish (2xx status kodi, muvaffaqiyatli bajarilganligini bildiradi)
        $response->assertStatus(201); // yoki assertSuccessful() bilan 2xx statuslarini qamrab olishingiz mumkin

        // Javobda muhim kalitlar borligini tekshirish
        $response->assertJsonStructure([
            'data' => [
                'id',
                'student_id',
                'name',
                'position',
                'description',
                'start_date',
                'end_date'
            ]
        ]);

        // Ma'lumotlar bazasida yangi yozuv borligini tekshirish
        $this->assertDatabaseHas('experiences', [
            'student_id' => $student->id,
            'name' => 'Any Company', // mos keladigan bazaviy ma'lumot
        ]);
    }


//
//        $response->assertStatus(201)
//            ->assertJsonFragment(['name' => 'Company Name']); // Yaratilgan tajribani tekshirish
//
//        $this->assertDatabaseHas('experiences', ['name' => 'Company Name']); // Bazada mavjudligini tekshirish
//    }
//
//    /** @test */
//    public function store_fails_with_invalid_data()
//    {
//        $student = Student::factory()->create();
//
//        $response = $this->postJson("/api/students/{$student->id}/experiences", [
//            'name' => '', // Noto'g'ri ma'lumot (bo'sh 'name')
//            'position' => 'Developer',
//            'start_date' => now(),
//        ]);
//
//        $response->assertStatus(422)
//            ->assertJsonValidationErrors('name'); // 'name' maydonida xatolik kutiladi
//    }
//
//    /** @test */
//    public function show_returns_experience()
//    {
//        $student = Student::factory()->create();
//        $experience = Experience::factory()->create(['student_id' => $student->id]);
//
//        $response = $this->getJson("/api/students/{$student->id}/experiences/{$experience->id}");
//
//        $response->assertStatus(200)
//            ->assertJsonFragment(['name' => $experience->name]); // Tajribani qaytgan ma'lumot bilan tekshirish
//    }
//
//    /** @test */
//    public function show_fails_for_nonexistent_experience()
//    {
//        $student = Student::factory()->create();
//
//        $response = $this->getJson("/api/students/{$student->id}/experiences/9999"); // Mavjud bo'lmagan tajriba ID
//
//        $response->assertStatus(404); // 404 - Topilmadi xatosi
//    }
//
//    /** @test */
//    public function update_modifies_existing_experience()
//    {
//        $student = Student::factory()->create();
//        $experience = Experience::factory()->create(['student_id' => $student->id]);
//
//        $response = $this->putJson("/api/students/{$student->id}/experiences/{$experience->id}", [
//            'name' => 'Updated Company',
//            'position' => 'Lead Developer',
//            'description' => 'Updated description',
//            'start_date' => now(),
//            'end_date' => null,
//        ]);
//
//        $response->assertStatus(200)
//            ->assertJsonFragment(['name' => 'Updated Company']); // Yangilangan tajribani tekshirish
//
//        $this->assertDatabaseHas('experiences', ['name' => 'Updated Company']); // Yangilangan ma'lumotni bazada tekshirish
//    }
//
//    /** @test */
//    public function update_fails_with_invalid_data()
//    {
//        $student = Student::factory()->create();
//        $experience = Experience::factory()->create(['student_id' => $student->id]);
//
//        $response = $this->putJson("/api/students/{$student->id}/experiences/{$experience->id}", [
//            'name' => '', // Noto'g'ri ma'lumot (bo'sh 'name')
//        ]);
//
//        $response->assertStatus(422)
//            ->assertJsonValidationErrors('name'); // 'name' maydonida xatolik kutiladi
//    }
//
//    /** @test */
//    public function destroy_removes_experience()
//    {
//        $student = Student::factory()->create();
//        $experience = Experience::factory()->create(['student_id' => $student->id]);
//
//        $response = $this->deleteJson("/api/students/{$student->id}/experiences/{$experience->id}");
//
//        $response->assertStatus(204); // 204 - Muvaffaqiyatli o'chirildi
//        $this->assertDatabaseMissing('experiences', ['id' => $experience->id]); // Bazada tajriba yo'qligini tekshirish
//    }
//
//    /** @test */
//    public function destroy_fails_for_nonexistent_experience()
//    {
//        $student = Student::factory()->create();
//
//        $response = $this->deleteJson("/api/students/{$student->id}/experiences/999"); // Mavjud bo'lmagan tajriba ID
//
//        $response->assertStatus(404); // 404 - Topilmadi xatosi
//    }
}

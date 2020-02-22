<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passport\Passport;
use Tests\TestCase;

class DiaryEntryTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guests_can_not_access_diary_entries()
    {
        $this->get("/api/user/1/diary-entry")->assertStatus(401);
        $this->get("/api/user/1/diary-entry/1")->assertStatus(401);
        $this->post("/api/user/1/diary-entry")->assertStatus(401);
        $this->patch("/api/user/1/diary-entry/1")->assertStatus(401);
        $this->delete("/api/user/1/diary-entry/1")->assertStatus(401);
    }

    /** @test */
    public function users_can_perform_crud_on_diaries_entries()
    {
        Passport::actingAs(factory(User::class)->create(), []);
        $payload = [
            'content' => 'test',
            'mood' => 'happy',
            'entry_date' => '2020-10-10'
        ];

        $secondPayload = [
            'content' => 'test',
            'mood' => 'happy',
            'entry_date' => '2020-10-10'
        ];

        $this->get("/api/user/1/diary-entry")->assertStatus(200);
        $response = $this->post("/api/user/1/diary-entry", $payload);
        $response->assertStatus(201)->assertJson(['data' => $payload]);

        $entry = $response->json('data');
        $this->get("/api/user/1/diary-entry/".$entry['id'])->assertStatus(200);
        $this->patch("/api/user/1/diary-entry/".$entry['id'], $secondPayload)->assertStatus(200)->assertJson(['data' => $secondPayload]);
        $this->delete("/api/user/1/diary-entry/".$entry['id'])->assertStatus(204);
    }

    /** @test */
    public function users_can_not_perform_crud_on_diaries_entries_from_other_users()
    {
        Passport::actingAs(factory(User::class)->create(), []);
        $payload = [
            'content' => 'test',
            'mood' => 'happy',
            'entry_date' => '2020-10-10'
        ];

        $this->post("/api/user/1/diary-entry", $payload)->assertStatus(201);

        Passport::actingAs(factory(User::class)->create(), []);
        $this->get("/api/user/2/diary-entry/1")->assertStatus(403);
        $this->patch("/api/user/2/diary-entry/1")->assertStatus(403);
        $this->delete("/api/user/2/diary-entry/1")->assertStatus(403);
    }
}

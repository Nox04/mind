<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passport\Passport;
use Tests\TestCase;

class DiaryEntryTest extends TestCase
{
    use RefreshDatabase;

    private $payload = [
        'content' => 'test',
        'mood' => 'happy',
        'entry_date' => '2020-10-10',
    ];

    private $secondPayload = [
        'content' => 'test',
        'mood' => 'upset',
        'entry_date' => '2020-10-10',
    ];

    /** @test */
    public function guests_can_not_access_diary_entries()
    {
        $this->get('/api/user/1/diary-entry')->assertStatus(401);
        $this->get('/api/user/1/diary-entry/1')->assertStatus(401);
        $this->post('/api/user/1/diary-entry')->assertStatus(401);
        $this->patch('/api/user/1/diary-entry/1')->assertStatus(401);
        $this->delete('/api/user/1/diary-entry/1')->assertStatus(401);
    }

    /** @test */
    public function users_can_perform_crud_on_diaries_entries()
    {
        Passport::actingAs(factory(User::class)->create(), []);
        // Get all.
        $this->get('/api/user/1/diary-entry')->assertStatus(200);

        // Save entry.
        $response = $this->post('/api/user/1/diary-entry', $this->payload);
        $response->assertStatus(201)->assertJson(['data' => $this->payload]);
        $entry = $response->json('data');
        $this->assertEquals('happy', $entry['mood']);

        // Get one.
        $this->get('/api/user/1/diary-entry/'.$entry['id'])->assertStatus(200);

        // Update entry.
        $response = $this->patch('/api/user/1/diary-entry/'.$entry['id'], $this->secondPayload)
            ->assertStatus(200)
            ->assertJson(['data' => $this->secondPayload]);

        $entry = $response->json('data');
        $this->assertEquals('upset', $entry['mood']);

        // Delete entry.
        $this->delete('/api/user/1/diary-entry/'.$entry['id'])->assertStatus(204);
    }

    /** @test */
    public function users_can_not_perform_crud_on_diaries_entries_from_other_users()
    {
        Passport::actingAs(factory(User::class)->create(), []);
        $this->post('/api/user/1/diary-entry', $this->payload)->assertStatus(201);

        Passport::actingAs(factory(User::class)->create(), []);
        $this->get('/api/user/2/diary-entry/1')->assertStatus(403);
        $this->patch('/api/user/2/diary-entry/1')->assertStatus(403);
        $this->delete('/api/user/2/diary-entry/1')->assertStatus(403);
    }
}

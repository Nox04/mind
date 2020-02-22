<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class LoginTest extends TestCase
{
    /** @test */
    public function testRequiresEmailAndLogin()
    {
        $payload = [
            'grant_type' => 'password',
            'client_id' => '1',
            'client_secret' => env('PASSPORT_KEY'),
        ];
        $this->json('POST', 'oauth/token', $payload)
            ->assertStatus(400)
            ->assertJson([
                'error' => 'invalid_request',
            ]);
    }

    /** @test */
    public function testUserLoginSuccessfully()
    {
        $user = factory(User::class)->create([
            'email' => 'testlogin@user.com',
            'name' => 'Juan',
            'password' => bcrypt('password'),
        ]);

        $payload = [
            'grant_type' => 'password',
            'client_id' => '1',
            'client_secret' => env('PASSPORT_KEY'),
            'username' => 'testlogin@user.com',
            'password' => 'password',
        ];

        $this->json('POST', 'oauth/token', $payload)
            ->assertStatus(200)
            ->assertJsonStructure([
                'token_type',
                'expires_in',
                'access_token',
                'refresh_token',
            ]);
    }
}

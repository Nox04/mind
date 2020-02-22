<?php

namespace Tests\Feature;

use Tests\TestCase;

class RegisterTest extends TestCase
{
    /** @test */
    public function testRequiresEmailAndLogin()
    {
        $this->json('POST', 'api/auth/register')
            ->assertStatus(422)
            ->assertJson([
                'message' => 'The given data is invalid',
            ]);
    }

    /** @test */
    public function testUserLoginSuccessfully()
    {
        $payload = [
            'email' => 'juan.angarita.11@gmail.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'name' => 'Juan',
        ];

        $this->json('POST', 'api/auth/register', $payload)
            ->assertStatus(201)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'email',
                    'name',
                    'token',
                    'expires_at',
                ]
            ]);
    }
}

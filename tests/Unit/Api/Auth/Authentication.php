<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class Authentication extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_register()
    {
        $userData = [
            'name' => 'JohnDoe',
            'email' => 'john@example.com',
            'password' => 'password1223',
        ];
    
        $response = $this->json('POST', '/api/register', $userData);
    
        $response->assertStatus(200)
            ->assertJson(['message' => 'User Created ']);
    }
    
    /** @test */
    public function a_user_can_login()
    {
        $user = User::factory()->create([
            'email' => 'john@example.com',
            'password' => bcrypt('password'),
        ]);
    
        $loginData = [
            'email' => 'john@example.com',
            'password' => 'password',
        ];
    
        $response = $this->json('POST', '/api/login', $loginData);
    
        $response->assertStatus(200)
            ->assertJsonStructure(['access_token']);
    }

    /** @test */
    public function an_authenticated_user_can_logout()
    {
        $user = User::factory()->create();
        $token = $user->createToken('auth_token')->plainTextToken;

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)
            ->json('POST', '/api/logout');

        $response->assertStatus(200);
    }

    /** @test */
    public function an_unauthenticated_user_cannot_access_protected_routes()
    {
        $response = $this->json('GET', '/api/user');

        $response->assertStatus(401);
    }
}

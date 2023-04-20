<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginInactiveTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;
    public function test_if_user_inactive_cant_login(): void
    {
        $user = User::factory()->create(
            [
                'name' => 'caribean',
                'email' => 'diaz.123456@gmail.com',
                'password' => 'car123456',
                'status' => 'inactive',
            ]
        );

        // Intentar autenticar al usuario inactivo
        $response = $this->actingAs($user)->get('/home');

        $response->assertStatus(200);
        $response = $this->actingAs($user)->get('/home');





        $this->assertFalse(auth()->check());
    }
}

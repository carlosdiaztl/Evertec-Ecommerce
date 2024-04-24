<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApiControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;

    
    public function test_itCanValidatedWhenLogin(): void
    {
        $response = $this->post(route('api-login'), [
            'email' => 'email@',
            'password' => '',
        ], ['accept' => 'application/json']);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['password']);
    }
    public function test_itCanLogin(): void
    {
        $user = User::factory()->create();
        $email = $user->email;

        $response = $this->post(route('api-login'), [
            'email' => $email,
            'password' => 'password',
        ], ['accept' => 'application/json']);

        $response->assertStatus(200);
        $response->assertJsonMissingValidationErrors(['email', 'password']);
        $response->assertJsonStructure([
            'access_token',
        ]);
    }
    public function test_itCanValidatedPasswordWrongWhenLogin(): void
    {
        $user = User::factory()->create();
        $email = $user->email;

        $response = $this->post(route('api-login'), [
            'email' => $email,
            'password' => 'passwordwrong',
        ], ['accept' => 'application/json']);

        $response->assertStatus(422);
        $response->assertJsonFragment([
            'message' => trans('auth.failed'),
        ]);
    }
}

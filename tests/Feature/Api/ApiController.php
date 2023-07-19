<?php

namespace Tests\Feature\Api;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApiController extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    
    public function itCanValidatedWhenLogin(): void
    {
        $response = $this->post(route('api-login'), [
            'email' => 'email@',
            'password' => '',
        ], ['accept' => 'application/json']);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['password']);
    }
    public function itCanLogin(): void
    {
        $user = User::factory()->create();
        $email= $user->get('email');

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
    public function itCanValidatedPasswordWrongWhenLogin(): void
    {
        $user = User::factory()->create();
        $email= $user->get('email');

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

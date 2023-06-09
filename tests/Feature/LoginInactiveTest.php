<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginInactiveTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;

    public function test_if_user_inactive_cant_login(): void
    {
        $user = User::factory()->create([
            'name' => 'Carlos enrique d ',
            'email' => 'carlosd@hotmail.com',
            'password' => 'car123456',
            'status' => 'inactive',
        ]);
        Auth::login($user);
        $response = $this->get('/home');
        $response->assertStatus(302);
        $response->assertRedirect('/login');
        $response->assertSessionHasErrors();
        $this->assertFalse(auth()->check());
    }
}

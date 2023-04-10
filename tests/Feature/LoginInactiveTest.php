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
    public function test_example(): void
    {
        $user = User::create([
            'name' => 'Carlos enrique d ',
            'email' => 'carlosd@hotmail.com',
            'password' => bcrypt('car123456'),
            'status' => 'inactive',
        ]);

        // Intentar autenticar al usuario inactivo
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'car123456',
        ]);
        $response->assertRedirect('/login');

        $response->assertSessionHasErrors();

        $this->assertFalse(auth()->check());
    }
}

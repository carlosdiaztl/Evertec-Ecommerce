<?php

namespace Tests\Feature\User;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_user_access_ownProfile(): void
    {
        $user = User::factory()->create();
        $user2 = User::factory()->create();
        $response = $this->actingAs($user)->get(route('user.edit', $user));
        $response->assertStatus(200);
    }
    public function test_user_cant_access_otherProfile(): void
    {
        $user = User::factory()->create();
        $user2 = User::factory()->create();
        $response = $this->actingAs($user)->get(route('user.edit', $user2));
        $response->assertStatus(401);
    }
}

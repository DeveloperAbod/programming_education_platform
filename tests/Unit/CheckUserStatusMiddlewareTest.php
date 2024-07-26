<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class CheckUserStatusMiddlewareTest extends TestCase
{
    use RefreshDatabase;

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_logs_out_user_and_redirects_to_deactive_when_status_is_not_one()
    {
        // Create a user with status not equal to 1
        $user = User::create([
            'name' => 'auth_user',
            'email' => 'auth_user@example.com',
            'password' => bcrypt('password123'),
            'phone' => '774370569',
            'status' => false,
        ]);

        // Simulate a logged-in user
        $this->actingAs($user);

        // Make a request to a route that is protected by the middleware
        $response = $this->get('control/');

        // Check if the user is redirected to /control/deactive
        $response->assertRedirect('/control/deactive');

        // Verify that the user is logged out
        $this->assertGuest();
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_allows_user_with_status_one_to_access_protected_route()
    {
        // Create a user with status equal to 1
        $user = User::create([
            'name' => 'auth_user',
            'email' => 'auth_user@example.com',
            'password' => bcrypt('password123'),
            'phone' => '774370569',
            'status' => true,
        ]);

        // Simulate a logged-in user
        $this->actingAs($user);

        // Make a request to a route that is protected by the middleware
        $response = $this->get('control/');

        // Check if the user is not redirected and gets a 200 status
        $response->assertStatus(200);
    }
}

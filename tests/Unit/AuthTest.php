<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

class AuthTest extends TestCase
{
    use RefreshDatabase;


    public function testUserLoginSuccess()
    {
        // Create a user in the database
        $user = User::create([
            'name' => 'Test User',
            'email' => 'testuser@example.com',
            'password' => Hash::make('password123'),
            'phone' => '712345678',
            'status' => true,
        ]);

        // Simulate login form data
        $loginData = [
            'email' => 'testuser@example.com',
            'password' => 'password123',
        ];

        // Make a POST request to log in the user
        $response = $this->post(route('login'), $loginData);

        // Assert redirection to the intended location after login
        $response->assertRedirect('control');

        // Check if the user is authenticated
        $this->assertAuthenticatedAs($user);
    }

    public function testUserLoginFailure()
    {
        // Create a user in the database
        User::create([
            'name' => 'Test User',
            'email' => 'testuser@example.com',
            'password' => Hash::make('password123'),
            'phone' => '712345678',
            'status' => true,
        ]);

        // Simulate invalid login form data (e.g., wrong password)
        $loginData = [
            'email' => 'testuser@example.com',
            'password' => 'wrongpassword',
        ];

        // Make a POST request with invalid data
        $response = $this->post(route('login'), $loginData);

        // Assert that login failed and the user was redirected back
        $response->assertSessionHasErrors(['email']);

        // Check that the user is not authenticated
        $this->assertGuest();
    }
    public function testUserRegistrationSuccess()
    {
        // Simulate registration form data
        $userData = [
            'name' => 'Test User',
            'email' => 'testuser@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'phone' => '712345678',
        ];

        // Make a POST request to register a new user
        $response = $this->post(route('register'), $userData);

        // Assert redirection to the intended location after registration
        $response->assertRedirect('control');

        // Check if the user was created in the database
        $this->assertDatabaseHas('users', [
            'email' => 'testuser@example.com'
        ]);

        // Verify the stored password is hashed
        $user = User::where('email', 'testuser@example.com')->first();
        $this->assertTrue(Hash::check('password123', $user->password));
    }

    public function testUserRegistrationValidationFailure()
    {
        // Simulate invalid registration data (e.g., missing password confirmation)
        $invalidData = [
            'name' => 'Test User',
            'email' => 'testuser@example.com',
            'password' => 'password123',
            // 'password_confirmation' is intentionally missing
            'phone' => '712345678',
        ];

        // Make a POST request with invalid data
        $response = $this->post(route('register'), $invalidData);

        // Assert that validation failed and the user was redirected back
        $response->assertSessionHasErrors(['password']);

        // Check that no user was created in the database
        $this->assertDatabaseMissing('users', [
            'email' => 'testuser@example.com'
        ]);
    }
}

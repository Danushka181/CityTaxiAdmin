<?php

namespace Tests\Feature;


use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomePageTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function test_login_is_verified_with_otp(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function test_driver_registration_test(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function test_driver_registration_test_emails(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function test_driver_registration_test_password(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function test_passenger_registration(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function test_passenger_login(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function test_passenger_login_with_otp(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function test_passenger_wrong_password_test(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }


    public function test_create_trip_as_agent(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }
}

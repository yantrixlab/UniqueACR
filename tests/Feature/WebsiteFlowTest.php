<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WebsiteFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_page_loads(): void
    {
        $this->get('/')->assertOk();
    }

    public function test_enquiry_submission_works(): void
    {
        $this->post('/enquiries', [
            'name' => 'Rahul',
            'phone' => '9999999999',
            'email' => 'rahul@example.com',
            'message' => 'Need split AC service',
            'source_type' => 'general',
        ])->assertRedirect();

        $this->assertDatabaseHas('enquiries', ['phone' => '9999999999']);
    }

    public function test_admin_user_can_access_login_page(): void
    {
        User::factory()->create(['role' => 'admin', 'is_active' => true]);
        $this->get('/admin/login')->assertOk();
    }

    public function test_api_lead_capture_works(): void
    {
        $this->postJson('/api/leads', [
            'name' => 'Lead User',
            'phone' => '8888888888',
            'answers' => ['need' => 'Repair'],
        ])->assertCreated();

        $this->assertDatabaseHas('leads', ['phone' => '8888888888']);
    }
}

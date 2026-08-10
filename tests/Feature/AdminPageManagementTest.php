<?php

namespace Tests\Feature;

use App\Models\Pages;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminPageManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_create_a_static_page(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->post(route('dashboard.pages.store'), [
                'name' => 'Privacy Policy',
                'slug' => 'privacy-policy',
                'content' => '<p>Our privacy policy content.</p>',
                'meta_title' => 'Privacy Policy',
                'meta_description' => 'Privacy policy description',
                'is_active' => true,
            ]);

        $response->assertRedirect(route('dashboard.pages'));
        $this->assertDatabaseHas('pages', [
            'slug' => 'privacy-policy',
            'name' => 'Privacy Policy',
        ]);
    }
}

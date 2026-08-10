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

    public function test_public_page_route_displays_saved_content(): void
    {
        Pages::create([
            'name' => 'Privacy Policy',
            'slug' => 'privacy-policy',
            'content' => '<h2>Our Privacy Policy</h2><p>This is the public policy content.</p>',
            'meta_title' => 'Privacy Policy',
            'meta_description' => 'Privacy policy description',
            'is_active' => true,
        ]);

        $response = $this->get(route('slugpage', ['slug' => 'privacy-policy']));

        $response->assertOk();
        $response->assertSee('Our Privacy Policy');
        $response->assertSee('This is the public policy content.');
    }
}

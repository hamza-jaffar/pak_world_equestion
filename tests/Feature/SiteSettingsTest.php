<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SiteSettingsTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_store_site_settings(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->post(route('dashboard.settings.store'), [
                'site_name' => 'Pak World Equestrian',
                'site_email' => 'hello@example.com',
                'site_phone' => '+92 300 1234567',
                'site_address' => "Main Street\nSialkot\nPakistan",
                'map_iframe_url' => 'https://maps.example.com/embed',
                'facebook_url' => 'https://facebook.com/example',
                'instagram_url' => 'https://instagram.com/example',
                'linkedin_url' => 'https://linkedin.com/company/example',
                'twitter_url' => 'https://x.com/example',
            ]);

        $response->assertRedirect(route('dashboard.settings'));
        $this->assertDatabaseHas('settings', ['key' => 'site_name', 'value' => 'Pak World Equestrian']);
        $this->assertDatabaseHas('settings', ['key' => 'site_email', 'value' => 'hello@example.com']);
    }

    public function test_site_settings_render_on_contact_page(): void
    {
        $this->app['config']->set('app.name', 'Pak World Equestrian');

        \App\Models\Settings::updateOrCreate(['key' => 'site_name'], ['value' => 'Pak World Equestrian']);
        \App\Models\Settings::updateOrCreate(['key' => 'site_email'], ['value' => 'hello@example.com']);
        \App\Models\Settings::updateOrCreate(['key' => 'site_phone'], ['value' => '+92 300 1234567']);
        \App\Models\Settings::updateOrCreate(['key' => 'site_address'], ['value' => "Main Street\nSialkot\nPakistan"]);
        \App\Models\Settings::updateOrCreate(['key' => 'map_iframe_url'], ['value' => 'https://maps.example.com/embed']);

        $response = $this->get(route('contact'));

        $response->assertOk();
        $response->assertSee('Pak World Equestrian');
        $response->assertSee('hello@example.com');
        $response->assertSee('+92 300 1234567');
    }
}

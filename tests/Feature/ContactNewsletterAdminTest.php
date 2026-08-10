<?php

namespace Tests\Feature;

use App\Models\Contact;
use App\Models\NewLetter;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContactNewsletterAdminTest extends TestCase
{
    use RefreshDatabase;

    public function test_contact_form_can_store_submission(): void
    {
        $response = $this->post(route('contact.store'), [
            'name' => 'Ali Khan',
            'email' => 'ali@example.com',
            'subject' => 'Product inquiry',
            'message' => 'I want to know more about your products.',
        ]);

        $response->assertRedirect(route('contact') . '#contact-form');
        $response->assertSessionHas('success', 'Your message has been sent successfully!');
        $this->assertDatabaseHas('contacts', [
            'email' => 'ali@example.com',
            'subject' => 'Product inquiry',
        ]);
    }

    public function test_authenticated_user_can_view_contact_and_newsletter_admin_pages(): void
    {
        $user = User::factory()->create();
        Contact::factory()->create();
        NewLetter::factory()->create();

        $this->actingAs($user);

        $this->get(route('dashboard.contacts'))
            ->assertOk();

        $this->get(route('dashboard.newsletters'))
            ->assertOk();
    }
}

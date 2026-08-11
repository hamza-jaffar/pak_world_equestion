<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Settings;
use Illuminate\Http\Request;

class SiteSettingsController extends Controller
{
    public function index()
    {
        $settings = Settings::allValues();

        return view('admin.settings.index', compact('settings'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'site_name'              => ['nullable', 'string', 'max:255'],
            'site_email'             => ['nullable', 'email', 'max:255'],
            'site_phone'             => ['nullable', 'string', 'max:255'],
            'site_address'           => ['nullable', 'string'],
            'map_iframe_url'         => ['nullable', 'url', 'max:2000'],
            'facebook_url'           => ['nullable', 'url', 'max:500'],
            'instagram_url'          => ['nullable', 'url', 'max:500'],
            'linkedin_url'           => ['nullable', 'url', 'max:500'],
            'twitter_url'            => ['nullable', 'url', 'max:500'],
            'footer_about_text'      => ['nullable', 'string', 'max:1000'],
            'footer_newsletter_text' => ['nullable', 'string', 'max:500'],
        ]);

        foreach ($validated as $key => $value) {
            Settings::updateValue($key, $value);
        }

        return redirect()->route('dashboard.settings')->with('success', 'Site settings saved successfully.');
    }
}

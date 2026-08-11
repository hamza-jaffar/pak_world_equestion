<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'site_logo'              => ['nullable', 'file', 'image', 'max:2048'],
            'site_favicon'           => ['nullable', 'file', 'mimes:ico,png,svg,webp', 'max:512'],
        ]);

        // Handle text/URL fields
        $textFields = [
            'site_name', 'site_email', 'site_phone', 'site_address',
            'map_iframe_url', 'facebook_url', 'instagram_url',
            'linkedin_url', 'twitter_url', 'footer_about_text', 'footer_newsletter_text',
        ];

        foreach ($textFields as $key) {
            if (array_key_exists($key, $validated)) {
                Settings::updateValue($key, $validated[$key] ?? '');
            }
        }

        // Handle logo upload
        if ($request->hasFile('site_logo') && $request->file('site_logo')->isValid()) {
            // Delete old logo if exists
            $oldLogo = Settings::value('site_logo');
            if ($oldLogo && Storage::disk('public')->exists($oldLogo)) {
                Storage::disk('public')->delete($oldLogo);
            }

            $path = $request->file('site_logo')->store('settings', 'public');
            Settings::updateValue('site_logo', $path, 'brand');
        }

        // Handle favicon upload
        if ($request->hasFile('site_favicon') && $request->file('site_favicon')->isValid()) {
            // Delete old favicon if exists
            $oldFavicon = Settings::value('site_favicon');
            if ($oldFavicon && Storage::disk('public')->exists($oldFavicon)) {
                Storage::disk('public')->delete($oldFavicon);
            }

            $path = $request->file('site_favicon')->store('settings', 'public');
            Settings::updateValue('site_favicon', $path, 'brand');
        }

        return redirect()->route('dashboard.settings')->with('success', 'Site settings saved successfully.');
    }
}

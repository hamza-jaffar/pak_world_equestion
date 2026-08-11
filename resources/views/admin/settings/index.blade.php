<x-layouts::app :title="__('Site Settings')">
    <div class="mx-auto max-w-5xl space-y-6 p-4">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Site Settings</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400">Manage your company logo, favicon, site name, and other details shown across the public site.</p>
            </div>
        </div>

        @if (session('success'))
            <div class="rounded-md border border-emerald-500 bg-emerald-50 px-4 py-3 text-sm text-emerald-700 dark:bg-emerald-500/10 dark:text-emerald-300">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('dashboard.settings.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8 rounded-xl border border-zinc-200 bg-white p-6 shadow-sm dark:border-zinc-700 dark:bg-zinc-900">
            @csrf

            {{-- ── Brand Identity ── --}}
            <div>
                <h2 class="text-base font-semibold text-gray-800 dark:text-white mb-1">Brand Identity</h2>
                <p class="text-xs text-gray-400 mb-4">Logo, favicon and site name used across the entire site.</p>

                <div class="grid gap-6 md:grid-cols-3">
                    {{-- Site Name --}}
                    <div>
                        <label for="site_name" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-200">Site Name</label>
                        <input id="site_name" name="site_name" type="text"
                               value="{{ old('site_name', $settings['site_name'] ?? '') }}"
                               class="w-full rounded-md border border-zinc-300 bg-white px-3 py-2 text-sm text-gray-900 focus:border-zinc-500 focus:outline-none dark:border-zinc-700 dark:bg-zinc-800 dark:text-white">
                    </div>

                    {{-- Logo --}}
                    <div>
                        <label for="site_logo" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-200">Site Logo</label>
                        @if (!empty($settings['site_logo']))
                            <div class="mb-2 inline-flex items-center bg-black rounded px-2 py-1">
                                <img src="{{ asset('storage/' . $settings['site_logo']) }}" alt="Current Logo" class="h-10 w-auto object-contain">
                            </div>
                            <p class="text-xs text-gray-400 mb-1">Upload new to replace current</p>
                        @endif
                        <input id="site_logo" type="file" name="site_logo" accept="image/*"
                               class="block w-full text-sm text-zinc-600 dark:text-zinc-300 file:mr-3 file:rounded-full file:border-0 file:bg-emerald-50 file:px-3 file:py-1.5 file:text-sm file:font-medium file:text-emerald-700 hover:file:bg-emerald-100">
                        <p class="mt-1 text-xs text-gray-400">PNG, SVG, WebP recommended. Shown in navbar &amp; footer.</p>
                    </div>

                    {{-- Favicon --}}
                    <div>
                        <label for="site_favicon" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-200">Favicon</label>
                        @if (!empty($settings['site_favicon']))
                            <div class="mb-2 h-10 w-10 flex items-center justify-center bg-gray-100 dark:bg-zinc-800 rounded border border-zinc-200">
                                <img src="{{ asset('storage/' . $settings['site_favicon']) }}" alt="Current Favicon" class="h-8 w-8 object-contain">
                            </div>
                            <p class="text-xs text-gray-400 mb-1">Upload new to replace current</p>
                        @endif
                        <input id="site_favicon" type="file" name="site_favicon" accept="image/x-icon,image/png,image/svg+xml,image/webp"
                               class="block w-full text-sm text-zinc-600 dark:text-zinc-300 file:mr-3 file:rounded-full file:border-0 file:bg-emerald-50 file:px-3 file:py-1.5 file:text-sm file:font-medium file:text-emerald-700 hover:file:bg-emerald-100">
                        <p class="mt-1 text-xs text-gray-400">ICO, PNG, or SVG. Shown in browser tab.</p>
                    </div>
                </div>
            </div>

            <hr class="border-zinc-200 dark:border-zinc-700">

            {{-- ── Contact Info ── --}}
            <div>
                <h2 class="text-base font-semibold text-gray-800 dark:text-white mb-4">Contact Info</h2>

                <div class="grid gap-6 md:grid-cols-2">
                    <div>
                        <label for="site_email" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-200">Email</label>
                        <input id="site_email" name="site_email" type="email"
                               value="{{ old('site_email', $settings['site_email'] ?? '') }}"
                               class="w-full rounded-md border border-zinc-300 bg-white px-3 py-2 text-sm text-gray-900 focus:border-zinc-500 focus:outline-none dark:border-zinc-700 dark:bg-zinc-800 dark:text-white">
                    </div>

                    <div>
                        <label for="site_phone" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-200">Phone</label>
                        <input id="site_phone" name="site_phone" type="text"
                               value="{{ old('site_phone', $settings['site_phone'] ?? '') }}"
                               class="w-full rounded-md border border-zinc-300 bg-white px-3 py-2 text-sm text-gray-900 focus:border-zinc-500 focus:outline-none dark:border-zinc-700 dark:bg-zinc-800 dark:text-white">
                    </div>
                </div>

                <div class="grid gap-6 md:grid-cols-2 mt-6">
                    <div>
                        <label for="map_iframe_url" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-200">Google Map Embed URL</label>
                        <input id="map_iframe_url" name="map_iframe_url" type="url"
                               value="{{ old('map_iframe_url', $settings['map_iframe_url'] ?? '') }}"
                               class="w-full rounded-md border border-zinc-300 bg-white px-3 py-2 text-sm text-gray-900 focus:border-zinc-500 focus:outline-none dark:border-zinc-700 dark:bg-zinc-800 dark:text-white">
                    </div>

                    <div>
                        <label for="site_address" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-200">Address</label>
                        <textarea id="site_address" name="site_address" rows="3"
                                  class="w-full rounded-md border border-zinc-300 bg-white px-3 py-2 text-sm text-gray-900 focus:border-zinc-500 focus:outline-none dark:border-zinc-700 dark:bg-zinc-800 dark:text-white">{{ old('site_address', $settings['site_address'] ?? '') }}</textarea>
                    </div>
                </div>
            </div>

            <hr class="border-zinc-200 dark:border-zinc-700">

            {{-- ── Social Links ── --}}
            <div>
                <h2 class="text-base font-semibold text-gray-800 dark:text-white mb-4">Social Links</h2>

                <div class="grid gap-6 md:grid-cols-2">
                    <div>
                        <label for="facebook_url" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-200">Facebook URL</label>
                        <input id="facebook_url" name="facebook_url" type="url"
                               value="{{ old('facebook_url', $settings['facebook_url'] ?? '') }}"
                               class="w-full rounded-md border border-zinc-300 bg-white px-3 py-2 text-sm text-gray-900 focus:border-zinc-500 focus:outline-none dark:border-zinc-700 dark:bg-zinc-800 dark:text-white">
                    </div>

                    <div>
                        <label for="instagram_url" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-200">Instagram URL</label>
                        <input id="instagram_url" name="instagram_url" type="url"
                               value="{{ old('instagram_url', $settings['instagram_url'] ?? '') }}"
                               class="w-full rounded-md border border-zinc-300 bg-white px-3 py-2 text-sm text-gray-900 focus:border-zinc-500 focus:outline-none dark:border-zinc-700 dark:bg-zinc-800 dark:text-white">
                    </div>

                    <div>
                        <label for="linkedin_url" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-200">LinkedIn URL</label>
                        <input id="linkedin_url" name="linkedin_url" type="url"
                               value="{{ old('linkedin_url', $settings['linkedin_url'] ?? '') }}"
                               class="w-full rounded-md border border-zinc-300 bg-white px-3 py-2 text-sm text-gray-900 focus:border-zinc-500 focus:outline-none dark:border-zinc-700 dark:bg-zinc-800 dark:text-white">
                    </div>

                    <div>
                        <label for="twitter_url" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-200">Twitter / X URL</label>
                        <input id="twitter_url" name="twitter_url" type="url"
                               value="{{ old('twitter_url', $settings['twitter_url'] ?? '') }}"
                               class="w-full rounded-md border border-zinc-300 bg-white px-3 py-2 text-sm text-gray-900 focus:border-zinc-500 focus:outline-none dark:border-zinc-700 dark:bg-zinc-800 dark:text-white">
                    </div>
                </div>
            </div>

            <hr class="border-zinc-200 dark:border-zinc-700">

            {{-- ── Footer Content ── --}}
            <div>
                <h2 class="text-base font-semibold text-gray-800 dark:text-white mb-4">Footer Content</h2>
                <div class="space-y-5">
                    <div>
                        <label for="footer_about_text" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-200">Footer — Brand Description</label>
                        <textarea id="footer_about_text" name="footer_about_text" rows="3"
                                  placeholder="Short company description shown below the logo in the footer..."
                                  class="w-full rounded-md border border-zinc-300 bg-white px-3 py-2 text-sm text-gray-900 focus:border-zinc-500 focus:outline-none dark:border-zinc-700 dark:bg-zinc-800 dark:text-white">{{ old('footer_about_text', $settings['footer_about_text'] ?? '') }}</textarea>
                    </div>
                    <div>
                        <label for="footer_newsletter_text" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-200">Footer — Newsletter Blurb</label>
                        <textarea id="footer_newsletter_text" name="footer_newsletter_text" rows="2"
                                  placeholder="Text shown above the newsletter subscribe form..."
                                  class="w-full rounded-md border border-zinc-300 bg-white px-3 py-2 text-sm text-gray-900 focus:border-zinc-500 focus:outline-none dark:border-zinc-700 dark:bg-zinc-800 dark:text-white">{{ old('footer_newsletter_text', $settings['footer_newsletter_text'] ?? '') }}</textarea>
                    </div>
                </div>
            </div>

            <div class="flex justify-end pt-2 border-t border-zinc-200 dark:border-zinc-700">
                <button type="submit" class="rounded-md bg-white px-5 py-2.5 text-sm font-medium text-gray-900 shadow-sm ring-1 ring-zinc-300 hover:bg-gray-100 dark:bg-zinc-700 dark:text-white dark:ring-zinc-600 dark:hover:bg-zinc-600">
                    Save Settings
                </button>
            </div>
        </form>
    </div>
</x-layouts::app>

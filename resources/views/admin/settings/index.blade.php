<x-layouts::app :title="__('Site Settings')">
    <div class="mx-auto max-w-5xl space-y-6 p-4">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Site Settings</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400">Manage your company and website details shown across the public site.</p>
            </div>
        </div>

        @if (session('success'))
            <div class="rounded-md border border-emerald-500 bg-emerald-50 px-4 py-3 text-sm text-emerald-700 dark:bg-emerald-500/10 dark:text-emerald-300">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('dashboard.settings.store') }}" method="POST" class="space-y-6 rounded-xl border border-zinc-200 bg-white p-6 shadow-sm dark:border-zinc-700 dark:bg-zinc-900">
            @csrf

            <div class="grid gap-6 md:grid-cols-2">
                <div>
                    <label for="site_name" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-200">Site Name</label>
                    <input id="site_name" name="site_name" type="text" value="{{ old('site_name', $settings['site_name'] ?? '') }}" class="w-full rounded-md border border-zinc-300 bg-white px-3 py-2 text-sm text-gray-900 focus:border-zinc-500 focus:outline-none dark:border-zinc-700 dark:bg-zinc-800 dark:text-white">
                </div>

                <div>
                    <label for="site_email" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-200">Email</label>
                    <input id="site_email" name="site_email" type="email" value="{{ old('site_email', $settings['site_email'] ?? '') }}" class="w-full rounded-md border border-zinc-300 bg-white px-3 py-2 text-sm text-gray-900 focus:border-zinc-500 focus:outline-none dark:border-zinc-700 dark:bg-zinc-800 dark:text-white">
                </div>
            </div>

            <div class="grid gap-6 md:grid-cols-2">
                <div>
                    <label for="site_phone" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-200">Phone</label>
                    <input id="site_phone" name="site_phone" type="text" value="{{ old('site_phone', $settings['site_phone'] ?? '') }}" class="w-full rounded-md border border-zinc-300 bg-white px-3 py-2 text-sm text-gray-900 focus:border-zinc-500 focus:outline-none dark:border-zinc-700 dark:bg-zinc-800 dark:text-white">
                </div>

                <div>
                    <label for="map_iframe_url" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-200">Google Map Embed URL</label>
                    <input id="map_iframe_url" name="map_iframe_url" type="url" value="{{ old('map_iframe_url', $settings['map_iframe_url'] ?? '') }}" class="w-full rounded-md border border-zinc-300 bg-white px-3 py-2 text-sm text-gray-900 focus:border-zinc-500 focus:outline-none dark:border-zinc-700 dark:bg-zinc-800 dark:text-white">
                </div>
            </div>

            <div>
                <label for="site_address" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-200">Address</label>
                <textarea id="site_address" name="site_address" rows="4" class="w-full rounded-md border border-zinc-300 bg-white px-3 py-2 text-sm text-gray-900 focus:border-zinc-500 focus:outline-none dark:border-zinc-700 dark:bg-zinc-800 dark:text-white">{{ old('site_address', $settings['site_address'] ?? '') }}</textarea>
            </div>

            <div class="grid gap-6 md:grid-cols-2">
                <div>
                    <label for="facebook_url" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-200">Facebook URL</label>
                    <input id="facebook_url" name="facebook_url" type="url" value="{{ old('facebook_url', $settings['facebook_url'] ?? '') }}" class="w-full rounded-md border border-zinc-300 bg-white px-3 py-2 text-sm text-gray-900 focus:border-zinc-500 focus:outline-none dark:border-zinc-700 dark:bg-zinc-800 dark:text-white">
                </div>

                <div>
                    <label for="instagram_url" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-200">Instagram URL</label>
                    <input id="instagram_url" name="instagram_url" type="url" value="{{ old('instagram_url', $settings['instagram_url'] ?? '') }}" class="w-full rounded-md border border-zinc-300 bg-white px-3 py-2 text-sm text-gray-900 focus:border-zinc-500 focus:outline-none dark:border-zinc-700 dark:bg-zinc-800 dark:text-white">
                </div>
            </div>

            <div class="grid gap-6 md:grid-cols-2">
                <div>
                    <label for="linkedin_url" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-200">LinkedIn URL</label>
                    <input id="linkedin_url" name="linkedin_url" type="url" value="{{ old('linkedin_url', $settings['linkedin_url'] ?? '') }}" class="w-full rounded-md border border-zinc-300 bg-white px-3 py-2 text-sm text-gray-900 focus:border-zinc-500 focus:outline-none dark:border-zinc-700 dark:bg-zinc-800 dark:text-white">
                </div>

                <div>
                    <label for="twitter_url" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-200">Twitter / X URL</label>
                    <input id="twitter_url" name="twitter_url" type="url" value="{{ old('twitter_url', $settings['twitter_url'] ?? '') }}" class="w-full rounded-md border border-zinc-300 bg-white px-3 py-2 text-sm text-gray-900 focus:border-zinc-500 focus:outline-none dark:border-zinc-700 dark:bg-zinc-800 dark:text-white">
                </div>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="rounded-md bg-white px-5 py-2.5 text-sm font-medium text-gray-900 shadow-sm ring-1 ring-zinc-300 hover:bg-gray-100 dark:bg-zinc-700 dark:text-white dark:ring-zinc-600 dark:hover:bg-zinc-600">
                    Save Settings
                </button>
            </div>
        </form>
    </div>
</x-layouts::app>

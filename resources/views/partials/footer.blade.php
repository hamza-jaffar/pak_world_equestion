@php
    $siteName           = \App\Models\Settings::value('site_name', config('app.name', 'Euro Trend Group of Industries'));
    $siteEmail          = \App\Models\Settings::value('site_email', 'ahmed@eurotrend.pk');
    $sitePhone          = \App\Models\Settings::value('site_phone', '(052) 3575231');
    $siteAddress        = \App\Models\Settings::value('site_address', "Daska Rd\nDakwala Stop, Sadra Badra\nSialkot, Punjab 51310");
    $facebook           = \App\Models\Settings::value('facebook_url', '#');
    $instagram          = \App\Models\Settings::value('instagram_url', '#');
    $linkedin           = \App\Models\Settings::value('linkedin_url', '#');
    $twitter            = \App\Models\Settings::value('twitter_url', '#');
    $footerAboutText    = \App\Models\Settings::value('footer_about_text', "Euro Trend is Pakistan's largest and most reputable manufacturer of equestrian gear, with over 33 years of experience in the industry. Spanning an infrastructure area of over 155,000 square feet.");
    $footerNewsletterText = \App\Models\Settings::value('footer_newsletter_text', 'Send us your email for further more information on any events or Newsletter');
    $addressLines       = preg_split('/\r\n|\r|\n/', $siteAddress);
@endphp

<footer class="bg-black text-gray-300">
    <div class="max-w-7xl mx-auto px-6 py-14">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-10">

            {{-- Brand / About --}}
            <div class="flex flex-col gap-3">
                <x-app-logo />
                <p class="text-sm leading-relaxed text-gray-400">
                    {{ $footerAboutText }}
                </p>
            </div>

            {{-- Useful Links --}}
            <div>
                <h3 class="text-white font-bold uppercase text-sm tracking-wide mb-3">Useful Links</h3>
                <div class="w-10 h-0.5 bg-emerald-500 mb-5"></div>
                <ul class="space-y-3 text-sm">
                    <li>
                        <a href="{{ url('/') }}"
                            class="flex items-center gap-2 text-gray-300 hover:text-emerald-500 transition-colors">
                            <span class="text-emerald-500"><flux:icon.chevron-right class="size-3" /></span> Home
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/about-us') }}"
                            class="flex items-center gap-2 text-gray-300 hover:text-emerald-500 transition-colors">
                            <span class="text-emerald-500"><flux:icon.chevron-right class="size-3" /></span> About us
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/#services') }}"
                            class="flex items-center gap-2 text-gray-300 hover:text-emerald-500 transition-colors">
                            <span class="text-emerald-500"><flux:icon.chevron-right class="size-3" /></span> Services
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/terms-of-service') }}"
                            class="flex items-center gap-2 text-gray-300 hover:text-emerald-500 transition-colors">
                            <span class="text-emerald-500"><flux:icon.chevron-right class="size-3" /></span> Terms of
                            service
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/privacy-policy') }}"
                            class="flex items-center gap-2 text-gray-300 hover:text-emerald-500 transition-colors">
                            <span class="text-emerald-500"><flux:icon.chevron-right class="size-3" /></span> Privacy
                            policy
                        </a>
                    </li>
                </ul>
            </div>

            {{-- Contact Us --}}
            <div>
                <h3 class="text-white font-bold uppercase text-sm tracking-wide mb-3">Contact Us</h3>
                <div class="w-10 h-0.5 bg-emerald-600 mb-5"></div>
                <address class="not-italic text-sm text-gray-300 leading-relaxed space-y-1">
                    @foreach ($addressLines as $line)
                        <p>{{ trim($line) }}</p>
                    @endforeach
                    <p class="pt-2"><span class="font-bold text-white">Phone:</span> {{ $sitePhone }}</p>
                    <p><span class="font-bold text-white">Email:</span>
                        <a href="mailto:{{ $siteEmail }}"
                            class="hover:text-emerald-500 transition-colors">{{ $siteEmail }}</a>
                    </p>
                </address>

                {{-- Social Icons --}}
                <div class="flex items-center gap-3 mt-5">
                    @php
                        $socials = [
                            ['icon' => 'x-twitter', 'url' => $twitter],
                            ['icon' => 'facebook', 'url' => $facebook],
                            ['icon' => 'instagram', 'url' => $instagram],
                            ['icon' => 'linkedin', 'url' => $linkedin],
                        ];
                    @endphp
                    @foreach ($socials as $social)
                        @if (!empty($social['url']) && $social['url'] !== '#')
                            <a href="{{ $social['url'] }}" target="_blank" rel="noopener noreferrer"
                                class="w-9 h-9 flex items-center justify-center rounded-full bg-gray-800 text-white hover:bg-emerald-500 transition-colors" aria-label="Social link">
                                <i class="fab fa-{{ $social['icon'] }} text-sm"></i>
                            </a>
                        @endif
                    @endforeach
                </div>
            </div>

            {{-- Newsletter --}}
            <div id="newsletter-form" class="scroll-mt-24">
                <h3 class="text-white font-bold uppercase text-sm tracking-wide mb-3">Our Newsletter</h3>
                <div class="w-10 h-0.5 bg-emerald-600 mb-5"></div>
                <p class="text-sm text-gray-400 mb-4">
                    {{ $footerNewsletterText }}
                </p>

                @if (session('success'))
                    <div
                        class="mb-3 rounded-md border border-emerald-500/40 bg-emerald-500/10 px-3 py-2 text-sm text-emerald-200">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="mb-3 rounded-md border border-red-500/40 bg-red-500/10 px-3 py-2 text-sm text-red-200">
                        {{ session('error') }}
                    </div>
                @endif

                <form action="{{ route('newsletter') }}" method="POST" data-ajax-form class="flex flex-col gap-2">
                    <div class="flex w-full">
                        @csrf
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="Enter your email"
                            required
                            class="w-full px-3 py-2 text-sm text-black bg-white rounded-l focus:outline-none focus:ring-2 focus:ring-emerald-500">
                        <button type="submit" data-loading-text="Subscribing..."
                            class="px-5 py-2 text-sm font-medium text-black bg-emerald-500 rounded-r hover:bg-emerald-600 transition-colors whitespace-nowrap">
                            Subscribe
                        </button>
                    </div>
                    <div data-form-status class="hidden"></div>
                </form>
            </div>

        </div>
    </div>

    {{-- Bottom bar --}}
    <div class="border-t border-gray-800">
        <div class="max-w-7xl mx-auto px-6 py-5 text-center text-sm text-gray-400">
            <p>&copy; Copyright <span
                    class="font-bold text-white">{{ config('app.name', 'Euro Trend Group of Industries') }}</span>. All
                Rights Reserved</p>
            <p class="mt-1">
                Designed by
                <a href="https://www.degvora.com" target="_blank" rel="noopener noreferrer"
                    class="text-emerald-600 hover:underline">DEGVORA</a>
            </p>
        </div>
    </div>
</footer>
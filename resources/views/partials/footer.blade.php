{{--
Footer Component
Usage: <x-footer /> (save as resources/views/components/footer.blade.php)
Or include directly: @include('partials.footer')

Tailwind CSS is assumed. Adjust class names if you're on Bootstrap instead
(a plain-CSS version is not needed since Tailwind utilities map 1:1 to the
inline styles used below).
--}}
<footer class="bg-black text-gray-300">
    <div class="max-w-7xl mx-auto px-6 py-14">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-10">

            {{-- Brand / About --}}
            <div class="flex flex-col gap-3">
                <x-app-logo />
                <p class="text-sm leading-relaxed text-gray-400">
                    Euro Trend is Pakistan's largest and most reputable manufacturer of
                    equestrian gear, with over 33 years of experience in the industry.
                    Spanning an infrastructure area of over 155,000 square feet.
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
                            <span class="text-emerald-500">&rsaquo;</span> Home
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/about') }}"
                            class="flex items-center gap-2 text-gray-300 hover:text-emerald-500 transition-colors">
                            <span class="text-emerald-500">&rsaquo;</span> About us
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/services') }}"
                            class="flex items-center gap-2 text-gray-300 hover:text-emerald-500 transition-colors">
                            <span class="text-emerald-500">&rsaquo;</span> Services
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/terms-of-service') }}"
                            class="flex items-center gap-2 text-gray-300 hover:text-emerald-500 transition-colors">
                            <span class="text-emerald-500">&rsaquo;</span> Terms of service
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/privacy-policy') }}"
                            class="flex items-center gap-2 text-gray-300 hover:text-emerald-500 transition-colors">
                            <span class="text-emerald-500">&rsaquo;</span> Privacy policy
                        </a>
                    </li>
                </ul>
            </div>

            {{-- Contact Us --}}
            <div>
                <h3 class="text-white font-bold uppercase text-sm tracking-wide mb-3">Contact Us</h3>
                <div class="w-10 h-0.5 bg-emerald-600 mb-5"></div>
                <address class="not-italic text-sm text-gray-300 leading-relaxed space-y-1">
                    <p>Daska Rd</p>
                    <p>Dakwala Stop, Sadra Badra</p>
                    <p>Sialkot, Punjab 51310</p>
                    <p class="pt-2"><span class="font-bold text-white">Phone:</span> (052) 3575231</p>
                    <p><span class="font-bold text-white">Email:</span>
                        <a href="mailto:ahmed@eurotrend.pk"
                            class="hover:text-emerald-500 transition-colors">ahmed@eurotrend.pk</a>
                    </p>
                </address>

                {{-- Social Icons --}}
                <div class="flex items-center gap-3 mt-5">
                    @php
                        $socials = [
                            ['icon' => 'twitter', 'url' => '#'],
                            ['icon' => 'facebook', 'url' => '#'],
                            ['icon' => 'instagram', 'url' => '#'],
                            ['icon' => 'google', 'url' => '#'],
                            ['icon' => 'linkedin', 'url' => '#'],
                        ];
                    @endphp
                    @foreach ($socials as $social)
                        <a href="{{ $social['url'] }}" target="_blank" rel="noopener noreferrer"
                            class="w-9 h-9 flex items-center justify-center rounded-full bg-gray-800 text-white hover:bg-emerald-500 transition-colors">
                            {{-- Swap for your icon library (Font Awesome, Heroicons, etc.) --}}
                            <i class="fab fa-{{ $social['icon'] }} text-sm"></i>
                        </a>
                    @endforeach
                </div>
            </div>

            {{-- Newsletter --}}
            <div>
                <h3 class="text-white font-bold uppercase text-sm tracking-wide mb-3">Our Newsletter</h3>
                <div class="w-10 h-0.5 bg-emerald-600 mb-5"></div>
                <p class="text-sm text-gray-400 mb-4">
                    Send us your email for further more information on any events or Newsletter
                </p>
                {{-- <form action="{{ route('newsletter.subscribe') }}" method="POST" class="flex"> --}}
                    <div class="flex">
                        @csrf
                        <input type="email" name="email" placeholder="Enter your email" required
                            class="w-full px-3 py-2 text-sm text-black bg-white rounded-l focus:outline-none focus:ring-2 focus:ring-emerald-500">
                        <button type="submit"
                            class="px-5 py-2 text-sm font-medium text-black bg-emerald-500 rounded-r hover:bg-emerald-600 transition-colors whitespace-nowrap">
                            Subscribe
                        </button>
                    </div>
                    {{--
                </form> --}}
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
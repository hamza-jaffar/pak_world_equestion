{{--
    Navbar Component
    Save as: resources/views/components/navbar.blade.php
    Usage:   <x-navbar />

    Requires:
      - Tailwind CSS
      - Alpine.js (for the dropdown + mobile menu + scroll state)
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    Behavior:
      - Fixed to the top of the viewport at all times.
      - Transparent background on load (so it sits on top of a hero image/slider).
      - Background fades to solid black once the page is scrolled past 20px.

    NOTE: Because the header is `fixed`, it is removed from normal document
    flow. Add top padding (or a spacer) to whatever sits right below it if
    that content shouldn't start underneath the navbar — the hero slider is
    typically fine since it's meant to sit behind/under it.
--}}
@php
    // Only the homepage gets the transparent -> black on scroll behavior.
    // Every other page is always black, no scroll listener needed.
    $isHome = request()->is('/');
@endphp

<header
    x-data="{ mobileOpen: false, mobileServicesOpen: false, scrolled: {{ $isHome ? 'false' : 'true' }} }"
    @if($isHome)
        x-init="
            scrolled = window.scrollY > 20;
            window.addEventListener('scroll', () => { scrolled = window.scrollY > 20 });
        "
    @endif
    :class="scrolled ? 'bg-black shadow-lg' : 'bg-transparent'"
    class="fixed top-0 inset-x-0 z-50 transition-colors duration-300"
>
    <div class="max-w-7xl mx-auto px-6 w-full">
        <div class="flex items-center justify-between h-20">

            {{-- Logo --}}
            {{-- <a href="{{ url('/') }}" class="flex items-center shrink-0">
                <img src="{{ asset('images/logo.png') }}" alt="{{ config('app.name', 'Euro Trend') }}" class="h-10 w-auto">
            </a> --}}
            <x-app-logo />

            {{-- Desktop Nav --}}
            <nav class="hidden lg:flex items-center gap-9">
                <a href="{{ url('/') }}"
                   class="text-sm font-semibold tracking-wide text-white hover:text-emerald-500 transition-colors {{ request()->is('/') ? 'text-emerald-500' : '' }}">
                    HOME
                </a>
                <a href="{{ url('/about-us') }}"
                   class="text-sm font-semibold tracking-wide text-white hover:text-emerald-500 transition-colors {{ request()->is('about') ? 'text-emerald-500' : '' }}">
                    ABOUT US
                </a>

                {{-- Services dropdown --}}
                <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                    <button type="button"
                            @click="open = !open"
                            class="flex items-center gap-1 text-sm font-semibold tracking-wide text-white hover:text-emerald-500 transition-colors">
                        SERVICES
                        <svg :class="open ? 'rotate-180' : ''" class="w-3.5 h-3.5 mt-px transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <div x-show="open"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 -translate-y-3 scale-95"
                         x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                         x-transition:leave-end="opacity-0 -translate-y-3 scale-95"
                         class="absolute left-0 top-full mt-2 w-64 bg-neutral-900 border border-gray-800 rounded shadow-xl py-2 origin-top"
                         style="display: none;">
                        @foreach ([
                            ['label' => 'Corporate Governance', 'url' => '/#corporate-governance'],
                            ['label' => 'Code of Conduct', 'url' => '/#code-of-conduct'],
                            ['label' => 'Team', 'url' => '/#team'],
                            ['label' => 'R&D', 'url' => '/#rd'],
                            ['label' => 'Words from the director', 'url' => '/#director'],
                            ['label' => 'Delivery', 'url' => '/#delivery'],
                        ] as $item)
                            <a href="{{ url($item['url']) }}"
                               class="block px-5 py-2.5 text-sm text-gray-300 hover:text-emerald-500 hover:bg-black/40 transition-colors">
                                {{ $item['label'] }}
                            </a>
                        @endforeach
                    </div>
                </div>

                <a href="{{ url('/portfolio') }}"
                   class="text-sm font-semibold tracking-wide text-white hover:text-emerald-500 transition-colors {{ request()->is('portfolio') ? 'text-emerald-500' : '' }}">
                    PORTFOLIO
                </a>
                <a href="{{ url('/contact') }}"
                   class="text-sm font-semibold tracking-wide text-white hover:text-emerald-500 transition-colors {{ request()->is('contact') ? 'text-emerald-500' : '' }}">
                    CONTACT
                </a>
            </nav>

            {{-- Mobile hamburger --}}
            <button type="button"
                    @click="mobileOpen = true"
                    class="lg:hidden text-white p-2"
                    aria-label="Open menu">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>
    </div>

    {{-- Mobile slide-out menu --}}
    <div x-show="mobileOpen"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-50 bg-black/95 lg:hidden overflow-y-auto"
         style="display: none;"
         @keydown.escape.window="mobileOpen = false">

        <div class="flex items-center justify-between px-6 h-20">
            <img src="{{ asset('images/logo.png') }}" alt="{{ config('app.name', 'Euro Trend') }}" class="h-9 w-auto">
            <button type="button" @click="mobileOpen = false" class="text-white p-2" aria-label="Close menu">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <nav class="px-6 pb-10">
            <a href="{{ url('/') }}" class="block py-3 text-white font-semibold border-b border-gray-800">HOME</a>
            <a href="{{ url('/about') }}" class="block py-3 text-white font-semibold border-b border-gray-800">ABOUT US</a>

            {{-- Services accordion --}}
            <button type="button"
                    @click="mobileServicesOpen = !mobileServicesOpen"
                    class="w-full flex items-center justify-between py-3 text-left font-semibold border-b border-gray-800"
                    :class="mobileServicesOpen ? 'text-emerald-500' : 'text-white'">
                SERVICES
                <svg :class="mobileServicesOpen ? 'rotate-180 text-emerald-500' : 'text-white'"
                     class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
            <div x-show="mobileServicesOpen"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 -translate-y-2"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-2"
                 class="pl-4 border-b border-gray-800"
                 style="display: none;">
                @foreach ([
                    ['label' => 'Corporate Governance', 'url' => '/services/corporate-governance'],
                    ['label' => 'Code of Conduct', 'url' => '/services/code-of-conduct'],
                    ['label' => 'Path to a Greener Future', 'url' => '/services/greener-future'],
                    ['label' => 'Team', 'url' => '/services/team'],
                    ['label' => 'R&D', 'url' => '/services/rd'],
                    ['label' => 'Words from the director', 'url' => '/services/director'],
                    ['label' => 'Delivery', 'url' => '/services/delivery'],
                ] as $item)
                    <a href="{{ url($item['url']) }}" class="block py-3 text-gray-300 hover:text-emerald-500 transition-colors">
                        {{ $item['label'] }}
                    </a>
                @endforeach
            </div>

            <a href="{{ url('/portfolio') }}" class="block py-3 text-white font-semibold border-b border-gray-800">PORTFOLIO</a>
            <a href="{{ url('/contact') }}" class="block py-3 text-white font-semibold border-b border-gray-800">CONTACT</a>
        </nav>
    </div>
</header>
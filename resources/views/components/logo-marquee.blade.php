{{--
    Logo Marquee Component (Tailwind CSS, pure CSS animation — no JS needed)
    ----------------------------------------------------------------------------
    Save as: resources/views/components/logo-marquee.blade.php
    Usage:

        <x-logo-marquee
            :logos="[
                ['image' => asset('images/certs/iso.png'), 'alt' => 'ISO'],
                ['image' => asset('images/certs/oeko-tex.png'), 'alt' => 'OEKO-TEX'],
                // add as many logos as you want
            ]"
            :speed="30"
        />

    Auto-scrolls left continuously and loops seamlessly (the logo list is
    duplicated once so the animation can reset invisibly). Pauses on hover.
    Reused for both "Our Certifications" and "Members" — just pass a
    different `logos` array each time.
--}}

@props([
    'logos' => [],
    'speed' => 30, // seconds for one full loop — higher = slower
])

<div class="relative overflow-hidden group">
    {{-- Fade edges so logos don't appear to clip abruptly --}}
    <div class="pointer-events-none absolute inset-y-0 left-0 w-16 bg-gradient-to-r from-gray-50 to-transparent z-10"></div>
    <div class="pointer-events-none absolute inset-y-0 right-0 w-16 bg-gradient-to-l from-gray-50 to-transparent z-10"></div>

    <div
        class="flex w-max items-center gap-16 animate-marquee group-hover:[animation-play-state:paused]"
        style="animation-duration: {{ $speed }}s;"
    >
        {{-- Render the logo set twice back-to-back for a seamless loop --}}
        @foreach ([1, 2] as $pass)
            @foreach ($logos as $logo)
                <img
                    src="{{ $logo['image'] }}"
                    alt="{{ $logo['alt'] ?? '' }}"
                    class="h-12 w-auto object-contain shrink-0 grayscale opacity-80 hover:grayscale-0 hover:opacity-100 transition duration-200"
                >
            @endforeach
        @endforeach
    </div>
</div>

@once
    @push('styles')
        <style>
            @keyframes marquee {
                from { transform: translateX(0); }
                to   { transform: translateX(-50%); }
            }
            .animate-marquee {
                animation: marquee linear infinite;
            }
        </style>
    @endpush
@endonce
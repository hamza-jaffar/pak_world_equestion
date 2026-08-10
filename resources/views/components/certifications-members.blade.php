{{--
    Certifications & Members Component (Tailwind CSS)
    -------------------------------------------------------
    Save as: resources/views/components/certifications-members.blade.php
    Usage:   <x-certifications-members />

    Two auto-scrolling logo sliders (built on <x-logo-marquee>) stacked in
    one section with a faint world-map watermark, matching the
    "Our Certifications" / "Members" block from the screenshot.

    Override with your own logos any time:

        <x-certifications-members
            :certifications="[
                ['image' => asset('images/certs/iso.png'), 'alt' => 'ISO'],
                ['image' => asset('images/certs/oeko-tex.png'), 'alt' => 'OEKO-TEX'],
                ['image' => asset('images/certs/bluesign.png'), 'alt' => 'Bluesign'],
                ['image' => asset('images/certs/bsci.png'), 'alt' => 'BSCI'],
                ['image' => asset('images/certs/ce.png'), 'alt' => 'CE'],
            ]"
            :members="[
                ['image' => asset('images/members/sialkot-chamber.png'), 'alt' => 'Sialkot Chamber of Commerce & Industry'],
                ['image' => asset('images/members/some-member.png'), 'alt' => 'Member'],
            ]"
        />

    Requires: same as <x-logo-marquee> (pure CSS, no JS dependency).
--}}

@props([
    'certifications' => [
        ['image' => 'https://upload.wikimedia.org/wikipedia/commons/9/9e/ISO_Logo_%282017%29.svg', 'alt' => 'ISO'],
        ['image' => 'https://upload.wikimedia.org/wikipedia/commons/4/44/OEKO-TEX_Standard_100_Logo.svg', 'alt' => 'OEKO-TEX'],
        ['image' => 'https://upload.wikimedia.org/wikipedia/commons/6/6b/Bluesign_logo.svg', 'alt' => 'Bluesign Product'],
        ['image' => 'https://upload.wikimedia.org/wikipedia/commons/0/0a/CE_mark.svg', 'alt' => 'CE'],
    ],
    'members' => [
        ['image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/e/e6/HD_transparent_picture.png/320px-HD_transparent_picture.png', 'alt' => 'Sialkot Chamber of Commerce & Industry'],
        ['image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/e/e6/HD_transparent_picture.png/320px-HD_transparent_picture.png', 'alt' => 'Member'],
    ],
])

<section class="relative overflow-hidden bg-gray-50 py-20">
    {{-- Faint world-map watermark background --}}
    <div
        class="pointer-events-none absolute inset-0 opacity-[0.04] bg-center bg-no-repeat bg-contain"
        style="background-image: url('https://upload.wikimedia.org/wikipedia/commons/8/83/Equirectangular_projection_SW.jpg')"
    ></div>

    <div class="relative max-w-6xl mx-auto px-6">

        {{-- Certifications --}}
        <div class="text-center mb-8">
            <h2 class="text-2xl md:text-3xl font-extrabold tracking-wide text-gray-900">OUR CERTIFICATIONS</h2>
            <span class="mt-3 inline-block h-1 w-14 bg-emerald-500 rounded-full"></span>
        </div>
        <x-logo-marquee :logos="$certifications" :speed="25" />

        {{-- Members --}}
        <div class="text-center mt-16 mb-8">
            <h2 class="text-2xl md:text-3xl font-extrabold tracking-wide text-gray-900">MEMBERS</h2>
            <span class="mt-3 inline-block h-1 w-14 bg-emerald-500 rounded-full"></span>
        </div>
        <x-logo-marquee :logos="$members" :speed="30" />
    </div>
</section>
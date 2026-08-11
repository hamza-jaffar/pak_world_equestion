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
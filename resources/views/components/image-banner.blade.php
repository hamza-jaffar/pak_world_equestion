{{--
    Image Banner Component (Tailwind CSS)
    -----------------------------------------
    Save as: resources/views/components/image-banner.blade.php
    Usage:

        <x-image-banner
            image="https://example.com/forest-path.jpg"
            title="PATH TO A GREENER FUTURE"
        />

    A full-width image with a dark overlay and a centered uppercase title —
    used as a visual divider between text sections (e.g. "Code of Conduct"
    and "Team" on the services page).
--}}

@props([
    'image' => 'https://images.unsplash.com/photo-1441974231531-c6227db76b6e?q=80&w=1600&auto=format&fit=crop',
    'title' => 'PATH TO A GREENER FUTURE',
    'height' => 'h-72 md:h-96',
])

<div class="relative max-w-6xl mx-auto w-full {{ $height }} overflow-hidden">
    <div
        class="absolute inset-0 bg-cover bg-center"
        style="background-image: url('{{ $image }}')"
    ></div>
    <div class="absolute inset-0 bg-black/50"></div>
    <div class="relative z-10 h-full flex items-center justify-center px-6">
        <h2 class="text-white text-2xl md:text-4xl font-bold tracking-wide text-center">
            {{ $title }}
        </h2>
    </div>
</div>
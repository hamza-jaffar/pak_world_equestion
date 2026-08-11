{{--
    Service Detail Section Component (Tailwind CSS)
    ---------------------------------------------------
    Save as: resources/views/components/service-detail.blade.php
    Usage:

        <x-service-detail
            eyebrow="SERVICES"
            title="CORPORATE GOVERNANCE"
            description="Euro Trend Group of Industries upholds high standards..."
            :features="[
                [
                    'icon' => 'solar',
                    'title' => 'Solar Energy Use:',
                    'text' => \"80% of our production facilities' energy needs are met through solar power, contributing to a cleaner energy profile.\",
                ],
                [
                    'icon' => 'recycle',
                    'title' => 'Recycled Materials:',
                    'text' => '55% of the materials used in our products are recycled or regenerated, reducing the demand for virgin resources.',
                ],
                [
                    'icon' => 'document',
                    'title' => 'Recycled Packaging:',
                    'text' => '55% of our product packaging is LDPE Recycled, with an aim of increasing the % every year to minimize environmental impact.',
                ],
            ]"
        />

    Reusable for any of your service pages (Code of Conduct, R&D, Delivery,
    Team, Words from the Director, etc.) — just swap eyebrow/title/
    description/features. Works with 1–3+ feature items; the grid adapts to
    however many you pass in. Leave `features` as an empty array (or omit
    it) for text-only sections like Team / R&D / Delivery — the icon grid
    is simply skipped.

    Also accepts `compact` (bool) to hide the "SERVICES" eyebrow line when
    stacking several of these sections one after another on the same page
    (only the first section on a page usually needs the eyebrow).

    Requires: Tailwind CSS only, no JS dependency.
--}}

@props([
    'eyebrow' => 'SERVICES',
    'title' => 'CORPORATE GOVERNANCE',
    'description' => "Euro Trend Group of Industries upholds high standards of corporate governance, ensuring ethical practices, transparency, and accountability. A key aspect of our governance is our commitment to sustainability, highlighted by the use of Bluesign-certified products that meet strict environmental standards. We've implemented a no-emissions policy and carefully calculate our carbon footprint as a glove manufacturer, assessing emissions at every production stage. By utilizing energy-efficient technologies, renewable energy, and optimizing our supply chain, we work to minimize our environmental impact, building trust and ensuring the long-term sustainability of our business.",
    'features' => [
        [
            'icon' => 'solar',
            'title' => 'Solar Energy Use:',
            'text' => "80% of our production facilities' energy needs are met through solar power, contributing to a cleaner energy profile.",
        ],
        [
            'icon' => 'recycle',
            'title' => 'Recycled Materials:',
            'text' => '55% of the materials used in our products are recycled or regenerated, reducing the demand for virgin resources.',
        ],
        [
            'icon' => 'document',
            'title' => 'Recycled Packaging:',
            'text' => '55% of our product packaging is LDPE Recycled, with an aim of increasing the % every year to minimize environmental impact.',
        ],
    ],
    'showEyebrow' => true,
])

@php
    $icons = [
        'solar' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12h3l2-5 4 10 2-5h7" /></svg>',
        'recycle' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4 7h16M4 7l3-3M4 7l3 3M20 17H4M20 17l-3-3M20 17l-3 3" /></svg>',
        'document' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M7 4h7l4 4v12a1 1 0 01-1 1H7a1 1 0 01-1-1V5a1 1 0 011-1z" /><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6M9 15h6M9 9h2" /></svg>',
        'leaf' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 21c8 0 14-6 14-14V5h-2C9 5 5 11 5 19v2z" /></svg>',
        'shield' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3l7 3v6c0 5-3.5 8.5-7 9-3.5-.5-7-4-7-9V6l7-3z" /></svg>',
    ];
@endphp

<section class="relative overflow-hidden bg-gray-50 py-20">
    {{-- Faint world-map watermark background --}}
    <div
        class="pointer-events-none absolute inset-0 opacity-[0.04]"
    ></div>

    <div class="relative max-w-6xl mx-auto px-6">

        {{-- Eyebrow (optional — usually only the first section on a page needs it) --}}
        @if($showEyebrow)
            <div class="text-center mb-6">
                <h2 class="text-2xl md:text-3xl font-extrabold tracking-wide text-gray-900">{{ $eyebrow }}</h2>
                <span class="mt-3 inline-block h-1 w-14 bg-emerald-500 rounded-full"></span>
            </div>
        @endif

        {{-- Title --}}
        <div class="text-center mb-10">
            <h1 class="text-2xl md:text-3xl font-extrabold tracking-wide text-gray-900">{{ $title }}</h1>
            <span class="mt-3 inline-block h-1 w-14 bg-emerald-500 rounded-full"></span>
        </div>

        {{-- Description --}}
        <p class="text-gray-700 leading-relaxed text-[15px] text-justify {{ count($features) ? 'mb-14' : '' }} max-w-6xl">
            {{ $description }}
        </p>

        {{-- Feature grid (skipped automatically when no features are passed) --}}
        @if(count($features))
            <div class="grid grid-cols-1 md:grid-cols-3 gap-x-10 gap-y-10">
                @foreach ($features as $feature)
                    <div class="flex gap-4">
                        <div class="shrink-0 flex items-center justify-center w-11 h-11 rounded-full border border-emerald-500 text-emerald-500">
                            {!! $icons[$feature['icon']] ?? $icons['leaf'] !!}
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900 mb-2">{{ $feature['title'] }}</h3>
                            <p class="text-gray-600 text-sm leading-relaxed text-justify">{{ $feature['text'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        {{-- Slot for extra content, e.g. an image banner between sections --}}
        {{ $slot ?? '' }}
    </div>
</section>
{{--
Override content any time:

<x-about-us :heading="'ABOUT US'" :subheading="'Who we are?'" :description="'Your paragraph...'" :cards="[
                [
                    'icon'  => 'search',   // search | clipboard | eye
                    'image' => asset('images/mission.jpg'),
                    'panel_image' => asset('images/mission-panel.jpg'),
                    'title' => 'Our Mission',
                    'text'  => 'Panel description...',
                ],
                // add as many cards as you like
            ]" />
--}}

@props([
    'heading' => 'ABOUT US',
    'subheading' => 'Who we are?',
    'description' => "Euro Trend Group of Industries is Pakistan's largest and most reputable manufacturer of equestrian gear, with over 33 years of experience in the industry. Spanning an infrastructure area of over 155,000 square feet, our commitment to excellence is matched only by our dedication to sustainability. Driven by a robust research and development framework, we ensure that each product not only meets the highest standards of quality but also aligns with our environmental values. As pioneers in the field, we continue to lead the way in crafting premium equestrian gear, collaborating with many of the largest equestrian brands in the world to champion both performance and the planet.",
    'cards' => [
        [
            'icon' => 'search',
            'image' => 'https://images.unsplash.com/photo-1556740738-b6a63e27c4df?q=80&w=800&auto=format&fit=crop',
            'panel_image' => 'https://images.unsplash.com/photo-1523419409543-a5e549c1faa8?q=80&w=800&auto=format&fit=crop',
            'title' => 'Our Mission',
            'text' => 'At Euro Trend Group of Industries, our mission is to enhance equestrian experiences by providing premium gear that ensures optimal performance, comfort, and safety for both riders and horses. We are dedicated to innovation, sustainability, and quality in every product we craft.',
        ],
        [
            'icon' => 'clipboard',
            'image' => 'https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?q=80&w=800&auto=format&fit=crop',
            'panel_image' => 'https://images.unsplash.com/photo-1521791136064-7986c2920216?q=80&w=800&auto=format&fit=crop',
            'title' => 'Our Plan',
            'text' => 'We aim to achieve our mission by integrating cutting-edge technology, sustainable practices, and meticulous craftsmanship in our manufacturing processes. Our focus is on continuous improvement through research and development, leveraging renewable resources wherever possible.',
        ],
        [
            'icon' => 'eye',
            'image' => 'https://images.unsplash.com/photo-1519389950473-47ba0277781c?q=80&w=800&auto=format&fit=crop',
            'panel_image' => 'https://images.unsplash.com/photo-1483721310020-03333e577078?q=80&w=800&auto=format&fit=crop',
            'title' => 'Our Vision',
            'text' => 'Envisioning the precision of the ride, our vision is to revolutionize equestrian gear by elevating standards of accuracy, quality, and sustainability. We aspire to lead the industry by making each ride smoother, safer, and more refined for riders worldwide.',
        ],
    ],
])

@php
    $icons = [
        'search' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M17 11a6 6 0 11-12 0 6 6 0 0112 0z" /></svg>',
        'clipboard' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" /></svg>',
        'eye' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>',
    ];
@endphp

<section class="relative overflow-hidden bg-gray-50 py-20">
    {{-- Faint world-map watermark background --}}
    <div class="pointer-events-none absolute inset-0 opacity-[0.04] bg-center bg-no-repeat bg-contain"
        style="background-image: url('https://upload.wikimedia.org/wikipedia/commons/8/83/Equirectangular_projection_SW.jpg')">
    </div>

    <div class="relative max-w-6xl mx-auto px-6">

        {{-- Heading --}}
        <div class="text-center mb-14">
            <h2 class="text-3xl md:text-4xl font-extrabold tracking-wide text-gray-900">{{ $heading }}</h2>
            <span class="mt-3 inline-block h-1 w-14 bg-emerald-500 rounded-full"></span>
        </div>

        {{-- Who we are --}}
        <div class="mb-16 max-w-5xl">
            <h3 class="text-emerald-600/80 text-lg font-medium mb-4">{{ $subheading }}</h3>
            <p class="text-gray-700 leading-relaxed text-[15px]">
                {{ $description }}
            </p>
        </div>

        {{-- Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach ($cards as $card)
                <div class="group bg-white shadow-sm hover:shadow-lg transition-shadow duration-300">

                    {{-- Top image + icon badge --}}
                    <div class="relative">
                        <img src="{{ $card['image'] }}" alt="{{ $card['title'] }}" class="w-full h-52 rounded-t-xl object-cover">
                        <div
                            class="absolute -bottom-6 left-1/2 -translate-x-1/2 flex items-center justify-center w-14 h-14 rounded-full bg-emerald-500 text-white shadow-md">
                            {!! $icons[$card['icon']] ?? $icons['search'] !!}
                        </div>
                    </div>

                    {{-- Title --}}
                    <div class="pt-10 pb-6 text-center">
                        <h4 class="text-lg font-semibold text-gray-900">{{ $card['title'] }}</h4>
                    </div>

                    {{-- Bottom text panel: image background + dark overlay, revealed/emphasized on hover --}}
                    <div class="relative h-56 rounded-b-xl overflow-hidden">
                        <div class="absolute inset-0 bg-cover bg-center transition-transform duration-500 group-hover:scale-105"
                            style="background-image: url('{{ $card['panel_image'] }}')"></div>
                        <div class="absolute inset-0 bg-black/70 group-hover:bg-black/60 transition-colors duration-300">
                        </div>
                        <p class="relative z-10 h-full flex items-center px-5 text-sm leading-relaxed text-white">
                            {{ $card['text'] }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
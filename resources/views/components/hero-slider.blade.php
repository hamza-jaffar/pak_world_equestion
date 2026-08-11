@props([
    'slides'   => [],
    'interval' => 5000,
])

@php
    // Fall back to static default slides if none are stored in the database
    $resolvedSlides = count($slides) > 0 ? $slides : [
        [
            'image'       => 'https://images.unsplash.com/photo-1521737604893-d14cc237f11d?q=80&w=1600&auto=format&fit=crop',
            'title'       => 'We are professional',
            'text'        => "Euro Trend Group of Industries is Pakistan's largest and most reputable manufacturer of equestrian gear, with over 33 years of experience in the industry.",
            'button_text' => 'Get Started',
            'button_link' => '#',
        ],
        [
            'image'       => 'https://images.ctfassets.net/hrltx12pl8hq/5596z2BCR9KmT1KeRBrOQa/4070fd4e2f1a13f71c2c46afeb18e41c/shutterstock_451077043-hero1.jpg?fit=fill&w=1600&h=900',
            'title'       => 'Quality you can trust',
            'text'        => 'Three decades of craftsmanship, precision, and dedication to every product we make.',
            'button_text' => 'Learn More',
            'button_link' => '#',
        ],
        [
            'image'       => 'https://images.unsplash.com/photo-1521737604893-d14cc237f11d?q=80&w=1600&auto=format&fit=crop',
            'title'       => 'Built for the future',
            'text'        => 'We invest in people, technology, and processes that keep us ahead of the industry.',
            'button_text' => 'Contact Us',
            'button_link' => '#',
        ],
    ];
@endphp

@if (count($resolvedSlides) === 0)
    <div class="flex h-[420px] items-center justify-center bg-gradient-to-r from-emerald-500 to-emerald-700 text-lg font-semibold text-white">
        Hero slider ready — add slides from the dashboard.
    </div>
@else
    {{-- Unique ID for the slider instance --}}
    @php $sliderId = 'hero-slider-' . uniqid(); @endphp

    <div
        id="{{ $sliderId }}"
        class="relative w-full h-[90vh] min-h-[480px] overflow-hidden bg-black group"
    >
        {{-- Slides Container --}}
        <div class="relative w-full h-full">
            @foreach ($resolvedSlides as $i => $slide)
                <div
                    data-slide-index="{{ $i }}"
                    class="absolute inset-0 bg-cover bg-center transition-opacity duration-1000 ease-in-out {{ $i === 0 ? 'opacity-100 z-10' : 'opacity-0 z-0 pointer-events-none' }}"
                    style="background-image: url('{{ $slide['image'] ?? '' }}')"
                >
                    {{-- Overlay --}}
                    <div class="absolute inset-0 bg-black/55"></div>

                    {{-- Content --}}
                    <div class="relative z-10 flex h-full items-center justify-center px-6">
                        <div class="max-w-3xl text-center text-white">
                            @if (!empty($slide['title']))
                                <h1 class="mb-5 text-3xl font-bold md:text-5xl transform translate-y-4 transition-transform duration-700 delay-300">{{ $slide['title'] }}</h1>
                            @endif
                            @if (!empty($slide['text']))
                                <p class="mb-7 text-sm leading-relaxed text-white/90 md:text-base transform translate-y-4 transition-transform duration-700 delay-500">{{ $slide['text'] }}</p>
                            @endif
                            @if (!empty($slide['button_text']))
                                <a
                                    href="{{ $slide['button_link'] ?? '#' }}"
                                    class="inline-block rounded-full bg-emerald-500 px-9 py-3.5 font-semibold text-white transition duration-200 hover:-translate-y-0.5 hover:bg-emerald-600 transform translate-y-4 transition-transform duration-700 delay-700"
                                >
                                    {{ $slide['button_text'] }}
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @if (count($resolvedSlides) > 1)
            {{-- Navigation Arrows --}}
            <button
                type="button"
                data-slider-prev
                aria-label="Previous slide"
                class="absolute left-4 top-1/2 z-20 -translate-y-1/2 p-3 text-3xl text-white/70 transition-colors duration-200 hover:text-white cursor-pointer select-none"
            >
                &#10094;
            </button>

            <button
                type="button"
                data-slider-next
                aria-label="Next slide"
                class="absolute right-4 top-1/2 z-20 -translate-y-1/2 p-3 text-3xl text-white/70 transition-colors duration-200 hover:text-white cursor-pointer select-none"
            >
                &#10095;
            </button>

            {{-- Indicators / Dots --}}
            <div class="absolute bottom-6 left-1/2 z-20 flex -translate-x-1/2 gap-2.5">
                @foreach ($resolvedSlides as $i => $slide)
                    <button
                        type="button"
                        data-slider-dot="{{ $i }}"
                        aria-label="Go to slide {{ $i + 1 }}"
                        class="h-2.5 w-2.5 rounded-full transition-all duration-300 {{ $i === 0 ? 'scale-125 bg-white' : 'bg-white/45' }} cursor-pointer"
                    ></button>
                @endforeach
            </div>
        @endif
    </div>

    {{-- Self-contained Vanilla JavaScript controller --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const slider = document.getElementById('{{ $sliderId }}');
            if (!slider) return;

            const slides = slider.querySelectorAll('[data-slide-index]');
            const dots = slider.querySelectorAll('[data-slider-dot]');
            const nextBtn = slider.querySelector('[data-slider-next]');
            const prevBtn = slider.querySelector('[data-slider-prev]');
            const totalSlides = slides.length;
            const intervalTime = {{ $interval }};
            
            let currentIndex = 0;
            let slideInterval = null;

            function showSlide(index) {
                // Ensure index stays in bounds
                if (index >= totalSlides) index = 0;
                if (index < 0) index = totalSlides - 1;

                currentIndex = index;

                slides.forEach((slide, i) => {
                    if (i === currentIndex) {
                        slide.classList.remove('opacity-0', 'z-0', 'pointer-events-none');
                        slide.classList.add('opacity-100', 'z-10');
                    } else {
                        slide.classList.remove('opacity-100', 'z-10');
                        slide.classList.add('opacity-0', 'z-0', 'pointer-events-none');
                    }
                });

                dots.forEach((dot, i) => {
                    if (i === currentIndex) {
                        dot.classList.remove('bg-white/45');
                        dot.classList.add('scale-125', 'bg-white');
                    } else {
                        dot.classList.remove('scale-125', 'bg-white');
                        dot.classList.add('bg-white/45');
                    }
                });
            }

            function startAutoplay() {
                stopAutoplay();
                if (totalSlides <= 1) return;
                slideInterval = setInterval(() => {
                    showSlide(currentIndex + 1);
                }, intervalTime);
            }

            function stopAutoplay() {
                if (slideInterval) {
                    clearInterval(slideInterval);
                    slideInterval = null;
                }
            }

            // Event Listeners
            if (nextBtn) {
                nextBtn.addEventListener('click', () => {
                    showSlide(currentIndex + 1);
                    startAutoplay();
                });
            }

            if (prevBtn) {
                prevBtn.addEventListener('click', () => {
                    showSlide(currentIndex - 1);
                    startAutoplay();
                });
            }

            dots.forEach(dot => {
                dot.addEventListener('click', () => {
                    const targetIndex = parseInt(dot.getAttribute('data-slider-dot'));
                    showSlide(targetIndex);
                    startAutoplay();
                });
            });

            // Pause on hover
            slider.addEventListener('mouseenter', stopAutoplay);
            slider.addEventListener('mouseleave', startAutoplay);

            // Initialise
            startAutoplay();
        });
    </script>
@endif
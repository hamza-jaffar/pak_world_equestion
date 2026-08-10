@props([
    'slides' => [
        [
            'image' => 'https://images.unsplash.com/photo-1521737604893-d14cc237f11d?q=80&w=1600&auto=format&fit=crop',
            'title' => 'We are professional',
            'text' => "Euro Trend Group of Industries is Pakistan's largest and most reputable manufacturer of equestrian gear, with over 33 years of experience in the industry.",
            'button_text' => 'Get Started',
            'button_link' => '#',
        ],
        [
            'image' => 'https://images.ctfassets.net/hrltx12pl8hq/5596z2BCR9KmT1KeRBrOQa/4070fd4e2f1a13f71c2c46afeb18e41c/shutterstock_451077043-hero1.jpg?fit=fill&w=1600&h=900',
            'title' => 'Quality you can trust',
            'text' => 'Three decades of craftsmanship, precision, and dedication to every product we make.',
            'button_text' => 'Learn More',
            'button_link' => '#',
        ],
        [
            'image' => 'https://images.unsplash.com/photo-1521737604893-d14cc237f11d?q=80&w=1600&auto=format&fit=crop',
            'title' => 'Built for the future',
            'text' => 'We invest in people, technology, and processes that keep us ahead of the industry.',
            'button_text' => 'Contact Us',
            'button_link' => '#',
        ],
    ],
    'interval' => 5000,
])

<div
    x-data="heroSlider({{ $interval }}, {{ count($slides) }})"
    x-init="start()"
    @mouseenter="pause()"
    @mouseleave="start()"
    class="relative w-full h-[90vh] min-h-120 overflow-hidden"
>
    {{-- Slides track --}}
    <div
        class="flex w-full h-full transition-transform duration-700 ease-in-out"
        :style="`transform: translateX(-${current * 100}%)`"
    >
        @foreach ($slides as $i => $slide)
            <div
                class="relative flex items-center justify-center w-full h-full shrink-0 bg-cover bg-center"
                style="background-image: url('{{ $slide['image'] ?? '' }}')"
            >
                <div class="absolute inset-0 bg-black/55"></div>

                <div class="relative z-10 max-w-3xl px-6 text-center text-white">
                    @if(!empty($slide['title']))
                        <h1 class="text-3xl md:text-5xl font-bold mb-5">{{ $slide['title'] }}</h1>
                    @endif
                    @if(!empty($slide['text']))
                        <p class="text-sm md:text-base leading-relaxed text-white/90 mb-7">{{ $slide['text'] }}</p>
                    @endif
                    @if(!empty($slide['button_text']))
                        <a
                            href="{{ $slide['button_link'] ?? '#' }}"
                            class="inline-block rounded-full bg-emerald-500 hover:bg-emerald-600 px-9 py-3.5 font-semibold text-white transition-colors duration-200 hover:-translate-y-0.5 transform"
                        >
                            {{ $slide['button_text'] }}
                        </a>
                    @endif
                </div>
            </div>
        @endforeach
    </div>

    {{-- Prev / Next arrows --}}
    @if(count($slides) > 1)
        <button
            type="button"
            @click="prev()"
            aria-label="Previous slide"
            class="absolute top-1/2 left-4 z-20 -translate-y-1/2 text-3xl text-white/70 hover:text-white transition-colors duration-200 p-3"
        >
            &#10094;
        </button>
        <button
            type="button"
            @click="next()"
            aria-label="Next slide"
            class="absolute top-1/2 right-4 z-20 -translate-y-1/2 text-3xl text-white/70 hover:text-white transition-colors duration-200 p-3"
        >
            &#10095;
        </button>

        {{-- Dots --}}
        <div class="absolute bottom-6 left-1/2 z-20 flex -translate-x-1/2 gap-2.5">
            @foreach ($slides as $i => $slide)
                <button
                    type="button"
                    @click="goTo({{ $i }})"
                    aria-label="Go to slide {{ $i + 1 }}"
                    class="h-2.5 w-2.5 rounded-full transition-all duration-200"
                    :class="current === {{ $i }} ? 'bg-white scale-125' : 'bg-white/45'"
                ></button>
            @endforeach
        </div>
    @endif
</div>

@once
    @push('scripts')
        <script>
            function heroSlider(interval, total) {
                return {
                    current: 0,
                    total: total,
                    timer: null,
                    next() {
                        this.current = (this.current + 1) % this.total;
                    },
                    prev() {
                        this.current = (this.current - 1 + this.total) % this.total;
                    },
                    goTo(index) {
                        this.current = index;
                        this.restart();
                    },
                    start() {
                        if (this.total <= 1) return;
                        this.timer = setInterval(() => this.next(), interval);
                    },
                    pause() {
                        clearInterval(this.timer);
                    },
                    restart() {
                        this.pause();
                        this.start();
                    },
                }
            }
        </script>
    @endpush
@endonce
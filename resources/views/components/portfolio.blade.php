{{--
    Portfolio Component (Tailwind CSS + Alpine.js)
    --------------------------------------------------
    Save as: resources/views/components/portfolio.blade.php
    Usage:   <x-portfolio />

    DATA STRUCTURE — organized so items are easy to filter, extend, and
    reorder. Each item declares its own category *slug* (used for
    filtering) and category *label* (used for the button text + the small
    caption under the title). Filter buttons are derived automatically
    from whatever categories exist in your items — add a new category to
    an item and a new filter button appears on its own, no extra wiring.

    Override with your own portfolio any time:

        <x-portfolio :items="[
            [
                'image'    => asset('images/portfolio/gloves-1.jpg'),
                'title'    => 'Riding Gloves',
                'category' => 'riding-gloves',      // slug used for filtering
                'label'    => 'GLOVES',              // small caption + auto button text
                'url'      => '#',                    // optional link when a card is clicked
            ],
            [
                'image'    => asset('images/portfolio/garments-1.jpg'),
                'title'    => 'Riding Garments',
                'category' => 'riding-garments',
                'label'    => 'GARMENTS',
            ],
            // add as many items / categories as you want
        ]" />

    Requires: Tailwind CSS + Alpine.js
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
--}}

@props([
    'heading' => 'OUR PORTFOLIO',
    'items' => [
        [
            'image' => 'https://images.unsplash.com/photo-1553284965-83fd3e82fa5a?q=80&w=800&auto=format&fit=crop',
            'title' => 'Riding Garments',
            'category' => 'riding-garments',
            'label' => 'GARMENTS',
            'url' => '#',
        ],
        [
            'image' => 'https://images.unsplash.com/photo-1518310952931-b1de897abd40?q=80&w=800&auto=format&fit=crop',
            'title' => 'Riding Garments',
            'category' => 'riding-garments',
            'label' => 'GARMENTS',
            'url' => '#',
        ],
        [
            'image' => 'https://images.unsplash.com/photo-1618354691373-d851c5c3a990?q=80&w=800&auto=format&fit=crop',
            'title' => 'Riding Gloves',
            'category' => 'riding-gloves',
            'label' => 'GLOVES',
            'url' => '#',
        ],
        [
            'image' => 'https://images.unsplash.com/photo-1544966503-7cc531cba30d?q=80&w=800&auto=format&fit=crop',
            'title' => 'Riding Chaps',
            'category' => 'riding-chaps',
            'label' => 'CHAPS',
            'url' => '#',
        ],
    ],
])

@php
    // Build the filter-button list automatically from whatever categories
    // exist in $items, preserving first-seen order. Falls back gracefully
    // if an item is missing a category.
    $categories = [];
    foreach ($items as $item) {
        $slug = $item['category'] ?? null;
        if ($slug && !isset($categories[$slug])) {
            $categories[$slug] = $item['label'] ?? strtoupper(str_replace('-', ' ', $slug));
        }
    }
@endphp

<section class="relative bg-gray-50 py-20" x-data="{ activeFilter: 'all' }">
    <div class="max-w-6xl mx-auto px-6">

        {{-- Heading --}}
        <div class="text-center mb-8">
            <h2 class="text-3xl md:text-4xl font-extrabold tracking-wide text-gray-900">{{ $heading }}</h2>
            <span class="mt-3 inline-block h-1 w-14 bg-emerald-500 rounded-full"></span>
        </div>

        {{-- Filter buttons --}}
        <div class="flex flex-wrap justify-center gap-3 mb-10">
            <button
                type="button"
                @click="activeFilter = 'all'"
                :class="activeFilter === 'all' ? 'bg-emerald-500 text-white border-emerald-500' : 'bg-white text-gray-600 border-gray-200 hover:border-emerald-500 hover:text-emerald-600'"
                class="px-5 py-2 text-xs font-semibold tracking-wide border transition-colors duration-200"
            >
                ALL
            </button>
            @foreach ($categories as $slug => $label)
                <button
                    type="button"
                    @click="activeFilter = '{{ $slug }}'"
                    :class="activeFilter === '{{ $slug }}' ? 'bg-emerald-500 text-white border-emerald-500' : 'bg-white text-gray-600 border-gray-200 hover:border-emerald-500 hover:text-emerald-600'"
                    class="px-5 py-2 text-xs font-semibold tracking-wide border transition-colors duration-200"
                >
                    {{ strtoupper($label) }}
                </button>
            @endforeach
        </div>

        {{-- Portfolio grid --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($items as $item)
                <a
                    href="{{ $item['url'] ?? '#' }}"
                    x-show="activeFilter === 'all' || activeFilter === '{{ $item['category'] ?? '' }}'"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 scale-95"
                    x-transition:enter-end="opacity-100 scale-100"
                    class="group block bg-white shadow-sm hover:shadow-lg transition-shadow duration-300"
                >
                    <div class="overflow-hidden">
                        <img
                            src="{{ $item['image'] }}"
                            alt="{{ $item['title'] }}"
                            class="w-full h-64 object-cover transition-transform duration-500 group-hover:scale-105"
                        >
                    </div>
                    <div class="py-5 text-center">
                        <h3 class="font-semibold text-gray-900">{{ $item['title'] }}</h3>
                        <p class="mt-1 text-xs tracking-wide text-gray-400">{{ strtoupper($item['label'] ?? '') }}</p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>
<x-layouts::app :title="__('Sliders')">
    <div x-data="sliderManager()" class="space-y-6">

        {{-- ============ Header ============ --}}
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-zinc-900 dark:text-white">Manage Sliders</h1>
                <p class="text-sm text-zinc-500 dark:text-zinc-400">Manage the slider that show in landing page.</p>
            </div>

            <button
                type="button"
                @click="showForm = !showForm"
                class="inline-flex items-center gap-2 self-start rounded-md cursor-pointer bg-white hover:bg-gray-200
                       text-black font-semibold px-5 py-2.5 text-sm transition"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
                <span x-text="showForm ? 'Close' : 'Add Slider'"></span>
            </button>
        </div>

        @if (session('error'))
            <div class="rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700
                        dark:border-red-900 dark:bg-red-950 dark:text-red-400">
                {{ session('error') }}
            </div>
        @endif

        {{-- ============ Add Slider Form (hidden until button is clicked) ============ --}}
        <div
            x-show="showForm"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 -translate-y-2"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-cloak
            class="rounded-2xl border border-zinc-200 bg-white p-6 shadow-sm dark:border-zinc-700 dark:bg-zinc-900"
        >
            <h2 class="mb-4 text-lg font-semibold text-zinc-900 dark:text-white">New Slider</h2>

            <form action="{{ route('dashboard.slider.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                @csrf

                {{-- Image upload with live preview --}}
                <div>
                    <label class="mb-1 block text-sm font-medium text-zinc-700 dark:text-zinc-300">Slider Image</label>

                    <div class="flex items-center gap-4">
                        <div class="flex h-24 w-40 shrink-0 items-center justify-center overflow-hidden rounded-lg
                                    border border-dashed border-zinc-300 bg-zinc-100 dark:border-zinc-700 dark:bg-zinc-800">
                            <template x-if="preview">
                                <img :src="preview" class="h-full w-full object-cover" alt="Preview">
                            </template>
                            <template x-if="!preview">
                                <span class="text-xs text-zinc-400">No image</span>
                            </template>
                        </div>

                        <input
                            type="file"
                            name="image"
                            accept="image/*"
                            required
                            @change="onFileChange($event)"
                            class="block w-full text-sm text-zinc-600 dark:text-zinc-300
                                   file:mr-4 file:rounded-full file:border-0
                                   file:bg-emerald-50 file:px-4 file:py-2 file:text-sm file:font-medium file:text-emerald-700
                                   hover:file:bg-emerald-100"
                        >
                    </div>
                    @error('image') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                {{-- Title --}}
                <div>
                    <label for="title" class="mb-1 block text-sm font-medium text-zinc-700 dark:text-zinc-300">Title</label>
                    <input
                        type="text" id="title" name="title" value="{{ old('title') }}"
                        placeholder="We are professional"
                        class="w-full rounded-lg border-zinc-300 py-2 px-4 text-sm focus:border-emerald-500 focus:ring-emerald-500
                               dark:border-zinc-700 dark:bg-zinc-800 dark:text-white"
                    >
                    @error('title') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                {{-- Description --}}
                <div>
                    <label for="description" class="mb-1 block text-sm font-medium text-zinc-700 dark:text-zinc-300">Description</label>
                    <textarea
                        id="description" name="description" rows="3"
                        placeholder="Short supporting text shown under the title"
                        class="w-full py-2 px-4  rounded-lg border-zinc-300 text-sm focus:border-emerald-500 focus:ring-emerald-500
                               dark:border-zinc-700 dark:bg-zinc-800 dark:text-white"
                    >{{ old('description') }}</textarea>
                    @error('description') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                {{-- Button text + Button url --}}
                <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
                    <div>
                        <label for="button_text" class="mb-1 block text-sm font-medium text-zinc-700 dark:text-zinc-300">Button Text</label>
                        <input
                            type="text" id="button_text" name="button_text" value="{{ old('button_text') }}"
                            placeholder="Get Started"
                            class="w-full py-2 px-4  rounded-lg border-zinc-300 text-sm focus:border-emerald-500 focus:ring-emerald-500
                                   dark:border-zinc-700 dark:bg-zinc-800 dark:text-white"
                        >
                        @error('button_text') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="button_url" class="mb-1 block text-sm font-medium text-zinc-700 dark:text-zinc-300">Button URL</label>
                        <input
                            type="url" id="button_url" name="button_url" value="{{ old('button_url') }}"
                            placeholder="https://example.com/contact"
                            class="w-full rounded-lg py-2 px-4  border-zinc-300 text-sm focus:border-emerald-500 focus:ring-emerald-500
                                   dark:border-zinc-700 dark:bg-zinc-800 dark:text-white"
                        >
                        @error('button_url') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                </div>

                {{-- Actions --}}
                <div class="flex items-center gap-3 pt-2">
                    <button
                        type="submit"
                        class="rounded-md bg-white px-6 py-2.5 text-sm font-semibold text-black transition hover:bg-gray-200"
                    >
                        Save Slider
                    </button>
                    <button
                        type="button"
                        @click="showForm = false"
                        class="rounded-full border border-zinc-300 px-6 py-2.5 text-sm font-semibold text-zinc-600 transition
                               hover:bg-zinc-50 dark:border-zinc-700 dark:text-zinc-300 dark:hover:bg-zinc-800"
                    >
                        Cancel
                    </button>
                </div>
            </form>
        </div>

        {{-- ============ Existing Sliders list ============ --}}
                <div class="space-y-4">
            @forelse ($sliders as $slider)
                <div class="flex items-center gap-4 rounded-2xl border border-zinc-200 bg-zinc-100 p-4 shadow-sm
                            dark:border-zinc-700 dark:bg-zinc-700">
                    <img
                        src="{{ asset('storage/' . $slider->image) }}"
                        alt="{{ $slider->text }}"
                        class="h-20 w-32 shrink-0 rounded-lg object-cover"
                    >

                    <div class="min-w-0 flex-1">
                        <h3 class="truncate font-semibold text-gray-900 dark:text-white">{{ $slider->text }}</h3>
                        <p class="line-clamp-2 text-sm text-gray-500 dark:text-gray-400">{{ $slider->description }}</p>
                        <span class="mt-1 inline-block text-xs font-medium text-emerald-600 dark:text-emerald-400">
                            {{ $slider->button_text }} &rarr; {{ $slider->button_url }}
                        </span>
                    </div>

                    <div class="flex shrink-0 items-center gap-2">
                        <form action="{{ route('dashboard.slider.destroy', $slider->id) }}" method="POST"
                              onsubmit="return confirm('Delete this slider?');">
                            @csrf
                            @method('DELETE')
                            <button
                                type="submit"
                                class="rounded-md border border-red-200 px-4 py-2 text-sm font-medium text-red-500 transition
                                       hover:bg-red-50  bg-red-500/20 dark:border-red-900 dark:hover:bg-red-950"
                            >
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="rounded-2xl border border-dashed border-gray-300 p-10 text-center text-gray-400
                            dark:border-gray-700">
                    No sliders yet. Click "Add Slider" to create the first one.
                </div>
            @endforelse
        </div>
        
    </div>

    {{-- ============ Alpine state ============ --}}
    <script>
        function sliderManager() {
            return {
                showForm: false,
                preview: null,
                onFileChange(event) {
                    const file = event.target.files[0];
                    this.preview = file ? URL.createObjectURL(file) : null;
                },
            };
        }
    </script>
</x-layouts::app>
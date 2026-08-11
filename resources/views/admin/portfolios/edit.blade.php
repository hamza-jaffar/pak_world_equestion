<x-layouts::app :title="__('Edit Portfolio Item')">
    <div class="mx-auto max-w-5xl space-y-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Edit Portfolio Item</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400">Update the portfolio item details.</p>
            </div>
            <a href="{{ route('dashboard.portfolios.index') }}" class="rounded-md border border-zinc-300 px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:border-zinc-700 dark:text-gray-200 dark:hover:bg-zinc-800">
                Back
            </a>
        </div>

        <form action="{{ route('dashboard.portfolios.update', $portfolio) }}" method="POST" enctype="multipart/form-data" class="space-y-6 rounded-xl border border-zinc-200 bg-white p-6 shadow-sm dark:border-zinc-700 dark:bg-zinc-900">
            @csrf
            @method('PUT')

            {{-- Title & Image --}}
            <div class="grid gap-6 md:grid-cols-2">
                <div>
                    <label for="title" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-200">Title (e.g. Riding Gloves)</label>
                    <input id="title" name="title" type="text" value="{{ old('title', $portfolio->title) }}" class="w-full rounded-md border border-zinc-300 bg-white px-3 py-2 text-sm text-gray-900 focus:border-zinc-500 focus:outline-none dark:border-zinc-700 dark:bg-zinc-800 dark:text-white" required>
                    @error('title')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="image" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-200">Image File (leave empty to keep current)</label>
                    @if ($portfolio->image)
                        <div class="mb-2">
                            <img src="{{ $portfolio->image }}" class="h-14 w-24 rounded object-cover border border-zinc-300">
                        </div>
                    @endif
                    <input id="image" type="file" name="image" accept="image/*" class="block w-full text-sm text-zinc-600 dark:text-zinc-300 file:mr-4 file:rounded-full file:border-0 file:bg-emerald-50 file:px-4 file:py-2 file:text-sm file:font-medium file:text-emerald-700 hover:file:bg-emerald-100">
                    @error('image')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Category Slug & Label --}}
            <div class="grid gap-6 md:grid-cols-2">
                <div>
                    <label for="category" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-200">Category Slug (for sorting, e.g. riding-gloves)</label>
                    <input id="category" name="category" type="text" value="{{ old('category', $portfolio->category) }}" placeholder="riding-gloves" class="w-full rounded-md border border-zinc-300 bg-white px-3 py-2 text-sm text-gray-900 focus:border-zinc-500 focus:outline-none dark:border-zinc-700 dark:bg-zinc-800 dark:text-white" required>
                    @error('category')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="label" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-200">Category Label (upper uppercase, e.g. GLOVES)</label>
                    <input id="label" name="label" type="text" value="{{ old('label', $portfolio->label) }}" placeholder="GLOVES" class="w-full rounded-md border border-zinc-300 bg-white px-3 py-2 text-sm text-gray-900 focus:border-zinc-500 focus:outline-none dark:border-zinc-700 dark:bg-zinc-800 dark:text-white" required>
                    @error('label')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Optional URL --}}
            <div>
                <label for="url" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-200">Optional URL Link (defaults to '#')</label>
                <input id="url" name="url" type="url" value="{{ old('url', $portfolio->url) }}" class="w-full rounded-md border border-zinc-300 bg-white px-3 py-2 text-sm text-gray-900 focus:border-zinc-500 focus:outline-none dark:border-zinc-700 dark:bg-zinc-800 dark:text-white">
                @error('url')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end pt-4 border-t border-zinc-200 dark:border-zinc-700">
                <button type="submit" class="rounded-md bg-white px-5 py-2.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-zinc-300 hover:bg-gray-100 dark:bg-zinc-700 dark:text-white dark:ring-zinc-600 dark:hover:bg-zinc-600">
                    Update Item
                </button>
            </div>
        </form>
    </div>
</x-layouts::app>

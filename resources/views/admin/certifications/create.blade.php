<x-layouts::app :title="__('Create Certification')">
    <div class="mx-auto max-w-5xl space-y-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Create Certification</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400">Add a new certification logo to the website.</p>
            </div>
            <a href="{{ route('dashboard.certifications.index') }}" class="rounded-md border border-zinc-300 px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:border-zinc-700 dark:text-gray-200 dark:hover:bg-zinc-800 font-medium">
                Back
            </a>
        </div>

        <form action="{{ route('dashboard.certifications.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6 rounded-xl border border-zinc-200 bg-white p-6 shadow-sm dark:border-zinc-700 dark:bg-zinc-900">
            @csrf

            <div class="grid gap-6 md:grid-cols-2">
                <div>
                    <label for="alt" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-200">Alternative Text / Name (e.g. OEKO-TEX Standard 100)</label>
                    <input id="alt" name="alt" type="text" value="{{ old('alt') }}" class="w-full rounded-md border border-zinc-300 bg-white px-3 py-2 text-sm text-gray-900 focus:border-zinc-500 focus:outline-none dark:border-zinc-700 dark:bg-zinc-800 dark:text-white" required>
                    @error('alt')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="image" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-200">Logo Image File</label>
                    <input id="image" type="file" name="image" accept="image/*" class="block w-full text-sm text-zinc-600 dark:text-zinc-300 file:mr-4 file:rounded-full file:border-0 file:bg-emerald-50 file:px-4 file:py-2 file:text-sm file:font-medium file:text-emerald-700 hover:file:bg-emerald-100" required>
                    @error('image')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex justify-end pt-4 border-t border-zinc-200 dark:border-zinc-700">
                <button type="submit" class="rounded-md bg-white px-5 py-2.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-zinc-300 hover:bg-gray-100 dark:bg-zinc-700 dark:text-white dark:ring-zinc-600 dark:hover:bg-zinc-600">
                    Save Certification
                </button>
            </div>
        </form>
    </div>
</x-layouts::app>

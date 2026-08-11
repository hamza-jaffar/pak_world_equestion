<x-layouts::app :title="__('About Us')">
    <div class="space-y-6">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">About Us Sections</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400">Create and manage About Us sections for the website.</p>
            </div>

            <a href="{{ route('dashboard.about-us.create') }}" class="rounded-md border border-zinc-300 bg-white px-4 py-2 text-sm font-medium text-gray-800 hover:bg-gray-100 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white dark:hover:bg-zinc-700">
                + Add About Us Section
            </a>
        </div>

        @if (session('success'))
            <div class="rounded-md border border-emerald-500 bg-emerald-50 px-4 py-3 text-sm text-emerald-700 dark:bg-emerald-500/10 dark:text-emerald-300">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-hidden rounded-xl border border-zinc-200 bg-white shadow-sm dark:border-zinc-700 dark:bg-zinc-900">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-zinc-200 dark:divide-zinc-700">
                    <thead class="bg-zinc-50 dark:bg-zinc-800">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-600 dark:text-gray-300">Title</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-600 dark:text-gray-300">Question (Subheading)</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-600 dark:text-gray-300">Answer (Description)</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-600 dark:text-gray-300">Cards Count</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-600 dark:text-gray-300">Updated</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-600 dark:text-gray-300">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-200 dark:divide-zinc-700">
                        @forelse ($aboutUsList as $item)
                            <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-800/60">
                                <td class="px-4 py-3 text-sm text-gray-900 dark:text-white font-medium">{{ $item->title }}</td>
                                <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-300">{{ Str::limit($item->question, 40) }}</td>
                                <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-300">{{ Str::limit($item->answer, 50) }}</td>
                                <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-300">
                                    <span class="rounded-full bg-emerald-100 px-2.5 py-0.5 text-xs font-semibold text-emerald-800 dark:bg-emerald-500/15 dark:text-emerald-400">
                                        {{ is_array($item->card) ? count($item->card) : 0 }} cards
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-300">{{ $item->updated_at->format('M d, Y') }}</td>
                                <td class="px-4 py-3 text-sm">
                                    <div class="flex gap-2">
                                        <a href="{{ route('dashboard.about-us.edit', $item) }}" class="rounded-md border border-zinc-300 px-3 py-1.5 text-gray-700 hover:bg-gray-100 dark:border-zinc-600 dark:text-gray-200 dark:hover:bg-zinc-800">
                                            Edit
                                        </a>

                                        <button type="button" data-delete-button data-delete-route="{{ route('dashboard.about-us.destroy', $item) }}" data-delete-label="this About Us section"
                                            class="rounded-md border border-red-500 px-3 py-1.5 text-red-600 hover:bg-red-50 dark:text-red-400 dark:hover:bg-red-500/10">
                                            Delete
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-4 py-8 text-center text-sm text-gray-500 dark:text-gray-400">
                                    No About Us records found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-4">
            {{ $aboutUsList->links() }}
        </div>
    </div>

    {{-- Uses the application confirm delete modal --}}
    <x-confirm-delete-modal />
</x-layouts::app>

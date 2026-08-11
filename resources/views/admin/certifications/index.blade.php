<x-layouts::app :title="__('Certifications')">
    <div class="space-y-6">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Certifications</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400">Manage logo assets showing ISO, OEKO-TEX, and other certifications.</p>
            </div>

            <a href="{{ route('dashboard.certifications.create') }}" class="rounded-md border border-zinc-300 bg-white px-4 py-2 text-sm font-medium text-gray-800 hover:bg-gray-100 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white dark:hover:bg-zinc-700">
                + Add Certification
            </a>
        </div>

        @if (session('success'))
            <div class="rounded-md border border-emerald-500 bg-emerald-50 px-4 py-3 text-sm text-emerald-700 dark:bg-emerald-500/10 dark:text-emerald-300">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-hidden rounded-xl border border-zinc-200 bg-white shadow-sm dark:border-zinc-700 dark:bg-zinc-900 animate-fade-in">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-zinc-200 dark:divide-zinc-700">
                    <thead class="bg-zinc-50 dark:bg-zinc-800">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-600 dark:text-gray-300">Logo Image</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-600 dark:text-gray-300">Alternative Text / Name</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-600 dark:text-gray-300">Created Date</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-600 dark:text-gray-300">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-200 dark:divide-zinc-700">
                        @forelse ($certifications as $cert)
                            <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-800/60">
                                <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-300">
                                    <div class="h-12 w-24 bg-zinc-100 dark:bg-zinc-800 rounded flex items-center justify-center p-1 border border-zinc-200">
                                        <img src="{{ $cert->image }}" alt="{{ $cert->alt }}" class="max-h-full max-w-full object-contain">
                                    </div>
                                </td>
                                <td class="px-4 py-3 text-sm text-gray-900 dark:text-white font-medium">{{ $cert->alt }}</td>
                                <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-300">{{ $cert->created_at->format('M d, Y') }}</td>
                                <td class="px-4 py-3 text-sm">
                                    <div class="flex gap-2">
                                        <a href="{{ route('dashboard.certifications.edit', $cert) }}" class="rounded-md border border-zinc-300 px-3 py-1.5 text-gray-700 hover:bg-gray-100 dark:border-zinc-600 dark:text-gray-200 dark:hover:bg-zinc-800 font-medium">
                                            Edit
                                        </a>

                                        <button type="button" data-delete-button data-delete-route="{{ route('dashboard.certifications.destroy', $cert) }}" data-delete-label="this certification logo"
                                            class="rounded-md border border-red-500 px-3 py-1.5 text-red-600 hover:bg-red-50 dark:text-red-400 dark:hover:bg-red-500/10 font-medium">
                                            Delete
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-4 py-8 text-center text-sm text-gray-500 dark:text-gray-400">
                                    No certifications found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-4">
            {{ $certifications->links() }}
        </div>
    </div>

    <x-confirm-delete-modal />
</x-layouts::app>

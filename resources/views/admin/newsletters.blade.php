<x-layouts::app :title="__('Newsletter Subscribers')">
    <div class="space-y-6">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Newsletter Subscribers</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400">Manage all newsletter signups from the website.</p>
            </div>

            <form method="GET" action="{{ route('dashboard.newsletters') }}" class="flex w-full max-w-md gap-2">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search email..."
                    class="w-full rounded-md border border-zinc-300 bg-zinc-100 px-3 py-2 text-sm text-gray-900 focus:border-zinc-500 focus:outline-none dark:border-zinc-700 dark:bg-zinc-800 dark:text-white">
                <button type="submit" class="rounded-md bg-white px-4 py-2 text-sm font-medium text-gray-800 hover:bg-gray-300 cursor-pointer">
                    Search
                </button>
            </form>
        </div>

        @if (session('success'))
            <div class="rounded-md border border-emerald-500 bg-emerald-50 px-4 py-3 text-sm text-emerald-700 dark:bg-emerald-500/10 dark:text-emerald-300">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-hidden rounded-xl border border-gray-800 bg-zinc-500 shadow-sm dark:border-gray-700 shadow-2xl dark:bg-zinc-900">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-zinc-700">
                    <thead class="bg-zinc-50 dark:bg-zinc-700">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-600 dark:text-gray-300">Email</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-600 dark:text-gray-300">Subscribed At</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-600 dark:text-gray-300">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-200 dark:divide-zinc-700">
                        @forelse ($subscribers as $subscriber)
                            <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-800/60">
                                <td class="px-4 py-3 text-sm text-gray-900 dark:text-white">{{ $subscriber->email }}</td>
                                <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-300">{{ $subscriber->created_at->format('M d, Y') }}</td>
                                <td class="px-4 py-3 text-sm" data-delete-row="{{ route('dashboard.newsletters.destroy', $subscriber) }}">
                                    <button type="button" data-delete-button data-delete-route="{{ route('dashboard.newsletters.destroy', $subscriber) }}" data-delete-label="this subscriber"
                                        class="rounded-md border border-red-500 px-3 py-1.5 text-red-600 hover:bg-red-50 dark:text-red-400 dark:hover:bg-red-500/10">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-4 py-8 text-center text-sm text-gray-500 dark:text-gray-400">
                                    No newsletter subscribers found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-4">
            {{ $subscribers->links() }}
        </div>
    </div>

    <x-confirm-delete-modal />
</x-layouts::app>

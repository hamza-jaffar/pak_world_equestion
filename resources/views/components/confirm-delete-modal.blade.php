<div
    data-confirm-delete-modal
    class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black/50 p-4"
>
    <div class="w-full max-w-md rounded-2xl bg-white p-6 shadow-xl dark:bg-zinc-900">
        <div class="mb-4 flex items-start justify-between gap-4">
            <div>
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Confirm delete</h2>
                <p class="mt-2 text-sm text-gray-600 dark:text-gray-300">
                    Are you sure you want to delete <span class="font-medium" data-confirm-delete-label>this item</span>?
                </p>
            </div>
            <button type="button" data-confirm-cancel-button="top" class="text-gray-500 hover:text-gray-700 dark:text-gray-300 dark:hover:text-white">✕</button>
        </div>

        <form method="POST" data-confirm-delete-form>
            @csrf
            <input type="hidden" name="_method" value="DELETE">
            <div class="flex justify-end gap-3">
                <button type="button" data-confirm-cancel-button="bottom" class="rounded-md border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:text-gray-200 dark:hover:bg-gray-800">
                    Cancel
                </button>
                <button type="submit" data-confirm-delete-button class="rounded-md bg-red-600 px-4 py-2 text-sm font-medium text-white hover:bg-red-700">
                    Delete
                </button>
            </div>
        </form>
    </div>
</div>

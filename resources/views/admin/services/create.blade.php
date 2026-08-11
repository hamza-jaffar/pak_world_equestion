<x-layouts::app :title="__('Create Service')">
    <div class="mx-auto max-w-5xl space-y-6" x-data="serviceForm()">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Create Service</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400">Add a new service block and its optional features cards list.</p>
            </div>
            <a href="{{ route('dashboard.services.index') }}" class="rounded-md border border-zinc-300 px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:border-zinc-700 dark:text-gray-200 dark:hover:bg-zinc-800">
                Back
            </a>
        </div>

        <form action="{{ route('dashboard.services.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6 rounded-xl border border-zinc-200 bg-white p-6 shadow-sm dark:border-zinc-700 dark:bg-zinc-900">
            @csrf

            {{-- Group Header & Title --}}
            <div class="grid gap-6 md:grid-cols-2">
                <div>
                    <label for="main_header" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-200">Group Header (e.g. SERVICES, CORPORATE GOVERNANCE)</label>
                    <input id="main_header" name="main_header" type="text" value="{{ old('main_header', 'SERVICES') }}" class="w-full rounded-md border border-zinc-300 bg-white px-3 py-2 text-sm text-gray-900 focus:border-zinc-500 focus:outline-none dark:border-zinc-700 dark:bg-zinc-800 dark:text-white" required>
                    @error('main_header')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="title" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-200">Service Title (e.g. CODE OF CONDUCT, TEAM, R&D)</label>
                    <input id="title" name="title" type="text" value="{{ old('title') }}" class="w-full rounded-md border border-zinc-300 bg-white px-3 py-2 text-sm text-gray-900 focus:border-zinc-500 focus:outline-none dark:border-zinc-700 dark:bg-zinc-800 dark:text-white" required>
                    @error('title')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Description --}}
            <div>
                <label for="description" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-200">Service Description</label>
                <textarea id="description" name="description" rows="5" class="w-full rounded-md border border-zinc-300 bg-white px-3 py-2 text-sm text-gray-900 focus:border-zinc-500 focus:outline-none dark:border-zinc-700 dark:bg-zinc-800 dark:text-white" required>{{ old('description') }}</textarea>
                @error('description')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Optional Image Banner --}}
            <div class="p-5 rounded-xl border border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-800/40 space-y-4">
                <h3 class="text-sm font-bold text-gray-900 dark:text-white">Optional Image Banner (e.g. Greener Future banner)</h3>
                
                <div class="grid gap-4 md:grid-cols-2">
                    <div>
                        <label for="image" class="mb-1 block text-xs font-semibold text-gray-700 dark:text-gray-300">Banner Image File</label>
                        <input id="image" type="file" name="image" accept="image/*" class="block w-full text-xs text-zinc-600 dark:text-zinc-300 file:mr-4 file:rounded-full file:border-0 file:bg-emerald-50 file:px-4 file:py-1.5 file:text-xs file:font-medium file:text-emerald-700 hover:file:bg-emerald-100">
                        @error('image')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="image_text" class="mb-1 block text-xs font-semibold text-gray-700 dark:text-gray-300">Banner Title Text (e.g. PATH TO A GREENER FUTURE)</label>
                        <input id="image_text" name="image_text" type="text" value="{{ old('image_text') }}" placeholder="e.g. PATH TO A GREENER FUTURE" class="w-full rounded-md border border-zinc-300 bg-white px-3 py-1.5 text-xs text-gray-900 focus:border-zinc-500 focus:outline-none dark:border-zinc-700 dark:bg-zinc-800 dark:text-white">
                        @error('image_text')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- Dynamic cards list --}}
            <div class="border-t border-zinc-200 pt-6 dark:border-zinc-700">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Feature Cards / Conduct Details</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Add cards to display specific stats, highlights or compliance elements. (Optional)</p>
                    </div>
                    <button type="button" @click="addCard()" class="rounded-md bg-emerald-500 px-4 py-2 text-sm font-semibold text-white hover:bg-emerald-600">
                        + Add Card Item
                    </button>
                </div>

                <div class="space-y-6">
                    <template x-for="(card, index) in cards" :key="index">
                        <div class="relative p-5 rounded-xl border border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-800/50 space-y-4">
                            
                            <div class="flex items-center justify-between border-b border-zinc-200 pb-2 dark:border-zinc-700">
                                <span class="text-sm font-bold text-gray-700 dark:text-gray-300">Card #<span x-text="index + 1"></span></span>
                                <button type="button" @click="removeCard(index)" class="text-sm font-semibold text-red-500 hover:text-red-700">
                                    Remove
                                </button>
                            </div>

                            <div class="grid gap-4 md:grid-cols-2">
                                <div>
                                    <label class="mb-1 block text-xs font-semibold text-gray-700 dark:text-gray-300">Card Title (e.g. Low Turnover Rate)</label>
                                    <input type="text" :name="'cards[' + index + '][title]'" x-model="card.title" placeholder="e.g. Low Turnover Rate:" class="w-full rounded-md border border-zinc-300 bg-white px-3 py-1.5 text-xs text-gray-900 focus:border-zinc-500 focus:outline-none dark:border-zinc-700 dark:bg-zinc-800 dark:text-white" required>
                                </div>
                                <div>
                                    <label class="mb-1 block text-xs font-semibold text-gray-700 dark:text-gray-300">Icon Type (or custom SVG code)</label>
                                    <textarea :name="'cards[' + index + '][icon]'" x-model="card.icon" rows="1" placeholder="e.g. shield, recycle, solar, or raw SVG code" class="w-full rounded-md border border-zinc-300 bg-white px-3 py-1.5 text-xs font-mono text-gray-900 focus:border-zinc-500 focus:outline-none dark:border-zinc-700 dark:bg-zinc-800 dark:text-white"></textarea>
                                </div>
                            </div>

                            <div>
                                <label class="mb-1 block text-xs font-semibold text-gray-700 dark:text-gray-300">Card Description / Value Text</label>
                                <textarea :name="'cards[' + index + '][description]'" x-model="card.description" rows="2" placeholder="e.g. Under 9% turnover, reducing recruitment and training costs." class="w-full rounded-md border border-zinc-300 bg-white px-3 py-1.5 text-xs text-gray-900 focus:border-zinc-500 focus:outline-none dark:border-zinc-700 dark:bg-zinc-800 dark:text-white" required></textarea>
                            </div>

                        </div>
                    </template>

                    <div x-show="cards.length === 0" class="rounded-xl border border-dashed border-zinc-300 p-8 text-center text-zinc-400 dark:border-zinc-700">
                        No cards added yet. Click "+ Add Card Item" to expand details.
                    </div>
                </div>
            </div>

            <div class="flex justify-end pt-4 border-t border-zinc-200 dark:border-zinc-700">
                <button type="submit" class="rounded-md bg-white px-5 py-2.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-zinc-300 hover:bg-gray-100 dark:bg-zinc-700 dark:text-white dark:ring-zinc-600 dark:hover:bg-zinc-600">
                    Save Service
                </button>
            </div>
        </form>
    </div>

    <script>
        function serviceForm() {
            return {
                cards: [],
                addCard() {
                    this.cards.push({
                        title: '',
                        icon: '',
                        description: ''
                    });
                },
                removeCard(index) {
                    this.cards.splice(index, 1);
                }
            };
        }
    </script>
</x-layouts::app>

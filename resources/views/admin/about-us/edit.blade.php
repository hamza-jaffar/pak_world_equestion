<x-layouts::app :title="__('Edit About Us Section')">
    <div class="mx-auto max-w-5xl space-y-6" x-data="aboutUsForm()">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Edit About Us Section</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400">Edit the About Us configuration and its cards list.</p>
            </div>
            <a href="{{ route('dashboard.about-us.index') }}" class="rounded-md border border-zinc-300 px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:border-zinc-700 dark:text-gray-200 dark:hover:bg-zinc-800">
                Back
            </a>
        </div>

        <form action="{{ route('dashboard.about-us.update', $aboutUs) }}" method="POST" enctype="multipart/form-data" class="space-y-6 rounded-xl border border-zinc-200 bg-white p-6 shadow-sm dark:border-zinc-700 dark:bg-zinc-900">
            @csrf
            @method('PUT')

            {{-- Title & Question --}}
            <div class="grid gap-6 md:grid-cols-2">
                <div>
                    <label for="title" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-200">Heading (Title)</label>
                    <input id="title" name="title" type="text" value="{{ old('title', $aboutUs->title) }}" class="w-full rounded-md border border-zinc-300 bg-white px-3 py-2 text-sm text-gray-900 focus:border-zinc-500 focus:outline-none dark:border-zinc-700 dark:bg-zinc-800 dark:text-white" required>
                    @error('title')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="question" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-200">Subheading (Question)</label>
                    <input id="question" name="question" type="text" value="{{ old('question', $aboutUs->question) }}" class="w-full rounded-md border border-zinc-300 bg-white px-3 py-2 text-sm text-gray-900 focus:border-zinc-500 focus:outline-none dark:border-zinc-700 dark:bg-zinc-800 dark:text-white" required>
                    @error('question')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Answer (Description) --}}
            <div>
                <label for="answer" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-200">Description (Answer)</label>
                <textarea id="answer" name="answer" rows="5" class="w-full rounded-md border border-zinc-300 bg-white px-3 py-2 text-sm text-gray-900 focus:border-zinc-500 focus:outline-none dark:border-zinc-700 dark:bg-zinc-800 dark:text-white" required>{{ old('answer', $aboutUs->answer) }}</textarea>
                @error('answer')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Cards section --}}
            <div class="border-t border-zinc-200 pt-6 dark:border-zinc-700">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Cards List</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Add cards to describe your mission, vision, plan, etc. Each card contains an image, video, SVG icon, title, and description.</p>
                    </div>
                    <button type="button" @click="addCard()" class="rounded-md bg-emerald-500 px-4 py-2 text-sm font-semibold text-white hover:bg-emerald-600">
                        + Add Card
                    </button>
                </div>

                {{-- Card loop --}}
                <div class="space-y-6">
                    <template x-for="(card, index) in cards" :key="index">
                        <div class="relative p-5 rounded-xl border border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-800/50 space-y-4">
                            
                            {{-- Header index and remove button --}}
                            <div class="flex items-center justify-between border-b border-zinc-200 pb-2 dark:border-zinc-700">
                                <span class="text-sm font-bold text-gray-700 dark:text-gray-300">Card #<span x-text="index + 1"></span></span>
                                <button type="button" @click="removeCard(index)" class="text-sm font-semibold text-red-500 hover:text-red-700">
                                    Remove Card
                                </button>
                            </div>

                            {{-- Card Title & SVG Icon --}}
                            <div class="grid gap-4 md:grid-cols-2">
                                <div>
                                    <label class="mb-1 block text-xs font-semibold text-gray-700 dark:text-gray-300">Card Title</label>
                                    <input type="text" :name="'cards[' + index + '][title]'" x-model="card.title" placeholder="e.g. Our Mission" class="w-full rounded-md border border-zinc-300 bg-white px-3 py-1.5 text-xs text-gray-900 focus:border-zinc-500 focus:outline-none dark:border-zinc-700 dark:bg-zinc-800 dark:text-white" required>
                                </div>
                                <div>
                                    <label class="mb-1 block text-xs font-semibold text-gray-700 dark:text-gray-300">Card Icon SVG Code</label>
                                    <textarea :name="'cards[' + index + '][icon]'" x-model="card.icon" rows="1" placeholder='e.g. <svg>...</svg>' class="w-full rounded-md border border-zinc-300 bg-white px-3 py-1.5 text-xs font-mono text-gray-900 focus:border-zinc-500 focus:outline-none dark:border-zinc-700 dark:bg-zinc-800 dark:text-white"></textarea>
                                </div>
                            </div>

                            {{-- Card Description --}}
                            <div>
                                <label class="mb-1 block text-xs font-semibold text-gray-700 dark:text-gray-300">Card Description</label>
                                <textarea :name="'cards[' + index + '][description]'" x-model="card.description" rows="3" placeholder="Explain the card details..." class="w-full rounded-md border border-zinc-300 bg-white px-3 py-1.5 text-xs text-gray-900 focus:border-zinc-500 focus:outline-none dark:border-zinc-700 dark:bg-zinc-800 dark:text-white" required></textarea>
                            </div>

                            {{-- Hidden inputs to retain existing image and video if not re-uploaded --}}
                            <input type="hidden" :name="'cards[' + index + '][existing_image]'" x-model="card.existing_image">
                            <input type="hidden" :name="'cards[' + index + '][existing_video]'" x-model="card.existing_video">

                            {{-- Previews and File Inputs --}}
                            <div class="grid gap-4 md:grid-cols-2">
                                <div>
                                    <label class="mb-1 block text-xs font-semibold text-gray-700 dark:text-gray-300">Image File</label>
                                    <template x-if="card.existing_image">
                                        <div class="mb-2 flex items-center gap-2">
                                            <img :src="card.existing_image" class="h-12 w-20 rounded object-cover border border-zinc-300">
                                            <span class="text-[10px] text-zinc-500">Keep current or upload new</span>
                                        </div>
                                    </template>
                                    <input type="file" :name="'cards[' + index + '][image]'" accept="image/*" class="block w-full text-xs text-zinc-600 dark:text-zinc-300 file:mr-4 file:rounded-full file:border-0 file:bg-emerald-50 file:px-4 file:py-1.5 file:text-xs file:font-medium file:text-emerald-700 hover:file:bg-emerald-100">
                                </div>
                                <div>
                                    <label class="mb-1 block text-xs font-semibold text-gray-700 dark:text-gray-300">Video File</label>
                                    <template x-if="card.existing_video">
                                        <div class="mb-2 flex flex-col gap-1">
                                            <a :href="card.existing_video" target="_blank" class="text-xs text-emerald-600 dark:text-emerald-400 hover:underline">View current video</a>
                                            <span class="text-[10px] text-zinc-500">Keep current or upload new</span>
                                        </div>
                                    </template>
                                    <input type="file" :name="'cards[' + index + '][video]'" accept="video/*" class="block w-full text-xs text-zinc-600 dark:text-zinc-300 file:mr-4 file:rounded-full file:border-0 file:bg-emerald-50 file:px-4 file:py-1.5 file:text-xs file:font-medium file:text-emerald-700 hover:file:bg-emerald-100">
                                </div>
                            </div>

                        </div>
                    </template>

                    {{-- Empty card list state --}}
                    <div x-show="cards.length === 0" class="rounded-xl border border-dashed border-zinc-300 p-8 text-center text-zinc-400 dark:border-zinc-700">
                        No cards added yet. Click "+ Add Card" to add your first card.
                    </div>
                </div>
            </div>

            <div class="flex justify-end pt-4 border-t border-zinc-200 dark:border-zinc-700">
                <button type="submit" class="rounded-md bg-white px-5 py-2.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-zinc-300 hover:bg-gray-100 dark:bg-zinc-700 dark:text-white dark:ring-zinc-600 dark:hover:bg-zinc-600">
                    Update Section
                </button>
            </div>
        </form>
    </div>

    {{-- Alpine setup script prefilled with existing card array data --}}
    <script>
        function aboutUsForm() {
            // Load existing cards from the database json array
            const existingCards = @json(is_array($aboutUs->card) ? $aboutUs->card : []);
            
            // Map keys appropriately to match Alpine form fields
            const cards = existingCards.map(c => ({
                title: c.title || '',
                description: c.description || c.text || '',
                icon: c.icon || '',
                existing_image: c.image || '',
                existing_video: c.video || ''
            }));

            return {
                cards: cards,
                addCard() {
                    this.cards.push({
                        title: '',
                        description: '',
                        icon: '',
                        existing_image: '',
                        existing_video: ''
                    });
                },
                removeCard(index) {
                    this.cards.splice(index, 1);
                }
            };
        }
    </script>
</x-layouts::app>

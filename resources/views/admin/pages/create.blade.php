<x-layouts::app :title="__('Create Page')">
    <div class="mx-auto max-w-5xl space-y-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Create Page</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400">Use the editor below to write content with images and formatting.</p>
            </div>
            <a href="{{ route('dashboard.pages') }}" class="rounded-md border border-zinc-300 px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:border-zinc-700 dark:text-gray-200 dark:hover:bg-zinc-800">
                Back
            </a>
        </div>

        <form action="{{ route('dashboard.pages.store') }}" method="POST" class="space-y-6 rounded-xl border border-zinc-200 bg-white p-6 shadow-sm dark:border-zinc-700 dark:bg-zinc-900">
            @csrf

            <div class="grid gap-6 md:grid-cols-2">
                <div>
                    <label for="name" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-200">Page Name</label>
                    <input id="name" name="name" type="text" value="{{ old('name') }}" class="w-full rounded-md border border-zinc-300 bg-white px-3 py-2 text-sm text-gray-900 focus:border-zinc-500 focus:outline-none dark:border-zinc-700 dark:bg-zinc-800 dark:text-white" placeholder="Privacy Policy" required>
                    @error('name')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="slug" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-200">Slug</label>
                    <select id="slug" name="slug" class="w-full rounded-md border border-zinc-300 bg-white px-3 py-2 text-sm text-gray-900 focus:border-zinc-500 focus:outline-none dark:border-zinc-700 dark:bg-zinc-800 dark:text-white">
                        <option value="privacy-policy" {{ old('slug') === 'privacy-policy' ? 'selected' : '' }}>Privacy Policy</option>
                        <option value="terms-of-service" {{ old('slug') === 'terms-of-service' ? 'selected' : '' }}>Terms of Service</option>
                    </select>
                    @error('slug')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid gap-6 md:grid-cols-2">
                <div>
                    <label for="meta_title" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-200">Meta Title</label>
                    <input id="meta_title" name="meta_title" type="text" value="{{ old('meta_title') }}" class="w-full rounded-md border border-zinc-300 bg-white px-3 py-2 text-sm text-gray-900 focus:border-zinc-500 focus:outline-none dark:border-zinc-700 dark:bg-zinc-800 dark:text-white" placeholder="Privacy Policy">
                </div>

                <div>
                    <label for="is_active" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-200">Status</label>
                    <select id="is_active" name="is_active" class="w-full rounded-md border border-zinc-300 bg-white px-3 py-2 text-sm text-gray-900 focus:border-zinc-500 focus:outline-none dark:border-zinc-700 dark:bg-zinc-800 dark:text-white">
                        <option value="1" {{ old('is_active', true) ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ old('is_active') === '0' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
            </div>

            <div>
                <label for="meta_description" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-200">Meta Description</label>
                <textarea id="meta_description" name="meta_description" rows="3" class="w-full rounded-md border border-zinc-300 bg-white px-3 py-2 text-sm text-gray-900 focus:border-zinc-500 focus:outline-none dark:border-zinc-700 dark:bg-zinc-800 dark:text-white" placeholder="Short description for SEO...">{{ old('meta_description') }}</textarea>
            </div>

            <div>
                <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-200">Page Content</label>
                <textarea id="page-editor" name="content" class="hidden">{{ old('content') }}</textarea>
                <div id="editor" class="min-h-[300px] rounded-md border border-zinc-300 bg-white p-3 text-gray-900 shadow-sm dark:border-zinc-700 dark:bg-zinc-800 dark:text-white"></div>
                @error('content')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end">
                <button type="submit" class="rounded-md bg-white px-5 py-2.5 text-sm font-medium text-gray-900 shadow-sm ring-1 ring-zinc-300 hover:bg-gray-100 dark:bg-zinc-700 dark:text-white dark:ring-zinc-600 dark:hover:bg-zinc-600">
                    Save Page
                </button>
            </div>
        </form>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet">

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const quill = new Quill('#editor', {
                    theme: 'snow',
                    modules: {
                        toolbar: [
                            [{ header: [1, 2, 3, false] }],
                            ['bold', 'italic', 'underline', 'strike'],
                            [{ list: 'ordered' }, { list: 'bullet' }],
                            ['link', 'image', 'blockquote', 'code-block'],
                            [{ align: [] }],
                            ['clean']
                        ],
                    },
                    placeholder: 'Start writing your page content here...'
                });

                const hiddenInput = document.getElementById('page-editor');
                const initialValue = hiddenInput.value;
                if (initialValue) {
                    quill.clipboard.dangerouslyPasteHTML(initialValue);
                }

                const form = hiddenInput.closest('form');
                form.addEventListener('submit', function () {
                    hiddenInput.value = quill.root.innerHTML;
                });

                const imageHandler = () => {
                    const input = document.createElement('input');
                    input.setAttribute('type', 'file');
                    input.setAttribute('accept', 'image/*');
                    input.click();

                    input.onchange = async () => {
                        const file = input.files[0];
                        if (!file) return;

                        const formData = new FormData();
                        formData.append('file', file);

                        const response = await fetch('{{ route('dashboard.pages.upload-image') }}', {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'X-Requested-With': 'XMLHttpRequest',
                            }
                        });

                        const data = await response.json();
                        if (!response.ok || !data.location) {
                            alert('Image upload failed.');
                            return;
                        }

                        const range = quill.getSelection(true);
                        quill.insertEmbed(range.index, 'image', data.location);
                        quill.setSelection(range.index + 1);
                    };
                };

                const toolbar = quill.getModule('toolbar');
                toolbar.addHandler('image', imageHandler);
            });
        </script>
    @endpush
</x-layouts::app>

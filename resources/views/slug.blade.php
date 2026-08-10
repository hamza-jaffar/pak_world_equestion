<x-layouts::guest>
    <main class="mt-20 mx-auto max-w-4xl px-4 py-12 sm:px-6 lg:px-8">
        <article class="bg-white">
            <header class="mb-8 border-b border-zinc-200 pb-6">
                <h1 class="text-3xl font-bold tracking-tight text-zinc-900 sm:text-4xl">
                    {{ $page->name }}
                </h1>
            </header>

            <div class="prose prose-zinc max-w-none prose-headings:font-semibold prose-p:text-base prose-p:leading-7 prose-a:text-blue-600 prose-img:rounded-lg">
                {!! $page->content !!}
            </div>
        </article>
    </main>
</x-layouts::guest>
<x-layouts::guest>
    <section class="mt-12">
        @if (isset($aboutUs) && $aboutUs)
            <x-about-us 
                :heading="$aboutUs->title" 
                :subheading="$aboutUs->question" 
                :description="$aboutUs->answer" 
                :cards="$aboutUs->card" 
            />
        @else
            <x-about-us />
        @endif
    </section>
</x-layouts::guest>
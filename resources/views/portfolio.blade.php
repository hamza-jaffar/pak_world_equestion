<x-layouts::guest>
    <section class="mt-12">
        @if (isset($portfolioItems) && count($portfolioItems) > 0)
            <x-portfolio :items="$portfolioItems" />
        @else
            <x-portfolio />
        @endif

        @if ((isset($certifications) && count($certifications) > 0) || (isset($members) && count($members) > 0))
            <x-certifications-members
                :certifications="$certifications ?? []"
                :members="$members ?? []"
            />
        @else
            <x-certifications-members />
        @endif
    </section>
</x-layouts::guest>
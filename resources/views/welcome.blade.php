<x-layouts::guest>
    <section>
        <x-hero-slider :slides="$slides ?? []" />

        {{-- About Us (from DB if available, else static defaults) --}}
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

        {{-- Services (from DB if available, else static fallback sections) --}}
        <section id="services">
            @if (isset($services) && $services->count() > 0)
                @php $firstService = true; @endphp
                @foreach ($services as $service)
                    <section id="service-{{ $service->id }}">
                        <x-service-detail
                            :eyebrow="$service->main_header"
                            :title="$service->title"
                            :description="$service->description"
                            :show-eyebrow="$firstService"
                            :features="collect($service->cards ?? [])->map(fn($c) => [
                                'icon'  => $c['icon'] ?? 'shield',
                                'title' => $c['title'] ?? '',
                                'text'  => $c['description'] ?? '',
                            ])->toArray()"
                        />
                        @if (!empty($service->image))
                            <x-image-banner :image="$service->image" :title="$service->image_text ?? ''" />
                        @endif
                    </section>
                    @php $firstService = false; @endphp
                @endforeach
            @else
                {{-- Static fallback --}}
                <section id="corporate-governance">
                    <x-service-detail
                        eyebrow="SERVICES"
                        title="CORPORATE GOVERNANCE"
                        description="Euro Trend Group of Industries upholds high standards of corporate governance, ensuring ethical practices, transparency, and accountability."
                        :features="[
                            ['icon' => 'shield', 'title' => 'Fair Labor Practices:', 'text' => '2.5% absenteeism rate, reflecting strong employee engagement.'],
                            ['icon' => 'recycle', 'title' => 'Low Turnover Rate:', 'text' => 'Under 9% turnover, reducing high retention and job stability.'],
                            ['icon' => 'shield', 'title' => 'Health and Safety Compliance:', 'text' => '100% of facilities meet international safety standards.'],
                        ]"
                    />
                </section>

                <section id="greener-future">
                    <x-image-banner
                        image="https://images.unsplash.com/photo-1441974231531-c6227db76b6e?q=80&w=1600&auto=format&fit=crop"
                        title="PATH TO A GREENER FUTURE" />
                </section>

                <section id="team">
                    <x-service-detail :show-eyebrow="false" title="TEAM"
                        description="At Euro Trend Group of Industries, our team is united by a shared commitment to excellence, innovation, and craftsmanship."
                        :features="[]" />
                </section>

                <section id="rd">
                    <x-service-detail :show-eyebrow="false" title="A STRIKING FORCE OF INNOVATION (R&D)"
                        description="Euro Trend Group of Industries is dedicated to innovation through a robust R&D program."
                        :features="[]" />
                </section>

                <section id="director">
                    <x-service-detail :show-eyebrow="false" title="WORDS FROM THE DIRECTOR"
                        description="At Euro Trend Group of Industries, we believe that production without compromise is the true measure of success."
                        :features="[]" />
                </section>

                <section id="delivery">
                    <x-service-detail :show-eyebrow="false" title="DELIVERY"
                        description="At Euro Trend, on-time delivery is key to our commitment. We offer both air and sea freight options."
                        :features="[]" />
                </section>
            @endif
        </section>

        {{-- Portfolio (from DB if available, else static defaults) --}}
        @if (isset($portfolioItems) && count($portfolioItems) > 0)
            <x-portfolio :items="$portfolioItems" />
        @else
            <x-portfolio />
        @endif

        {{-- Certifications & Members (from DB if available, else static defaults) --}}
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
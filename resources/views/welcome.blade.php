<x-layouts::guest>
    <section>
        <x-hero-slider />
        <x-about-us />
        <section id="corporate-governance">
            <x-service-detail title="CODE OF CONDUCT"
                description="Euro Trend Group of Industries' Code of Conduct is foundational to our operations, guiding our commitment to ethical business practices and integrity. It emphasizes fairness through rigorous quality control, respecting labor and hiring practices, and maintaining transparency and accountability. We adhere to fair labor practices, including safe working conditions and fair wages, and encourage transparent communication where employees can voice concerns without fear of retribution. By upholding these principles, Euro Trend Group of Industries builds trust with stakeholders and continues its reputation as a responsible leader in the equestrian gear industry."
                :features="[
        ['icon' => 'shield', 'title' => 'Fair Labor Practices:', 'text' => '2.5 % absenteeism rate, reflecting strong employee engagement.'],
        ['icon' => 'recycle', 'title' => 'Low Turnover Rate:', 'text' => 'Under 9% turnover, reducing high retention and job stability.'],
        ['icon' => 'shield', 'title' => 'Health and Safety Compliance:', 'text' => '100% of facilities meet international safety standards, with zero workplace incidents reported this past year.'],
    ]" />
        </section>

        {{-- Code of Conduct --}}
        <section id="code-of-conduct">
            <x-service-detail :show-eyebrow="false" title="CODE OF CONDUCT"
                description="Euro Trend Group of Industries' Code of Conduct is foundational to our operations, guiding our commitment to ethical business practices and integrity. It emphasizes fairness through rigorous quality control, respecting labor and hiring practices, and maintaining transparency and accountability. We adhere to fair labor practices, including safe working conditions and fair wages, and encourage transparent communication where employees can voice concerns without fear of retribution. By upholding these principles, Euro Trend Group of Industries builds trust with stakeholders and continues its reputation as a responsible leader in the equestrian gear industry."
                :features="[
        ['icon' => 'shield', 'title' => 'Fair Labor Practices:', 'text' => '2.5 % absenteeism rate, reflecting strong employee engagement.'],
        ['icon' => 'recycle', 'title' => 'Low Turnover Rate:', 'text' => 'Under 9% turnover, reducing high retention and job stability.'],
        ['icon' => 'shield', 'title' => 'Health and Safety Compliance:', 'text' => '100% of facilities meet international safety standards, with zero workplace incidents reported this past year.'],
    ]" />
        </section>

        {{-- Path to a Greener Future --}}
        <section id="greener-future">
            <x-image-banner
                image="https://images.unsplash.com/photo-1441974231531-c6227db76b6e?q=80&w=1600&auto=format&fit=crop"
                title="PATH TO A GREENER FUTURE" />
        </section>

        {{-- Team --}}
        <section id="team">
            <x-service-detail :show-eyebrow="false" title="TEAM"
                description="At Euro Trend Group of Industries, our team is united by a shared commitment to excellence, innovation, and craftsmanship. Our Total Quality Management (TQM) approach means that every team member holds themselves and each other to exceptional standards, contributing their expertise across design, manufacturing, and quality control. Our focus on continuous learning helps our team stay ahead of industry trends while working closely with clients and partners to deliver equestrian products that meet the highest expectations for performance, comfort, and durability."
                :features="[]" />
        </section>

        {{-- R&D --}}
        <section id="rd">
            <x-service-detail :show-eyebrow="false" title="A STRIKING FORCE OF INNOVATION (R&D)"
                description="Euro Trend Group of Industries is dedicated to innovation through a robust research and development (R&D) program that supports both product and process improvements. We invest heavily in exploring new materials and technologies to enhance the performance, safety, and sustainability of our equestrian gear. Our R&D team works closely with manufacturing to pilot new methods, refine production processes, and ensure product consistency, all while remaining committed to environmental responsibility. We aim to be at the forefront of the industry by developing durable, sustainable, and innovative products that consistently exceed expectations."
                :features="[]" />
        </section>

        {{-- Words from the Director --}}
        <section id="director">
            <x-service-detail :show-eyebrow="false" title="WORDS FROM THE DIRECTOR"
                description="At Euro Trend Group of Industries, we believe that production without compromise is the true measure of success. Our vision is to provide riders around the world with equestrian gear that combines exceptional quality, comfort, and durability. It's this dedication to the boundaries of craftsmanship and innovation that drives everything we do, from sourcing sustainable materials to refining every stitch and detail with unmatched precision and care."
                :features="[]" />
        </section>

        {{-- Delivery --}}
        <section id="delivery">
            <x-service-detail :show-eyebrow="false" title="DELIVERY"
                description="At Euro Trend, on-time delivery is key to our commitment. To meet strict deadlines, we offer both air and sea freight options for exceptional flexibility, allowing us to schedule shipments efficiently while offering high standards of product quality. Our team is equipped to handle both large and small orders alike, ensuring consistent quality control throughout, and we remain proactive in exploring new logistics and shipping partnerships to keep our customers satisfied with reliable, on-time delivery."
                :features="[]" />
        </section>
        <x-portfolio />
        <x-certifications-members />
    </section>
</x-layouts::guest>
@php
    $siteEmail = \App\Models\Settings::value('site_email', 'ahmed@eurotrend.pk');
    $sitePhone = \App\Models\Settings::value('site_phone', '(052) 3575231');
    $siteAddress = \App\Models\Settings::value('site_address', "Daska Rd\nDakwala Stop, Sadra Badra\nSialkot, Punjab 51310");
    $mapIframe = \App\Models\Settings::value('map_iframe_url', 'https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d250.08366502394213!2d74.5226981775474!3d32.50714408330223!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2s!4v1786396049543!5m2!1sen!2s');
    $addressLines = preg_split('/\r\n|\r|\n/', $siteAddress);
@endphp

<x-layouts::guest>
    <section class="mt-20">
        <section id="contact-form" class="bg-gray-50 mt-12 py-16 px-6">
            <div class="max-w-6xl mx-auto">

                @if (session('success'))
                    <div class="mb-6 rounded-md border border-emerald-500 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="mb-6 rounded-md border border-red-500 bg-red-50 px-4 py-3 text-sm text-red-700">
                        {{ session('error') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-6 rounded-md border border-red-500 bg-red-50 px-4 py-3 text-sm text-red-700">
                        <ul class="list-disc pl-5 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="text-center mb-14">
                    <h2 class="text-3xl font-extrabold tracking-wide text-gray-900">CONTACT US</h2>
                    <div class="w-12 h-0.5 bg-emerald-500 mx-auto mt-3"></div>
                </div>

                <div class="grid grid-cols-3 divide-x divide-gray-300 mb-14 text-center">
                    <div class="px-6 pb-8 sm:pb-0">
                        <flux:icon.map-pin class="w-8 h-8 mx-auto text-emerald-500 mb-3" />
                        <h3 class="text-sm font-semibold tracking-widest text-gray-500 mb-2">ADDRESS</h3>
                        <div class="text-gray-800">
                            @foreach ($addressLines as $line)
                                <p>{{ trim($line) }}</p>
                            @endforeach
                        </div>
                    </div>

                    <div class="px-6 py-8 sm:py-0">
                        <flux:icon.phone class="w-8 h-8 mx-auto text-emerald-500 mb-3" />
                        <h3 class="text-sm font-semibold tracking-widest text-gray-500 mb-2">PHONE NUMBER</h3>
                        <p class="text-gray-800">{{ $sitePhone }}</p>
                    </div>

                    <div class="px-6 pt-8 sm:pt-0">
                        <flux:icon.envelope class="w-8 h-8 mx-auto text-emerald-500 mb-3" />
                        <h3 class="text-sm font-semibold tracking-widest text-gray-500 mb-2">EMAIL</h3>
                        <p class="text-gray-800">{{ $siteEmail }}</p>
                    </div>
                </div>

                <form method="POST" action="{{ route('contact.store') }}" data-ajax-form class="max-w-5xl mx-auto space-y-6">
                    @csrf

                    <div data-form-status class="hidden rounded-md border px-4 py-3 text-sm"></div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <input type="text" name="name" placeholder="Your Name" value="{{ old('name') }}"
                            class="w-full border border-gray-300 rounded-sm px-4 py-3 text-gray-700 placeholder-gray-400 bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500"
                            required />
                        <input type="email" name="email" placeholder="Your Email" value="{{ old('email') }}"
                            class="w-full border border-gray-300 rounded-sm px-4 py-3 text-gray-700 placeholder-gray-400 bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500"
                            required />
                    </div>

                    <input type="text" name="subject" placeholder="Subject" value="{{ old('subject') }}"
                        class="w-full border border-gray-300 rounded-sm px-4 py-3 text-gray-700 placeholder-gray-400 bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500"
                        required />

                    <textarea name="message" rows="6" placeholder="Message"
                        class="w-full border border-gray-300 rounded-sm px-4 py-3 text-gray-700 placeholder-gray-400 bg-white resize-y focus:outline-none focus:ring-2 focus:ring-emerald-500"
                        required>{{ old('message') }}</textarea>

                    <div class="text-center pt-2">
                        <button type="submit"
                            class="inline-block bg-emerald-500 hover:bg-emerald-600 text-white font-medium text-sm tracking-wide px-8 py-3 rounded-sm transition-colors">
                            Send Message
                        </button>
                    </div>
                </form>

            </div>

            <div class="mt-10">
                <iframe class="w-full mx-auto" src="{{ $mapIframe }}" width="1500" height="600" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="strict-origin-when-cross-origin"></iframe>
            </div>
        </section>
    </section>
</x-layouts::guest>
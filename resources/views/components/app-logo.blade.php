@props([
    'sidebar' => false,
])

@php
    $siteName = \App\Models\Settings::value('site_name', config('app.name', 'Euro Trend'));
    $logoPath  = \App\Models\Settings::value('site_logo');
    $logoUrl   = $logoPath ? asset('storage/' . $logoPath) : asset('images/logo.png');
@endphp

@if($sidebar)
    <flux:sidebar.brand {{ $attributes }}>
        <x-slot name="logo" class="flex items-center justify-center">
            <img src="{{ $logoUrl }}" alt="{{ $siteName }}" class="h-8 w-auto object-contain">
        </x-slot>
    </flux:sidebar.brand>
@else
    <a href="{{ url('/') }}" class="flex items-center gap-2 shrink-0" {{ $attributes }}>
        <img src="{{ $logoUrl }}" alt="{{ $siteName }}" class="h-10 w-auto object-contain">
    </a>
@endif

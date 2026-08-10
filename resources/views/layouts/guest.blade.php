<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('partials.head')
</head>
<body>
    @include('partials.navbar')

    {{ $slot }}

    @include('partials.footer')
    @stack('scripts')
</body>
</html>
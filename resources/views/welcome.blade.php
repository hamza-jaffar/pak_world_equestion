<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.head', ['title' => __('Welcome')])
    </head>
    <body class="">
        @include('partials.navbar')
        <div>
            bosy
        </div>
        @include('partials.footer')
    </body>
</html>

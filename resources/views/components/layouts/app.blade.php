<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
        <link rel="stylesheet" href="{{ asset('css/all.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/fontawesome.min.css')}}">
        <link rel="stylesheet" href="{{ asset('css/design.css')}}">
        <title>{{ $title ?? 'Page Title' }}</title>
    </head>
    <body>
        {{ $slot }}
        <script defer src="{{asset('css/bootstrap.bundle.min.js')}}"></script>
        <script src="{{ asset('css/bootstrap.min.js') }}"></script>
        <script src="{{asset('js/cdn.js')}}"></script>
        <script src="{{asset('js/operation.js')}}"></script>
    </body>
</html>

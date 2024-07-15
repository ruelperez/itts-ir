<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
        <link rel="stylesheet" href="{{ asset('css/all.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/fontawesome.min.css')}}">
        <link rel="stylesheet" href="{{ asset('css/design.css')}}">
        <link rel="stylesheet" href="{{ asset('node_modules/flatpickr/dist/flatpickr.min.css') }}">
{{--        @vite(['resources/css/app.css', 'resources/js/app.js'])--}}
        <title>{{ $title ?? 'Page Title' }}</title>
    </head>
    <body style="background-color: #E6E6FA;">
        {{ $slot }}
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
        <script defer src="{{asset('css/bootstrap.bundle.min.js')}}"></script>
        <script src="{{ asset('css/bootstrap.min.js') }}"></script>
        <script src="{{asset('js/cdn.js')}}"></script>
        <script src="{{asset('js/operation.js')}}"></script>
        <script src="{{ asset('node_modules/flatpickr/dist/flatpickr.min.js') }}"></script>
{{--        <script>--}}
{{--            document.addEventListener('DOMContentLoaded', function() {console.log('bbbbbbbbbbbbbbbbbbbbbbbbbbb')--}}
{{--                flatpickr('#datepicker', {--}}
{{--                    dateFormat: 'Y-m-d',--}}
{{--                });--}}
{{--            });--}}
{{--        </script>--}}
    </body>
</html>

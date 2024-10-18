<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fontawesome.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/design.css')}}">
    <link rel="stylesheet" href="{{ asset('css/sidebar.css')}}">
    <link rel="stylesheet" href="{{ asset('flatpickr/dist/flatpickr.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <link href="{{ asset('photo/favicon.png') }}?v{{ \Illuminate\Support\Str::random() }}" rel="icon" type="image/png">
    <link href="{{ asset('photo/apple-touch-icon.png') }}?v{{ \Illuminate\Support\Str::random() }}" type="image/png">
    <link href="https://fonts.googleapis.com/css2?family=Lora:wght@700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/gh/muhdfaiz/js-loading-overlay/dist/js-loading-overlay.min.js"></script>
    @stack('css')
    <title>{{ $title ?? 'Page Title' }}</title>
    @livewireStyles
</head>
<body>
<div class="wrapper" x-data="{ marginLeftVar: 0 }">
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '{{ session('success') }}',
                confirmButtonText: 'OK'
            });
        </script>
    @endif
    <div>
        @include('partials.side-nav')
    </div>
    <!-- Main Component -->
    <div class="main" :style="{ marginLeft: marginLeftVar === 1 ? '265px' : '0px' }">
        @include('partials.header')
        <main class="content px-3 py-2" style="margin-top: 80px;">
            <div class="container">
                @yield('content')
            </div>
        </main>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
<script defer src="{{asset('css/bootstrap.bundle.min.js')}}"></script>
<script src="{{ asset('css/bootstrap.min.js') }}"></script>
<script src="{{ asset('css/sidebar.css') }}"></script>
<script src="{{asset('js/cdn.js')}}"></script>
<script src="{{asset('js/operation.js')}}"></script>
<script src="{{ asset('flatpickr/dist/flatpickr.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script src="{{ asset('js/sidebar.js') }}"></script>
<script src="{{ asset('js/change_user_profile.js') }}"></script>
<script>
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
    document.addEventListener('DOMContentLoaded', function(){
        flatpickr('#datepicker', {
            dateFormat: 'm/d/Y',
        });
        flatpickr('#datepickerDob', {
            dateFormat: 'm/d/Y',
        });
        flatpickr('#datepickerDupe', {
            dateFormat: 'm/d/Y',
        });
        flatpickr('#datepickerDobDupe', {
            dateFormat: 'm/d/Y',
        });
        flatpickr('#date-input', {
            dateFormat: 'm/d/Y',
        });
        flatpickr('#hire-date', {
            dateFormat: 'm/d/Y',
        });
    });

    function clickCamp(){
        var al = $("#cnt");
        $("#clientForm").hide();
        var ap = $("#cmp");
        $("#campForm").show();
        ap.css("background-color", "#008000");
        ap.css("color", "white");
        al.css("background-color", "");
        al.css("color", "black");
    }

    function clickClient(){
        var ap = $("#cmp");
        $("#campForm").hide();
        var al = $("#cnt");
        $("#clientForm").show();
        al.css("background-color", "#008000");
        al.css("color", "white");
        ap.css("background-color", "");
        ap.css("color", "black");
    }
</script>
@stack('js')
@livewireScripts
</body>
</html>

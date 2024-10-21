<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fontawesome.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/design.css')}}">
    <link rel="stylesheet" href="{{ asset('flatpickr/dist/flatpickr.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    {{--        @vite(['resources/css/app.css', 'resources/js/app.js'])--}}
    <title>itts-kbtool login</title>
    <link href="{{ asset('photo/favicon.png') }}?v{{ \Illuminate\Support\Str::random() }}" rel="icon" type="image/png">
    <link href="{{ asset('photo/apple-touch-icon.png') }}?v{{ \Illuminate\Support\Str::random() }}" type="image/png">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body style="background-color: #E6E6FA;">
<div style="background-image: url('{{ asset('photo/cover.jpg') }}'); background-size: cover;  background-position: center;width: 100vw; position: relative;  height: 100vh;">
    <div class="container">
        <div class="row ">
            <div class="col-xl-4 col-lg-3 col-md-3">

            </div>
            <div class="col-xl-4 col-lg-6 col-md-6 px-4 py-4" style="border-radius: 7px; background-color: rgba(255, 255, 255, 0.7); margin-top: 80px;">
                <div class="d-flex justify-content-center">
                    <img src="{{asset('photo/apple-touch-icon.png')}}" width="120">
                </div>
                @if ($errors->has('loginError'))
                    <div class="alert alert-danger mt-3" role="alert">
                        {{ $errors->first('loginError') }}
                    </div>
                @endif
                <form method="POST" action="/login/auth"  class="mt-3">
                    @csrf
                    <div class="form-outline mb-4">
                        <input type="text" id="form3Example3cg" class="form-control form-control-md" name="username" required/>
                        <label class="form-label" for="form3Example3cg">Username</label>
                        @error('username') <span style="color: red">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-outline mb-4">
                        <div x-data="{ show: false }" class="mt-4">
                            <div class="password-wrapper d-flex">
                                <input :type="show ? 'text' : 'password'" id="password" name="password" class="form-control form-control-md" required>
                                <span @click="show = !show" class="toggle-icon ms-2 mt-2">
                                    <i :class="show ? 'fas fa-eye-slash' : 'fas fa-eye'"></i>
                                </span>
                            </div>
                            <label for="password" class="form-label" for="form3Example3cg">Password</label>
                        </div>
                    </div>

                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-outline-success btn-md text-white" style="background-color: rgba(0, 128, 0, 0.8); width: 70%;">Login</button>
                    </div>
                    <p class="text-center mt-3 mb-0">Have already an account? <a href="/user/register" class="fw-bold text-body"><u>Register here</u></a></p>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
<script defer src="{{asset('css/bootstrap.bundle.min.js')}}"></script>
<script src="{{ asset('css/bootstrap.min.js') }}"></script>
<script src="{{asset('js/cdn.js')}}"></script>
<script src="{{asset('js/operation.js')}}"></script>
<script src="{{ asset('flatpickr/dist/flatpickr.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
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
</body>
</html>

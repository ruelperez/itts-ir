<div style="background-image: url('photo/cover.jpg'); background-size: cover;  background-position: center;width: 100vw; position: relative;  height: 100vh;">
    <div class="container">
        <div class="row ">
            <div class="col-xl-4 col-lg-3 col-md-3">

            </div>
            <div class="col-xl-4 col-lg-6 col-md-6 px-4 py-4" style="border-radius: 7px; background-color: rgba(255, 255, 255, 0.7); margin-top: 80px;">
                <div class="d-flex justify-content-center">
                    <img src="{{asset('photo/apple-touch-icon.png')}}" width="120">
                </div>
                <form wire:submit.prevent="submit_login"  class="mt-3">
                    <div class="form-outline mb-4">
                        <input type="text" id="form3Example3cg" class="form-control form-control-md" wire:model="username"/>
                        <label class="form-label" for="form3Example3cg"><b>Username</b></label>
                        @error('username') <span style="color: red">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-outline mb-4">
                        <div style="display: flex">
                            <input @if($eye == 0) type="password" @else type="text" @endif id="form3Example4cg" class="form-control form-control-md" wire:model="password"/>
                            @if($eye == 0)
                                <i class="fa-regular fa-eye-slash" style="font-size: 18px; margin-left: 2%;margin-top: 2%;" wire:click="clickEyes(1)"></i>
                            @else
                                <i class="fa-solid fa-eye" style="font-size: 18px; margin-left: 2%;margin-top: 2%;" wire:click="clickEyes(0)"></i>
                            @endif
                        </div>
                        {{--                        <input type="password" id="form3Example4cg" class="form-control form-control-md" wire:model="password"/>--}}
                        <label class="form-label" for="form3Example4cg"><b>Password</b></label>
                        @error('password') <span style="color: red">{{ $message }}</span> @enderror
                    </div>

                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-outline-success btn-md text-white" style="background-color: rgba(0, 128, 0, 0.8); width: 70%;">Login</button>
                    </div>
                    <p class="text-center mt-3 mb-0">Have already an account? <a href="/register" class="fw-bold text-body"><u>Register here</u></a></p>
                </form>
            </div>
        </div>
    </div>
</div>





{{--<div style="display: flex">--}}
{{--    <div style="width: 55%; display: flex; margin-top: 15%;">--}}
{{--        <div style="margin-top: 3%; margin-left: 25%;">--}}
{{--            <img src="{{asset('photo/logo.jpg')}}" width="220" height="200">--}}
{{--        </div>--}}
{{--        <div style="font-size: 45px;color: #0000FF; margin-top: 10%; text-align: center; margin-left: 3%;">--}}
{{--            <b>I.T.T.S</b>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div style="width: 45%;">--}}
{{--        <div class="card" style="border-radius: 15px; width: 65%; margin-top: 10%; margin-left: 5%;">--}}
{{--            <div class="card-body px-5 @if(session()->has('loginError')) @else py-5 @endif" >--}}
{{--                @if(session()->has('loginError'))--}}
{{--                    <div class="alert alert-danger text-center pt-1" role="alert" style="height: 35px;">--}}
{{--                        {{session('loginError')}}--}}
{{--                    </div>--}}
{{--                @endif--}}
{{--                <h2 class="text-uppercase text-center mb-4">LOG IN</h2>--}}
{{--                <form wire:submit.prevent="submit_login">--}}

{{--                    <div class="form-outline mb-4">--}}
{{--                        <input type="text" id="form3Example3cg" class="form-control form-control-md" wire:model="username"/>--}}
{{--                        <label class="form-label" for="form3Example3cg">Username</label>--}}
{{--                        @error('username') <span style="color: red">{{ $message }}</span> @enderror--}}
{{--                    </div>--}}

{{--                    <div class="form-outline mb-4">--}}
{{--                        <div style="display: flex">--}}
{{--                            <input @if($eye == 0) type="password" @else type="text" @endif id="form3Example4cg" class="form-control form-control-md" wire:model="password"/>--}}
{{--                            @if($eye == 0)--}}
{{--                                <i class="fa-regular fa-eye-slash" style="font-size: 18px; margin-left: 2%;margin-top: 2%;" wire:click="clickEyes(1)"></i>--}}
{{--                            @else--}}
{{--                                <i class="fa-solid fa-eye" style="font-size: 18px; margin-left: 2%;margin-top: 2%;" wire:click="clickEyes(0)"></i>--}}
{{--                            @endif--}}
{{--                        </div>--}}
{{--                        <input type="password" id="form3Example4cg" class="form-control form-control-md" wire:model="password"/>--}}
{{--                        <label class="form-label" for="form3Example4cg">Password</label>--}}
{{--                        @error('password') <span style="color: red">{{ $message }}</span> @enderror--}}
{{--                    </div>--}}

{{--                    <div class="d-flex justify-content-center">--}}
{{--                        <button type="submit" class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">Login</button>--}}
{{--                    </div>--}}

{{--                    <p class="text-center text-muted mt-3 mb-0">Have already an account? <a href="/register" wire:navigate class="fw-bold text-body"><u>Register here</u></a></p>--}}
{{--                </form>--}}

{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}

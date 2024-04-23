<div style="display: flex">
    <div style="width: 55%; display: flex; margin-top: 15%;">
        <div style="margin-top: 3%; margin-left: 25%;">
            <img src="{{asset('photo/logo.jpg')}}" width="220" height="180">
        </div>
        <div style="font-size: 45px;color: #0000FF; margin-top: 10%; text-align: center; margin-left: 3%;">
            <b>I.T.T.S</b>
        </div>
    </div>
    <div style="width: 50%;">
        <div class="card" style="border-radius: 15px; width: 70%; margin-top: 5%;">
            <div class="card-body p-5">
                <h2 class="text-uppercase text-center mb-4">Create an account</h2>
                <form wire:submit.prevent="submit_register">
                    <div class="mb-4">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" wire:model="is_admin" value="{{$is_admin}}" @if($is_reg == 0) disabled @endif @if($admin_show == 0) disabled @endif>
                            <label class="form-check-label" for="flexSwitchCheckChecked">Admin</label>
                        </div>
                    </div>
                    <div class="form-outline mb-4">
                        <input type="text" id="form3Example1cg" class="form-control form-control-md" wire:model="fullname" @if($is_reg == 0) disabled @endif/>
                        <label class="form-label" for="form3Example1cg">Your Full Name</label>
                        @error('fullname') <span style="color: red">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-outline mb-4">
                        <input type="text" id="form3Example3cg" class="form-control form-control-md" wire:model="username" @if($is_reg == 0) disabled @endif/>
                        <label class="form-label" for="form3Example3cg">Username</label>
                        @error('username') <span style="color: red">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-outline mb-4">
                        <input type="password" id="form3Example4cg" class="form-control form-control-md" wire:model="password" @if($is_reg == 0) disabled @endif/>
                        <label class="form-label" for="form3Example4cg">Password</label>
                        @error('password') <span style="color: red">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-outline mb-4">
                        <input type="password" id="form3Example4cdg" class="form-control form-control-md" wire:model="password_confirmation" @if($is_reg == 0) disabled @endif/>
                        <label class="form-label" for="form3Example4cdg">Repeat your password</label>
                        @error('password_confirmation') <span style="color: red">{{ $message }}</span> @enderror
                    </div>

                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-success btn-block btn-lg gradient-custom-4 text-body" @if($is_reg == 0) disabled @endif >Register</button>
                    </div>
                    @if($is_reg == 0)
                        <p style="color: red">The registration is disabled, Contact admin user to enable.</p>
                    @endif
                    <p class="text-center text-muted mt-3 mb-0">Have already an account? <a href="/login" wire:navigate class="fw-bold text-body"><u>Login here</u></a></p>
                </form>

            </div>
        </div>
    </div>
</div>

<div style="background-image: url('photo/cover.jpg'); background-size: cover;  background-position: center;width: 100vw; position: relative;  height: 100vh;">
    <div class="container">
        <div class="row ">
            <div class="col-xl-4 col-lg-3 col-md-3">
            </div>
            <div class="col-xl-4 col-lg-6 col-md-6 px-4 py-2" style="border-radius: 7px; background-color: rgba(255, 255, 255, 0.7); margin-top: 20px;">
                <div class="d-flex justify-content-center mb-2">
                    <img src="{{asset('photo/apple-touch-icon.png')}}" width="100">
                </div>
                <h5 class="text-uppercase text-center mb-3">Create an account</h5>
                <form wire:submit.prevent="submit_register">
                    <div class="mb-3">
                        <select class="form-select" aria-label="Default select example" style="width: 50%;" wire:model="position" @if($is_reg == 0) disabled @endif>
                            <option value="Agent">Agent</option>
                            @if($admin_show != 0) <option value="Admin">Admin</option> @endif
                            @if($super_admin_show != 0) <option value="Super Admin">Super Admin</option> @endif
                        </select>
                    </div>
                    <div class="form-outline mb-3">
                        <input type="text" id="form3Example1cg" class="form-control form-control-md" wire:model="fullname" @if($is_reg == 0) disabled @endif/>
                        <label class="form-label" for="form3Example1cg">Your Full Name</label>
                        @error('fullname') <span style="color: red">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-outline mb-3">
                        <input type="text" id="form3Example3cg" class="form-control form-control-md" wire:model="username" @if($is_reg == 0) disabled @endif/>
                        <label class="form-label" for="form3Example3cg">Username</label>
                        @error('username') <span style="color: red">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-outline mb-3">
                        <div style="display: flex">
                            <input  @if($eye == 0) type="password" @else type="text" @endif id="form3Example4cg" class="form-control form-control-md" wire:model="password" @if($is_reg == 0) disabled @endif/>
                            @if($eye == 0)
                                <i class="fa-regular fa-eye-slash" style="font-size: 18px; margin-left: 2%;margin-top: 2%; cursor: pointer" wire:click="clickEyes(1)"></i>
                            @else
                                <i class="fa-solid fa-eye" style="font-size: 18px; margin-left: 2%;margin-top: 2%; cursor: pointer" wire:click="clickEyes(0)"></i>
                            @endif
                        </div>
                        <label class="form-label" for="form3Example4cg">Password</label>
                        @error('password') <span style="color: red">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-outline mb-3">
                        <div style="display: flex">
                            <input @if($eyes == 0) type="password" @else type="text" @endif id="form3Example4cdg" class="form-control form-control-md" wire:model="password_confirmation" @if($is_reg == 0) disabled @endif/>
                            @if($eyes == 0)
                                <i class="fa-regular fa-eye-slash" style="font-size: 18px; margin-left: 2%;margin-top: 2%; cursor: pointer" wire:click="clickEyess(1)"></i>
                            @else
                                <i class="fa-solid fa-eye" style="font-size: 18px; margin-left: 2%;margin-top: 2%; cursor: pointer" wire:click="clickEyess(0)"></i>
                            @endif
                        </div>
                        <label class="form-label" for="form3Example4cdg">Repeat your password</label>
                        @error('password_confirmation') <span style="color: red">{{ $message }}</span> @enderror
                    </div>

                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-success btn-block btn-lg gradient-custom-4 text-body" @if($is_reg == 0) disabled @endif >Register</button>
                    </div>
                    @if($is_reg == 0)
                        <p style="color: red">The registration is disabled, Contact admin user to enable.</p>
                    @endif
                    <p class="text-center mt-2 mb-0">Have already an account? <a href="/login" class="fw-bold text-body"><u>Login here</u></a></p>
                </form>
            </div>
        </div>
    </div>
</div>

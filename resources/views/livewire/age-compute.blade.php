<div>
    @include('modal.click-settings')
    @include('modal.news-update.show-photo')
    <div style="display: flex; width: 100%; margin-top: 135px; ">
        <div style="width: 81%; margin-left: 19%;">
            <div class="container">
                <div>
                    <h4 style="margin-top: 3%; margin-left: 2%;">Age checker</h4>
                </div>
                <div style="margin-left: 3%; margin-top: 2%; background-color: #F5F5F5; border-radius: 2%;">
                    <form wire:submit.prevent="submit">
                        <div style="display: flex">
                            <div style="width: 50%;">
                                <div class="mb-3" style="width: 100%; margin-top: 5%; margin-left: 5%; display: flex;">
                                    <div style="text-align: right; padding-right: 5%; width: 40%;">
                                        <label>Injured party name</label>
                                    </div>
                                    <div style="width: 100%;">
                                        <input type="text" class="form-control" wire:model="name" required>
                                        @error('name') <span style="color: red">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="mb-3"  style="width: 32%; margin-top: 5%; margin-left: 37%; display: flex;">
                                    <select class="form-select" aria-label="Default select example"  wire:model="stat">
                                        <option value="dependent">Dependent</option>
                                        <option value="military" >Military</option>
                                    </select>
                                </div>
                                <div class="mb-3" style="width: 80%; margin-top: 5%; margin-left: 5%; display: flex;">
                                    <div style="text-align: right; padding-right: 5%; width: 40%; margin-bottom: 8%;">
                                        <label>Year of birth</label>
                                    </div>
                                    <div style="width: 40%;">
                                        <input type="text" class="form-control" wire:model="birth" required>
                                        @error('birth') <span style="color: red">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <div class="@if(session('fail_death')) @else mb-3 @endif " style="width: 90%; margin-left: 5%; display: flex;">
                                    <div style="text-align: right; padding-right: 5%; width: 40%; @if(session('fail_death')) @else margin-bottom: 8%; @endif">
                                        <label>Date of death</label>
                                    </div>
                                    <div style="width: 70%; display: flex;">
                                        <div style="width: 55%;">
                                            <input type="text" class="form-control" wire:model="death" @if($alive == true) disabled @endif required>
                                            @error('death') <span style="color: red">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="form-check" style="margin-left: 5%; margin-top: 3%;">
                                            <input class="form-check-input" type="checkbox" id="flexCheckChecked" wire:model.live="alive" value="{{$alive}}" >
                                            <label class="form-check-label" for="flexCheckChecked">
                                                Still alive
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                @if (session('fail_death'))
                                    <p style="color: red; text-align: center;">{{ session('fail_death') }}</p>
                                @endif
                                <div class="mb-3" style="width: 80%; margin-left: 5%; display: flex;">
                                    <div style="text-align: right; padding-right: 5%; width: 40%; margin-bottom: 8%;">
                                        <label>Start</label>
                                    </div>
                                    <div style="width: 40%;">
                                        <input type="text" class="form-control" wire:model="start" required>
                                        @error('start') <span style="color: red">{{ $message }}</span> @enderror
                                        @if (session('fail_start'))
                                            <p style="color: red; text-align: center;">{{ session('fail_start') }}</p>
                                        @endif
                                        @if (session('fail_start_1'))
                                            <p style="color: red; text-align: center;">{{ session('fail_start_1') }}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="mb-3" style="width: 80%; margin-left: 5%; display: flex;">
                                    <div style="text-align: right; padding-right: 5%; width: 40%; margin-bottom: 8%;">
                                        <label>End</label>
                                    </div>
                                    <div style="width: 40%;">
                                        <input type="text" class="form-control" wire:model="end" required>
                                        @error('end') <span style="color: red">{{ $message }}</span> @enderror
                                        @if (session('fail_end'))
                                            <p style="color: red; text-align: center;">{{ session('fail_end') }}</p>
                                        @endif
                                        @if (session('fail_end_1'))
                                            <p style="color: red; text-align: center;">{{ session('fail_end_1') }}</p>
                                        @endif
                                    </div>
                                </div>


                                <div class="mb-3" style="width: 80%; margin-left: 5%; display: flex;">
                                    <div style="text-align: right; padding-right: 5%; width: 40%; margin-bottom: 8%;">
                                        <label>Diagnosis</label>
                                    </div>
                                    <div style="width: 40%;">
                                        <input type="text" class="form-control" wire:model="diagnosis" required>
                                        @error('diagnosis') <span style="color: red">{{ $message }}</span> @enderror
                                        @if (session('fail_diag'))
                                            <p style="color: red; text-align: center;">{{ session('fail_diag') }}</p>
                                        @endif
                                        @if (session('fail_diag_1'))
                                            <p style="color: red; text-align: center;">{{ session('fail_diag_1') }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div style="width: 50%; padding-left: 12%; padding-top: 3%;">
                                <p><b style="color: blue">{{$age_diagnosed}}</b> Age PNC was diagnosed</p>
                                <p><b style="color: blue">{{$age_passaway}}</b> Age PNC passed away</p>
                                <p><b style="color: blue">{{$age_started}}</b> Age PNC started</p>
                                <p><b style="color: blue">{{$age_left}}</b> Age PNC left</p>
                                <p><b style="color: blue">{{$year_exposure}}</b> Year of exposure</p>
                                <p><b style="color: blue">{{$latency}}</b> Latency From First Exposure to Diagnosis:</p>
                                <div style="display: flex; margin-top: 10%;">
                                    <div>
                                        <button type="submit" class="btn btn-primary" style="padding-bottom: 1px; border-radius: 50%; margin-left: 25%; margin-bottom: 5%;"><i class="fa-solid fa-clock-rotate-left" style="font-size: 20px;"></i><p>Validate</p></button>
                                    </div>
                                    <div style="margin-left: 20%; width: 23%; text-align: center; cursor: pointer">
                                        <div wire:click="resetBtn" style="padding-bottom: 1px; background-color: yellow; width: 100%; border-radius: 50%; padding-top: 10%;" ><i class="fa-solid fa-clock-rotate-left" style="font-size: 20px;"></i><p>Reset</p></div>
                                    </div>
                                </div>
                                <div wire:loading class="spinner-border spin" style="height: 40px; width: 40px; margin-left: 30%; margin-top: 15%;">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                                <div wire:loading.remove style="margin-top: 10%; margin-left: 13%;">
                                    @if($error == 1)
                                        <h3 style="color: red">Input error <i class="fa-regular fa-circle-xmark" style="color: red"></i></h3>
                                    @elseif($error == 2)
                                        @if($hn == 1)
                                            @if($remarks == 1) <h3 style="color: green">Qualified <i class="fa-solid fa-check"></i></h3>  @else <h3 style="color: red">Not qualified <i class="fa-regular fa-circle-xmark" style="color: red"></i></h3> @endif
                                        @endif
                                    @endif
                                </div>

                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        <div style="width: 19%; background-color: #0077b6; position: fixed;top: 125px; left: 0; z-index: 1000;">
            @include('components.layouts.profile')
            @include('components.layouts.navigation')
        </div>
    </div>
    @include('partial.header')
</div>

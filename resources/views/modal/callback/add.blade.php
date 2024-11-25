<div wire:ignore.self class="modal fade" id="add" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="height: 550px;">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Callback</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent="submit">
                    <div class="row ">
                        <div class="col-12 col-sm-3">
                            <label class="col-form-label">Campaign</label>
                        </div>
                        <div class="col-sm-6 col-9">
                            <input type="text" class="form-control w-100" wire:model.live="campaign" wire:blur="removeSearch" required>
                            @if(session()->has('badAgent'))
                                <small style="color: #800000">Campaign name must be form search suggestions.</small>
                            @endif
                            @if($showSearch == true)
                                <div style="position: absolute; box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.9);">
                                    <ul class="list-group">
                                        @foreach($results as $data)
                                            <li class="list-group-item btn text-start" style="background-color: #E0FFFF;" wire:click="click_items({{$data->id}})">
                                                <i class="fa-solid fa-magnifying-glass me-3"></i> {{ucfirst($data->campaign)}}
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @error('agent') <span style="color: #8B0000">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-auto pt-2 ms-auto">
                            <p class="px-1 py-1" style="background-color: black; color: white; border-radius: 10px; font-size: 12px; cursor: pointer" wire:click="naCampaign">n/a</p>
                        </div>
                    </div>
                    <div class="row  mt-3">
                        <div class="col-auto">
                            <label class="col-form-label">Claimant</label>
                        </div>
                        <div class="col-auto">
                            <input type="text" class="form-control" wire:model="claimant" required>
                        </div>
                        <div class="col-auto pt-2 ms-auto">
                            <p class="px-1 py-1" style="background-color: black; color: white; border-radius: 10px; font-size: 12px; cursor: pointer" wire:click="naClaimant">n/a</p>
                        </div>
                    </div><div class="row mt-3">
                        <div class="col-auto">
                            <label class="col-form-label">Injured Party</label>
                        </div>
                        <div class="col-auto">
                            <input type="text" class="form-control" wire:model="injuredParty" required>
                        </div>
                        <div class="col-auto pt-2 ms-auto">
                            <p class="px-1 py-1" style="background-color: black; color: white; border-radius: 10px; font-size: 12px; cursor: pointer" wire:click="naInjureParty">n/a</p>
                        </div>
                    </div><div class="row mt-3">
                        <div class="col-auto">
                            <label class="col-form-label">Phone #</label>
                        </div>
                        <div class="col-auto">
                            <input type="text" class="form-control" wire:model="phoneNumber" required>
                            @error('phoneNumber') <span style="color: #8B0000">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-auto pt-2 ms-auto">
                            <p class="px-1 py-1" style="background-color: black; color: white; border-radius: 10px; font-size: 12px; cursor: pointer" wire:click="naPhoneNumber">00000</p>
                        </div>
                    </div><div class="row mt-3">
                        <div class="col-auto">
                            <label class="col-form-label">Alt. #</label>
                        </div>
                        <div class="col-auto">
                            <input type="text" class="form-control" wire:model="altPhoneNumber" required>
                            @error('altPhoneNumber') <span style="color: #8B0000">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-auto pt-2 ms-auto">
                            <p class="px-1 py-1" style="background-color: black; color: white; border-radius: 10px; font-size: 12px; cursor: pointer" wire:click="naAltPhoneNumber">00000</p>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-auto">
                            <label class="col-form-label">Email</label>
                        </div>
                        <div class="col-auto">
                            <input type="email" class="form-control" wire:model="email" required>
                        </div>
                        <div class="col-auto pt-2 ms-auto">
                            <p class="px-1 py-1" style="background-color: black; color: white; border-radius: 10px; font-size: 12px; cursor: pointer" wire:click="naEmail">na@na</p>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-auto">
                            <label class="col-form-label">DOB</label>
                        </div>
                        <div class="col-auto">
                            <input type="text" class="form-control" wire:model="dob" required>
                        </div>
                        <div class="col-auto pt-2 ms-auto">
                            <p class="px-1 py-1" style="background-color: black; color: white; border-radius: 10px; font-size: 12px; cursor: pointer" wire:click="naDob">n/a</p>
                        </div>
                    </div>
                   <div class="row mt-3">
                        <div class="col-auto">
                            <label class="col-form-label">Address</label>
                        </div>
                        <div class="col-auto">
                            <input type="text" class="form-control" wire:model="address" required>
                        </div>
                       <div class="col-auto pt-2 ms-auto">
                           <p class="px-1 py-1" style="background-color: black; color: white; border-radius: 10px; font-size: 12px; cursor: pointer" wire:click="naAddress">n/a</p>
                       </div>
                    </div>
{{--                    <div class="row mt-3">--}}
{{--                        <div class="col-auto">--}}
{{--                            <label class="col-form-label">Callback time</label>--}}
{{--                        </div>--}}
{{--                        <div class="col-auto">--}}
{{--                            <input type="text" class="form-control" wire:model="callbackTime" required>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    <div class="row mt-3 px-3">
                        <textarea class="form-control" rows="3" id="reason" wire:model="reason"  placeholder="Reason:" required></textarea>
                    </div>
                    <hr>
                    <div>
                        <button type="submit" class="btn btn-warning w-100">SUBMIT</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

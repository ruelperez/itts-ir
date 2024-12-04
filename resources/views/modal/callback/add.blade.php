<div wire:ignore.self class="modal fade" id="add" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
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
                    <hr>
                    @if($campName == "nec")
                        <div class="row mt-3">
                            <div class="col-auto">
                                <label class="col-form-label">Baby's Weight?</label>
                            </div>
                            <div class="col-auto">
                                <input type="text" class="form-control" wire:model="necQuestion.weight" required>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-auto">
                                <label class="col-form-label">Birth year? (must be 2006 or earlier)</label>
                            </div>
                            <div class="col-auto">
                                <input type="text" class="form-control" wire:model="necQuestion.birth_year" required>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-auto">
                                <label class="col-form-label">Did the baby receive a NEC diagnosis before 36 weeks?</label>
                            </div>
                            <div class="col-auto">
                                <input type="text" class="form-control" wire:model="necQuestion.nec_diagnosis" required>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-auto">
                                <label class="col-form-label">Which formula or fortifier did the baby receive?</label>
                            </div>
                            <div class="col-auto">
                                <input type="text" class="form-control" wire:model="necQuestion.formula" required>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-auto">
                                <label class="col-form-label">Was the baby born premature and diagnosed with NEC?</label>
                            </div>
                            <div class="col-auto">
                                <input type="text" class="form-control" wire:model="necQuestion.premature" required>
                            </div>
                        </div>
                    @elseif($campName == "afff")
                        <div class="row mt-3">
                            <div class="col-auto">
                                <label class="col-form-label">Were you a firefighter, emergency responder, or a member of the military?</label>
                            </div>
                            <div class="col-auto">
                                <input type="text" class="form-control" wire:model="afffQuestion.member" required>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-auto">
                                <label class="col-form-label">Were you exposed to AFFF at any time after 1980? If so, in what year?</label>
                            </div>
                            <div class="col-auto">
                                <input type="text" class="form-control" wire:model="afffQuestion.exposed" required>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-auto">
                                <label class="col-form-label">Is this your first exposure?</label>
                            </div>
                            <div class="col-auto">
                                <input type="text" class="form-control" wire:model="afffQuestion.firstExposure" required>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-auto">
                                <label class="col-form-label">What was your last exposure?</label>
                            </div>
                            <div class="col-auto">
                                <input type="text" class="form-control" wire:model="afffQuestion.lastExposure" required>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-auto">
                                <label class="col-form-label">Approx. how often are you exposed? </label>
                            </div>
                            <div class="col-auto">
                                <input type="text" class="form-control" wire:model="afffQuestion.howOften" required>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-auto">
                                <label class="col-form-label">Were you diagnosed with one of the qualifying injuries?</label>
                            </div>
                            <div class="col-auto">
                                <input type="text" class="form-control" wire:model="afffQuestion.qualifyingInjuries" required>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-auto">
                                <label class="col-form-label">Diagnosis: </label>
                            </div>
                            <div class="col-auto">
                                <input type="text" class="form-control" wire:model="afffQuestion.diagnosis" required>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-auto">
                                <label class="col-form-label">Date of diagnosis (mm/dd/yyyy): </label>
                            </div>
                            <div class="col-auto">
                                <input type="text" class="form-control" wire:model="afffQuestion.dateOfDiagnosis" required>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-auto">
                                <label class="col-form-label">Were you convicted of a crime within the previous 5 years?</label>
                            </div>
                            <div class="col-auto">
                                <input type="text" class="form-control" wire:model="afffQuestion.convicted" required>
                            </div>
                        </div>
                    @elseif($campName == "rideshare uber/lyft")
                        <div class="row mt-3">
                            <div class="col-auto">
                                <label class="col-form-label">Do you have the copy of RS receipt?</label>
                            </div>
                            <div class="col-auto">
                                <input type="text" class="form-control" wire:model="rideshareQuestion.receipt" required>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-auto">
                                <label class="col-form-label">Do you have the copy of Police Report/ Company Complain?</label>
                            </div>
                            <div class="col-auto">
                                <input type="text" class="form-control" wire:model="rideshareQuestion.report" required>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-auto">
                                <label class="col-form-label">𝐖𝐚𝐬 𝐬𝐞𝐱𝐮𝐚𝐥𝐥𝐲 𝐚𝐬𝐬𝐚𝐮𝐥𝐭𝐞𝐝 𝐛𝐲 𝐚 𝐫𝐢𝐝𝐞𝐬𝐡𝐚𝐫𝐞 𝐝𝐫𝐢𝐯𝐞𝐫?</label>
                            </div>
                            <div class="col-auto">
                                <input type="text" class="form-control" wire:model="rideshareQuestion.assaulted" required>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-auto">
                                <label class="col-form-label">𝐈𝐧𝐜𝐢𝐝𝐞𝐧𝐭 𝐦𝐮𝐬𝐭 𝐡𝐚𝐯𝐞 𝐡𝐚𝐩𝐩𝐞𝐧𝐞𝐝 𝐢𝐧 𝐭𝐡𝐞 𝐔𝐒?</label>
                            </div>
                            <div class="col-auto">
                                <input type="text" class="form-control" wire:model="rideshareQuestion.incident" required>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-auto">
                                <label class="col-form-label">Were you convicted as felony? </label>
                            </div>
                            <div class="col-auto">
                                <input type="text" class="form-control" wire:model="rideshareQuestion.convicted" required>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-auto">
                                <label class="col-form-label">Are you represented by other LF?</label>
                            </div>
                            <div class="col-auto">
                                <input type="text" class="form-control" wire:model="rideshareQuestion.represented" required>
                            </div>
                        </div>
                    @endif
{{--                    <div class="row mt-3">--}}
{{--                        <div class="col-auto">--}}
{{--                            <label class="col-form-label">Callback time</label>--}}
{{--                        </div>--}}
{{--                        <div class="col-auto">--}}
{{--                            <input type="text" class="form-control" wire:model="callbackTime" required>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    <div class="row mt-3 px-3">
                        <textarea class="form-control" rows="3" id="reason" wire:model="reason"  placeholder="Callback Reason:" required></textarea>
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

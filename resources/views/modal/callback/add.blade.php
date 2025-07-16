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
                    @elseif($campName == "rup")
                        <div class="row mt-3">
                            <div class="col-auto">
                                <label class="col-form-label">Year of First Usage</label>
                            </div>
                            <div class="col-auto">
                                <input type="text" class="form-control" wire:model="rupQuestion.usage_year" required>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-auto">
                                <label class="col-form-label">Year of Last Usage</label>
                            </div>
                            <div class="col-auto">
                                <input type="text" class="form-control" wire:model="rupQuestion.last_usage_year" required>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-auto">
                                <label class="col-form-label">How many times you use RUP every year?</label>
                            </div>
                            <div class="col-auto">
                                <input type="text" class="form-control" wire:model="rupQuestion.use_every_year" required>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-auto">
                                <label class="col-form-label">How many hours you were exposed to RUP for every application</label>
                            </div>
                            <div class="col-auto">
                                <input type="text" class="form-control" wire:model="rupQuestion.hours_exposed" required>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-auto">
                                <label class="col-form-label">Were you diagnosed with Non-Hodgkin’s Lymphoma</label>
                            </div>
                            <div class="col-auto">
                                <input type="text" class="form-control" wire:model="rupQuestion.lymphoma" required>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-auto">
                                <label class="col-form-label">Sub-Type</label>
                            </div>
                            <div class="col-auto">
                                <input type="text" class="form-control" wire:model="rupQuestion.subtype" required>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-auto">
                                <label class="col-form-label">When were you diagnosed</label>
                            </div>
                            <div class="col-auto">
                                <input type="text" class="form-control" wire:model="rupQuestion.diagnose_year" required>
                            </div>
                        </div>
                    @elseif($campName == "pq")
                        <!-- 1. Diagnosed with PD? -->
                        <div class="row mt-3">
                            <div class="col-auto">
                                <label class="col-form-label">Diagnosed with PD?</label>
                            </div>
                            <div class="col-auto">
                                <select class="form-control" wire:model="rupQuestion.pd_diagnosed" required>
                                    <option value="">-- Select --</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                    <option value="Symptoms only">Symptoms only</option>
                                </select>
                            </div>
                        </div>

                        <!-- 2. Date of Diagnosis -->
                        <div class="row mt-3">
                            <div class="col-auto">
                                <label class="col-form-label">Date of Diagnosis</label>
                            </div>
                            <div class="col-auto">
                                <input type="text" class="form-control" wire:model="rupQuestion.diagnosis_date" required>
                            </div>
                        </div>

                        <!-- 3. Medications -->
                        <div class="row mt-3">
                            <div class="col-auto">
                                <label class="col-form-label">Medications</label>
                            </div>
                            <div class="col-auto">
                                <input type="text" class="form-control" wire:model="rupQuestion.medications" required>
                            </div>
                        </div>

                        <!-- 4. Start date of usage -->
                        <div class="row mt-3">
                            <div class="col-auto">
                                <label class="col-form-label">Start Date of Usage</label>
                            </div>
                            <div class="col-auto">
                                <input type="text" class="form-control" wire:model="rupQuestion.med_start_date" required>
                            </div>
                        </div>

                        <!-- 5. End date of usage -->
                        <div class="row mt-3">
                            <div class="col-auto">
                                <label class="col-form-label">End Date of Usage</label>
                            </div>
                            <div class="col-auto">
                                <input type="text" class="form-control" wire:model="rupQuestion.med_end_date" required>
                            </div>
                        </div>

                        <!-- 6. Did you live or work on the property where Paraquat was used? -->
                        <div class="row mt-3">
                            <div class="col-auto">
                                <label class="col-form-label">Did you live or work on the property where Paraquat was used?</label>
                            </div>
                            <div class="col-auto">
                                <select class="form-control" wire:model="rupQuestion.paraquat_property" required>
                                    <option value="">-- Select --</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                        </div>

                        <!-- 7. Type of Exposure -->
                        <div class="row mt-3">
                            <div class="col-auto">
                                <label class="col-form-label">Type of Exposure</label>
                            </div>
                            <div class="col-auto">
                                <input type="text" class="form-control" wire:model="rupQuestion.exposure_type" required placeholder="e.g., Mixing/Handling, Purchasing, Spraying, Lived nearby">
                            </div>
                        </div>

                        <!-- 8. Name of Diagnosing Physician and Facility -->
                        <div class="row mt-3">
                            <div class="col-auto">
                                <label class="col-form-label">Name of Diagnosing Physician and Facility</label>
                            </div>
                            <div class="col-auto">
                                <input type="text" class="form-control" wire:model="rupQuestion.physician_info" required>
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
                                <label class="col-form-label">Did the incident occur in the United States?</label>
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
                    @elseif($campName == "depo")
                        <div class="row mt-3">
                            <div class="col-auto">
                                <label class="col-form-label">Did you or a loved one use the injectable contraceptive brand Depo-Provera for at least one year?</label>
                            </div>
                            <div class="col-auto">
                                <input type="text" class="form-control" wire:model="depoQuestion.𝐢𝐧𝐣𝐞𝐜𝐭𝐚𝐛𝐥𝐞" required>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-auto">
                                <label class="col-form-label">Were you or a loved one diagnosed with meningioma after using Depo-Provera for at least one year?</label>
                            </div>
                            <div class="col-auto">
                                <input type="text" class="form-control" wire:model="depoQuestion.𝐌𝐞𝐧𝐢𝐧𝐠𝐢𝐨𝐦𝐚" required>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-auto">
                                <label class="col-form-label">Are you able to provide proof of your prescription for Depo-Provera?</label>
                            </div>
                            <div class="col-auto">
                                <input type="text" class="form-control" wire:model="depoQuestion.𝐩𝐫𝐞𝐬𝐜𝐫𝐢𝐩𝐭𝐢𝐨𝐧" required>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-auto">
                                <label class="col-form-label">Are you represented by other LF?</label>
                            </div>
                            <div class="col-auto">
                                <input type="text" class="form-control" wire:model="depoQuestion.represented" required>
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

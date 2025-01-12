<div>
    <div>
        <h5>Lead Form</h5>
    </div>
    <div style="background-color: #696969; color: white;border-radius: 2%;" class="px-3 py-2 px-sm-4 py-sm-4 mt-4">
        @include('components.submission-form.campaign-link')
        <form wire:submit.prevent="submit">
            <div class="row mb-4" x-data="{ selectedOptions: '' }">
                <div class="col-3">
                    <div>
                        <label class="form-label">Lead Ownership</label>
                    </div>
                    <div>
                        <select class="form-select" aria-label="Default select example" wire:model.live="leadOwnership" x-model="selectedOptions" required>
                            <option value="">Select</option>
                            <option value="1st Touch">1st Touch</option>
                            <option value="2nd Touch">2nd Touch</option>
                        </select>
                        @error('leadOwnership') <span style="color: #8B0000">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="col-5" x-show="selectedOptions === '2nd Touch'">
                    <label  class="form-label">Agent Name on 1st Touch*</label>
                    <input type="text" class="form-control" wire:model.live="agent2" wire:blur="removeSearch2" :required="selectedOptions === '2nd Touch'">
                    @if(session()->has('badAgent2'))
                        <small style="color: #800000">Agent's name should be selected from the search suggestions.</small>
                    @endif
                    @if($showSearch2 == true)
                        <div style="position: absolute; box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.9);">
                            <ul class="list-group">
                                @foreach($results2 as $data)
                                    <li class="list-group-item btn text-start" style="background-color: #E0FFFF;" wire:click="click_items2({{$data->id}})">
                                        <i class="fa-solid fa-magnifying-glass me-3"></i> {{ucfirst($data->employeeFullname)}}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @error('agent2') <span style="color: #8B0000">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-xl-3 col-lg-3 col-md-6 mb-md-4 mb-sm-4 mt-sm-2">
                    <label class="form-label">Date (U.S Time)*</label>
                    <input type="text" id="datepicker" class="form-control" wire:model="date" required>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 mb-md-4 mb-sm-4 mt-4 mt-md-2">
                    <label class="form-label">Campaign*</label>
                    <input type="text" class="form-control" wire:model="campaign" required disabled>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 mb-md-4 mb-sm-4 mt-4 mt-lg-2">
                    <label class="form-label">Client*</label>
                    <input type="text" class="form-control" wire:model="client" required disabled>
                    @error('client') <span style="color: #8B0000">{{ $message }}</span> @enderror
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 mb-md-4 mb-sm-4 mt-4 mt-lg-2">
                    <label class="form-label">Guest 1*</label>
                    <input type="text" class="form-control" wire:model="guest1" required>
                    @error('guest1') <span style="color: #8B0000">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-xl-3 col-lg-3 col-md-6 mb-md-4 mb-sm-4 mt-4 mt-md-2">
                    <label class="form-label">Guest 2*</label>
                    <input type="text" class="form-control" wire:model="guest2" required>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 mb-md-4 mb-sm-4 mt-4 mt-lg-2">
                    <label class="form-label">Phone Number*</label>
                    <input type="text" class="form-control" wire:model="phoneNumber" required>
                    @error('phoneNumber') <span style="color: #8B0000">{{ $message }}</span> @enderror
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 mb-md-4 mb-sm-4 mt-4 mt-lg-2">
                    <label class="form-label">Alt. Phone Number*</label>
                    <input type="text" class="form-control" wire:model="altPhoneNumber" placeholder="Enter &quot;0&quot; if not applicable" required>
                    @error('altPhoneNumber') <span style="color: #8B0000">{{ $message }}</span> @enderror
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 mb-md-4 mb-sm-4 mt-4 mt-lg-2">
                    <label class="form-label">Email*</label>
                    <input type="email" class="form-control" wire:model="email" required>
                    @error('email') <span style="color: #8B0000">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-xl-3 col-lg-3 col-md-6 mb-md-4 mb-sm-4 mt-sm-2">
                    <div>
                        <label class="form-label">Sched (Day)*</label>
                    </div>
                    <div>
                        <select class="form-select" aria-label="Default select example" wire:model="day" required>
                            <option value="">Select Day</option>
                            <option value="Monday">Monday</option>
                            <option value="Tuesday">Tuesday</option>
                            <option value="Wednesday">Wednesday</option>
                            <option value="Thursday">Thursday</option>
                            <option value="Sunday">Sunday</option>
                        </select>
                        @error('day') <span style="color: #8B0000">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 mb-md-4 mb-sm-4 mt-4 mt-md-2">
                    <label class="form-label">Sched (Time)*</label>
                    <input type="text" class="form-control" wire:model="time" required>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 mb-md-4 mb-sm-4 mt-4 mt-lg-2">
                    <div>
                        <label class="form-label">Gift*</label>
                    </div>
                    <div>
                        <select class="form-select" aria-label="Default select example" wire:model="gift" required>
                            <option value="">Select Gift</option>
                            <option value="2 night Marriott Hotel stay with Round Trip Airfare for 2 adults">- 2 night Marriott Hotel stay with Round Trip Airfare for 2 adults</option>
                            <option value="7 Night Caribbean Cruise for 2 adults">- 7 Night Caribbean Cruise for 2 adults</option>
                        </select>
                        @error('gift') <span style="color: #8B0000">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
{{--            <div class="row">--}}
{{--                <div class="col-xl-3 col-lg-3 col-md-6 mb-md-4 mb-sm-4 mt-sm-2">--}}
{{--                    <label class="form-label">Date (U.S Time)*</label>--}}
{{--                    <input type="text" id="datepicker" class="form-control" wire:model="date" required>--}}
{{--                </div>--}}
{{--                <div class="col-xl-3 col-lg-3 col-md-6 mb-md-4 mb-sm-4 mt-4 mt-md-2">--}}
{{--                    <label class="form-label">Name of Customer*</label>--}}
{{--                    <input type="text" class="form-control" wire:model="claimant" required>--}}
{{--                </div>--}}
{{--                <div class="col-xl-3 col-lg-3 col-md-6 mb-md-4 mb-sm-4 mt-4 mt-lg-2">--}}
{{--                    <label class="form-label">Phone Number*</label>--}}
{{--                    <input type="text" class="form-control" wire:model="phoneNumber" required>--}}
{{--                    @error('phoneNumber') <span style="color: #8B0000">{{ $message }}</span> @enderror--}}
{{--                </div>--}}
{{--                <div class="col-xl-3 col-lg-3 col-md-6 mb-md-4 mb-sm-4 mt-4 mt-lg-2">--}}
{{--                    <label class="form-label">Alt. Phone Number*</label>--}}
{{--                    <input type="text" class="form-control" wire:model="altPhoneNumber" placeholder="Enter &quot;0&quot; if not applicable" required>--}}
{{--                    @error('altPhoneNumber') <span style="color: #8B0000">{{ $message }}</span> @enderror--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="mt-lg-2 row" x-data="{ selectedOption: '' }">--}}
{{--                <div class="col-xl-4 col-lg-4 col-md-6 mb-md-2 mb-sm-1 mt-4 mt-lg-3">--}}
{{--                    <div>--}}
{{--                        <label class="form-label">Disposition*</label>--}}
{{--                    </div>--}}
{{--                    <div>--}}
{{--                        <select class="form-select" aria-label="Default select example" wire:model.live="dtvRemarks" x-model="selectedOption" required>--}}
{{--                            <option value="">Select Disposition</option>--}}
{{--                            <option value="Transfered">Transfered</option>--}}
{{--                            <option value="Need To Retransfer">Need To Retransfer</option>--}}
{{--                            <option value="Not Serviceable">Not Serviceable</option>--}}
{{--                            <option value="Callback">Callback</option>--}}
{{--                            <option value="Not Qualified">Not Qualified</option>--}}
{{--                            <option value="Declined">Declined</option>--}}
{{--                            <option value="Already Have The Service">Already Have The Service</option>--}}
{{--                            <option value="HU">HU</option>--}}
{{--                            <option value="Invalid TO">Invalid TO</option>--}}
{{--                            <option value="TCPA/Litigator">TCPA/Litigator</option>--}}
{{--                            <option value="Blacklist">Blacklist</option>--}}
{{--                            <option value="DNC">DNC</option>--}}
{{--                        </select>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-xl-4 col-lg-4 col-md-6 mb-md-4 mb-sm-4 mt-2 mt-md-5">--}}
{{--                    <select class="form-select" aria-label="Default select example" wire:model="desciption" x-show="selectedOption === 'Transfered'" @if($dtvRemarks == "Transfered") required @endif>--}}
{{--                        <option value="">Name Of Closer</option>--}}
{{--                        <option value="High Risk">Gabriel </option>--}}
{{--                        <option value="Med Risk">Rodrigo</option>--}}
{{--                    </select>--}}
{{--                    <select class="form-select" aria-label="Default select example" wire:model="desciption" x-show="selectedOption === 'Need To Retransfer'" @if($dtvRemarks == "Need To Retransfer") required @endif>--}}
{{--                        <option value="">Reason For Retransfer</option>--}}
{{--                        <option value="High Risk">Customer Line HU</option>--}}
{{--                        <option value="Med Risk">Closer Line HU</option>--}}
{{--                    </select>--}}
{{--                    <input type="text" id="datepicker" class="form-control" wire:model="desciption" placeholder="Date of Callback" x-show="selectedOption === 'Callback'" @if($dtvRemarks == "Callback") required @endif>--}}
{{--                    <textarea class="form-control" rows="2" id="reason" wire:model="desciption"  style="border: none;" placeholder="Reason:" x-show="selectedOption === 'Invalid TO'" @if($dtvRemarks == "Invalid TO") required @endif></textarea>--}}
{{--                    <textarea class="form-control" rows="2" id="reason" wire:model="desciption"  style="border: none;" placeholder="Reason:" x-show="selectedOption === 'Not Serviceable'" @if($dtvRemarks == "Not Serviceable") required @endif></textarea>--}}
{{--                    <textarea class="form-control mt-2" rows="2" id="reason" wire:model="callbackReason"  style="border: none;" placeholder="Reason:" x-show="selectedOption === 'Callback'" @if($dtvRemarks == "Callback") required @endif></textarea>--}}
{{--                    <textarea class="form-control" rows="2" id="reason" wire:model="desciption"  style="border: none;" placeholder="Reason:" x-show="selectedOption === 'Not Qualified'" @if($dtvRemarks == "Not Qualified") required @endif></textarea>--}}
{{--                    <textarea class="form-control" rows="2" id="reason" wire:model="desciption"  style="border: none;" placeholder="Reason:" x-show="selectedOption === 'Declined'" @if($dtvRemarks == "Declined") required @endif></textarea>--}}
{{--                    <textarea class="form-control" rows="2" id="reason" wire:model="desciption"  style="border: none;" placeholder="Reason:" x-show="selectedOption === 'HU'" @if($dtvRemarks == "HU") required @endif></textarea>--}}
{{--                </div>--}}
{{--            </div>--}}
            <div class="row">
                <div class="col-xl-3 col-lg-3 col-md-6 mb-md-4 mb-sm-4 mt-sm-2">
                    <label  class="form-label">Agent*</label>
                    <input type="text" class="form-control" wire:model.live="agent" wire:blur="removeSearch" required>
                    @if(session()->has('badAgent'))
                        <small style="color: #800000">Agent's name should be selected from the search suggestions.</small>
                    @endif
                    @if($showSearch == true)
                        <div style="position: absolute; box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.9);">
                            <ul class="list-group">
                                @foreach($results as $data)
                                    <li class="list-group-item btn text-start" style="background-color: #E0FFFF;" wire:click="click_items({{$data->id}})">
                                        <i class="fa-solid fa-magnifying-glass me-3"></i> {{ucfirst($data->fname)}} {{ucfirst($data->lname)}}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @error('agent') <span style="color: #8B0000">{{ $message }}</span> @enderror
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 mb-md-4 mb-sm-4 mt-4 mt-md-2">
                    <label  class="form-label">Coach*</label>
                    <input type="text" class="form-control" wire:model.live="coach" wire:blur="removeSearchCoach" required>
                    @if($showSearchCoach == true)
                        <div style="position: absolute; box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.9);">
                            <ul class="list-group">
                                @foreach($resultsCoach as $data)
                                    <li class="list-group-item btn text-start" style="background-color: #E0FFFF;" wire:click="click_itemsCoach({{$data->id}})">
                                        <i class="fa-solid fa-magnifying-glass me-3"></i> {{ucfirst($data->fname)}} {{ucfirst($data->lname)}}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @error('coach') <span style="color: #8B0000">{{ $message }}</span> @enderror
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 mb-md-4 mb-sm-4 mt-4 mt-lg-2">
                    <label  class="form-label">Verifier*</label>
                    <input type="text" class="form-control" wire:model.live="verifier" wire:blur="removeSearchVerifier">
                    @if($showSearchVerifier == true)
                        <div style="position: absolute; box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.9);">
                            <ul class="list-group">
                                @foreach($resultsVerifier as $data)
                                    <li class="list-group-item btn text-start" style="background-color: #E0FFFF;" wire:click="click_itemsVerifier({{$data->id}})">
                                        <i class="fa-solid fa-magnifying-glass me-3"></i> {{ucfirst($data->fname)}} {{ucfirst($data->lname)}}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @error('verifier') <span style="color: #8B0000">{{ $message }}</span> @enderror
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 mb-md-4 mb-sm-4 mt-4 mt-lg-2">
                    <div>
                        <label class="form-label">Source*</label>
                    </div>
                    <div>
                        <select class="form-select" aria-label="Default select example" wire:model="source" required>
                            <option value="">Select Source</option>
                            <option value="Dialer">Dialer</option>
                            <option value="Agent callback">Agent callback</option>
                            <option value="DQ from other campaign">DQ from other campaign</option>
                            <option value="Retransfer">Retransfer</option>
                            <option value="Rework">Rework</option>
                            <option value="Special lead">Special lead</option>
                        </select>
                        @error('source') <span style="color: #8B0000">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-3 col-lg-3 col-md-6 mb-md-4 mb-sm-4 mt-sm-2">
                    <div>
                        <label class="form-label">Remark*</label>
                    </div>
                    <div>
                        <select class="form-select" aria-label="Default select example" wire:model="remarks" required>
                            <option value="">Select remark</option>
                            <option value="Verified - Billable">Verified - Billable</option>
                            <option value="Verified - Pending Result">Verified - Pending Result</option>
                            <option value="Verified - Callback">Verified - Callback</option>
                            <option value="Verified - Reschedule/Rework">Verified - Reschedule/Rework</option>
                            <option value="No Show">No Show</option>
                            <option value="DQ by Manager">DQ by Manager</option>
                            <option value="DQ by QA">DQ by QA</option>
                            <option value="DQ Criteria">DQ Criteria</option>
                            <option value="TO - Declined Offer">TO - Declined Offer</option>
                            <option value="Verified - Declined Offer">Verified - Declined Offer</option>
                            <option value="Turnover - For Callback">Turnover - For Callback</option>
                            <option value="DNC">DNC</option>
                            <option value="Blacklist">Blacklist</option>
                        </select>
                        @error('remarks') <span style="color: #8B0000">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 mb-md-4 mb-sm-4 mt-4 mt-md-2">
                    <label  class="form-label">Reason*</label>
                    <textarea type="text" class="form-control" wire:model="reason"> </textarea>
                    @error('reason') <span style="color: #8B0000">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="mt-lg-3 mt-md-0 row">
                <div class="col-lg-4 col-md-8 mb-md-3 mb-sm-2 mt-4 mt-lg-2" >
                    <button type="submit" class="btn btn-warning w-100">Submit</button>
                </div>
                <div class="col-lg-3 col-md-4 mb-sm-4 mt-3 mt-md-4 mt-lg-2">
                    <button type="button" class="btn btn-primary w-100" wire:click="clearInput">Clear</button>
                </div>
            </div>
        </form>
        <button id="btn123" data-bs-toggle="modal" data-bs-target="#loading" style="display: none"></button>
    </div>
    @script
    <script>
        $wire.on('submitSuccess', () => {
            Swal.fire({
                title: 'Successfully Submitted!',
                icon: 'success',
                confirmButtonText: 'OK',
                allowOutsideClick: false, // Prevent closing by clicking outside
                allowEscapeKey: false,   // Prevent closing with the Escape key
            }).then((result) => {
                if (result.isConfirmed) {
                    location.reload(); // Reload the page when "OK" is clicked
                }
            });
        });

        $wire.on('submitFailed', () => {
            Swal.fire({
                title: 'Failed to Submit!',
                icon: 'error',
                confirmButtonText: 'OK',
                allowOutsideClick: false, // Prevent closing by clicking outside
                allowEscapeKey: false,   // Prevent closing with the Escape key
            }).then((result) => {
                if (result.isConfirmed) {
                    // Optional: Add any logic here if needed after clicking "OK"
                }
            });
        });
    </script>
    @endscript
</div>

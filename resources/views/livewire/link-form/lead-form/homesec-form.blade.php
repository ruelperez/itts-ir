<div>
    <div>
        <h5>Lead Form</h5>
    </div>
    <div style="background-color: #696969; color: white;border-radius: 2%;" class="px-3 py-2 px-sm-4 py-sm-4 mt-4">
        @include('components.submission-form.campaign-link')
        <form wire:submit.prevent="submitHomeSec">
            <div class="row">
                <div class="col-xl-3 col-lg-3 col-md-6 mb-md-4 mb-sm-4 mt-sm-2">
                    <label class="form-label">Date (U.S Time)*</label>
                    <input type="text" id="datepicker" class="form-control" wire:model="date" required>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 mb-md-4 mb-sm-4 mt-4 mt-md-2">
                    <label class="form-label">Name of Customer*</label>
                    <input type="text" class="form-control" wire:model="claimant" required>
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
            </div>
            <div class="mt-lg-2 row">
                <div class="col-xl-3 col-lg-3 col-md-6 mb-md-4 mb-sm-4 mt-4 mt-lg-2">
                    <label class="form-label">Email*</label>
                    <input type="email" class="form-control" wire:model="email" required>
                    @error('email') <span style="color: #8B0000">{{ $message }}</span> @enderror
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 mb-md-4 mb-sm-4 mt-4 mt-lg-2">
                    <label class="form-label">Service Address*</label>
                    <input type="text" class="form-control" wire:model="address" required>
                    @error('address') <span style="color: #8B0000">{{ $message }}</span> @enderror
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 mb-md-4 mb-sm-4 mt-4 mt-lg-2">
                    <label class="form-label">Reference City & Zip*</label>
                    <input type="text" class="form-control" wire:model="referenceCityZip" required>
                    @error('referenceCityZip') <span style="color: #8B0000">{{ $message }}</span> @enderror
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 mb-md-4 mb-sm-4 mt-4 mt-lg-2">
                    <label class="form-label">Distance/Time Diff.*</label>
                    <input type="text" class="form-control" wire:model="distanceTimeDiff" required>
                    @error('distanceTimeDiff') <span style="color: #8B0000">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="mt-lg-2 row" x-data="{ selectedOption: '' }">
                <div class="col-xl-4 col-lg-4 col-md-6 mb-md-2 mb-sm-1 mt-4 mt-lg-3">
                    <div>
                        <label class="form-label">Disposition*</label>
                    </div>
                    <div>
                        <select class="form-select" aria-label="Default select example" wire:model.live="dtvRemarks" x-model="selectedOption" required>
                            <option value="">Select Disposition</option>
                            <option value="Transfered">Transfered</option>
                            <option value="Need To Retransfer">Need To Retransfer</option>
                            <option value="Not Serviceable">Not Serviceable</option>
                            <option value="Callback">Callback</option>
                            <option value="Not Qualified">Not Qualified</option>
                            <option value="Declined">Declined</option>
                            <option value="Already Have The Service">Already Have The Service</option>
                            <option value="HU">HU</option>
                            <option value="Invalid TO">Invalid TO</option>
                            <option value="TCPA/Litigator">TCPA/Litigator</option>
                            <option value="Blacklist">Blacklist</option>
                            <option value="DNC">DNC</option>
                        </select>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-6 mb-md-4 mb-sm-4 mt-lg-5 mt-2 mt-md-5">
                    <select class="form-select" aria-label="Default select example" wire:model="desciption" x-show="selectedOption === 'Transfered'" @if($dtvRemarks == "Transfered") required @endif>
                        <option value="">Name Of Closer</option>
                        <option value="High Risk">Gabriel </option>
                        <option value="Med Risk">Roberto</option>
                    </select>
                    <select class="form-select" aria-label="Default select example" wire:model="desciption" x-show="selectedOption === 'Need To Retransfer'" @if($dtvRemarks == "Need To Retransfer") required @endif>
                        <option value="">Reason For Retransfer</option>
                        <option value="High Risk">Customer Line HU</option>
                        <option value="Med Risk">Closer Line HU</option>
                    </select>
                    <input type="text" id="datepicker" class="form-control" wire:model="desciption" placeholder="Date of Callback" x-show="selectedOption === 'Callback'" @if($dtvRemarks == "Callback") required @endif>
                    <textarea class="form-control" rows="2" id="reason" wire:model="desciption"  style="border: none;" placeholder="Reason:" x-show="selectedOption === 'Invalid TO'" @if($dtvRemarks == "Invalid TO") required @endif></textarea>
                </div>
            </div>
            <div class="mt-lg-2 row">
                <div class="col-xl-4 col-lg-4 col-md-6 mb-md-4 mb-sm-4 mt-4">
                    <label  class="form-label">Agent*</label>
                    <input type="text" class="form-control" wire:model.live="agent" wire:blur="removeSearch" wire:click="clickSearch" required>
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
                <div class="col-xl-4 col-lg-4 col-md-6 mb-md-4 mb-sm-4 mt-4 mt-lg-4">
                    <label  class="form-label">Coach*</label>
                    <input type="text" class="form-control" wire:model.live="coach" wire:blur="removeSearchCoach" wire:click="clickSearchCoach" required>
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
                <div class="col-xl-4 col-lg-4 col-md-6 mb-md-4 mb-sm-4 mt-4 mt-lg-4">
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
            <div class="mt-lg-3 mt-md-0 row">
                <div class="col-lg-4 col-md-8 mb-md-3 mb-sm-2 mt-4 mt-lg-2" >
                    <button type="submit" class="btn btn-warning w-100">Submit</button>
                </div>
                <div class="col-lg-3 col-md-4 mb-sm-4 mt-3 mt-md-4 mt-lg-2">
                    <button type="button" class="btn btn-primary w-100" wire:click="clear">Clear</button>
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
                confirmButtonText: 'OK'
            });
        });
        $wire.on('submitFailed', () => {
            Swal.fire({
                title: 'Failed to Submit!',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        });
    </script>
    @endscript
</div>

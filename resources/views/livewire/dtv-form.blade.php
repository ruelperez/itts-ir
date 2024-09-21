<div>
    @include('components.layouts.profile')
    @include('components.layouts.navigation')
    @include('modal.click-settings')
    @include('modal.news-update.show-photo')
    @include('modal.submission.saveOrNot')
    <div style="display: flex; width: 100%; margin-top: 105px;">
        <div style="width: 81%; margin-left: 19%;">
            <div class="container">
                <div>
                    <h5 style="margin-left: 2%; margin-top: 3%;">Lead Form</h5>
                </div>
                <div style="background-color: #696969; color: white;border-radius: 2%;" class="px-sm-4 py-sm-4">
                    <div class="row">
                        <div class="">

                        </div>
                        <div class="col-sm-12 mb-2 text-center">
                            <h4>Direct TV</h4>
                        </div>
                        <div class="">

                        </div>
                    </div>
                    <div class="mb-2"><i>Put "n/a" if not applicable</i></div>
                    <div class="row mb-4 mt-4">
                        <div class="col-lg-3 col-md-3">
                            <button class="btn btn-primary dropdown-toggle w-100" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                DIRECT TV
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item" href="/itts/24/mass-tort-form">Mass Tort</a></li>
                                <li><a class="dropdown-item" href="/itts/24/dtv-form">Direct TV</a></li>
                            </ul>
                        </div>
                    </div>
                        <form wire:submit.prevent="submitDTV">
                            <div class="mt-lg-2 row">
                                <div class="col-xl-3 col-lg-3 col-md-12 mb-md-4 mb-sm-4">
                                    <label class="form-label">Date (U.S Time)*</label>
                                    <input type="text" id="datepicker" class="form-control" wire:model="date" required>
                                </div>
                                <div class="col-xl-3 col-lg-3 col-md-12 mb-md-4 mb-sm-4">
                                    <label class="form-label">Name of Customer*</label>
                                    <input type="text" class="form-control" wire:model="claimant" required>
                                </div>
                                <div class="col-xl-3 col-lg-3 col-md-12 mb-md-4 mb-sm-4">
                                    <label class="form-label">Phone Number*</label>
                                    <input type="text" class="form-control" wire:model="phoneNumber" required>
                                    @error('phoneNumber') <span style="color: #8B0000">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-xl-3 col-lg-3 col-md-12 mb-md-4 mb-sm-4">
                                    <label class="form-label">Alt. Phone Number*</label>
                                    <input type="text" class="form-control" wire:model="altPhoneNumber" placeholder="Enter &quot;0&quot; if not applicable" required>
                                    @error('altPhoneNumber') <span style="color: #8B0000">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="mt-lg-2 row">
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-md-4 mb-sm-4">
                                    <label class="form-label">Email*</label>
                                    <input type="email" class="form-control" wire:model="email" required>
                                    @error('email') <span style="color: #8B0000">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-md-4 mb-sm-4">
                                    <label class="form-label">Service Address*</label>
                                    <input type="text" class="form-control" wire:model="address" required>
                                    @error('address') <span style="color: #8B0000">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-md-4 mb-sm-4">
                                    <div>
                                        <label class="form-label">Service*</label>
                                    </div>
                                    <div>
                                        <select class="form-select" aria-label="Default select example" wire:model="service" required>
                                            <option value="">Select Service</option>
                                            <option value="DirecTV via Internet">DirecTV via Internet</option>
                                            <option value="DirecTV via Satellite">DirecTV via Satellite</option>
                                            <option value="AT&T Internet">AT&T Internet</option>
                                            <option value="Bundle DTV and AT&T">Bundle DTV and AT&T</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-lg-2 row" x-data="{ selectedOption: '' }">
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-md-4 mb-sm-4">
                                    <div>
                                        <label class="form-label">Package*</label>
                                    </div>
                                    <div>
                                        <select class="form-select" aria-label="Default select example" wire:model="package">
                                            <option value="">Select Package</option>
                                            <option value="Entertainment">Entertainment</option>
                                            <option value="Choice">Choice</option>
                                            <option value="Ultimate">Ultimate</option>
                                            <option value="Premier">Premier</option>
                                            <option value="Entertainment - No Local">Entertainment - No Local</option>
                                            <option value="Choice - No Local">Choice - No Local</option>
                                            <option value="Ultimate - No Local">Ultimate - No Local</option>
                                            <option value="Premier - No Local">Premier - No Local</option>
                                            <option value="Internet">Internet</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-md-2 mb-sm-1">
                                    <div>
                                        <label class="form-label">Disposition*</label>
                                    </div>
                                    <div>
                                        <select class="form-select" aria-label="Default select example" wire:model.live="dtvRemarks" x-model="selectedOption" required>
                                            <option value="">Select Disposition</option>
                                            <option value="General Inquiry">General Inquiry</option>
                                            <option value="Sale">Sale</option>
                                            <option value="Callback">Callback</option>
                                            <option value="Not Serviceable">Not Serviceable</option>
                                            <option value="Declined Offer">Declined Offer</option>
                                            <option value="Not Qualify">Not Qualify</option>
                                            <option value="TCPA/Litigator">TCPA/Litigator</option>
                                            <option value="Blacklist">Blacklist</option>
                                            <option value="DNC">DNC</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-md-4 mb-sm-4 mt-lg-4">
                                    <input type="text" id="datepicker" class="form-control" wire:model="desciption" placeholder="Date of Sales" x-show="selectedOption === 'Sale'" @if($dtvRemarks == "Sale") required @endif >
                                    <input type="text" id="datepicker" class="form-control" wire:model="desciption" placeholder="Date of Callback" x-show="selectedOption === 'Callback'" @if($dtvRemarks == "Callback") required @endif>
                                    <textarea class="form-control" rows="2" wire:model="desciption"  style="border: none;" placeholder="Reason:" x-show="selectedOption === 'Declined Offer'" @if($dtvRemarks == "Declined Offer") required @endif></textarea>
                                    <select class="form-select" aria-label="Default select example" wire:model="desciption" x-show="selectedOption === 'Not Qualify'" @if($dtvRemarks == "Not Qualify") required @endif>
                                        <option value="">Select</option>
                                        <option value="High Risk">High Risk</option>
                                        <option value="Med Risk">Med Risk</option>
                                        <option value="Bank Reject">Bank Reject</option>
                                        <option value="Reject Payment">Reject Payment</option>
                                        <option value="Already has the same service">Already has the same service</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mt-lg-2 row">
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-md-4 mb-sm-4">
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
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-md-4 mb-sm-4">
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
                                <div class="col-xl-4 col-lg-4 col-md-12 mb-md-4 mb-sm-4">
                                    <label class="form-label">Order ID*</label>
                                    <input type="text" class="form-control" wire:model="orderNumber" placeholder="Enter &quot;0&quot; if not applicable" required>
                                    @error('orderNumber') <span style="color: #8B0000">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="mt-lg-3 mt-md-3 row">
                                <div class="col-lg-4 mb-sm-4">

                                </div>
                                <div class="col-lg-4 col-md-12 mb-md-3 mb-sm-2">
                                    <button type="submit" class="btn btn-warning w-100">Submit</button>
                                </div>
                                <div class="col-lg-1 mb-sm-2">

                                </div>
                                <div class="col-lg-3 col-md-12 mb-sm-4">
                                    <button type="button" class="btn btn-primary w-100" wire:click="clear">Clear</button>
                                </div>
                            </div>
                        </form>
                        <button id="btn123" data-bs-toggle="modal" data-bs-target="#loading" style="display: none"></button>
                </div>
            </div>
        </div>
    </div>
    @include('partial.header')
    @script
    <script>
        $wire.on('subSubmitted', () => {
            $('#btn123').click();
        });
    </script>
    @endscript
</div>

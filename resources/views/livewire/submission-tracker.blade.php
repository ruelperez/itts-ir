<div>
    @include('components.layouts.profile')
    @include('components.layouts.navigation')
    @include('modal.click-settings')
    @include('modal.news-update.show-photo')
    <div style="display: flex; width: 100%; margin-top: 105px;">
        <div style="width: 81%; margin-left: 19%;">
            <div class="container">
                <div>
                    <h6 style="margin-left: 2%; margin-top: 3%;">Submission Tracker </h6>
                </div>
                <div style="background-color: #696969; color: white; padding: 15px 40px; width: 80%; margin-left: 10%; border-radius: 2%;" class="mt-2">
                    <form wire:submit.prevent="submit">
                        <div class="row">
                            <div class="col-4">
                                <label class="form-label">Date*</label>
                                <input type="text" id="datepicker" class="form-control" wire:model="date" required>
                            </div>
                            <div class="col-4">
                                <div>
                                    <label class="form-label">Campaign*</label>
                                </div>
                                <div>
                                    <select class="form-select" aria-label="Default select example" wire:model.live="campaign">
                                        @foreach($campaignList as $list)
                                            <option value="{{$list->campaign}}">{{$list->campaign}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-4">
                                <div>
                                    <label class="form-label">Client*</label>
                                </div>
                                <div>
                                    <select class="form-select" aria-label="Default select example" wire:model="client">
                                        @foreach($clientList as $list)
                                            <option value="{{$list->client}}">{{$list->client}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 row">
                            <div class="col-4">
                                <div>
                                    <label class="form-label">Self / OBO</label>
                                </div>
                                <div>
                                    <select class="form-select" aria-label="Default select example" wire:model.live="caseType">
                                        <option value="self">Self</option>
                                        <option value="obo">OBO</option>
                                    </select>
                                </div>
                            </div>
                            @if($caseType == "obo")
                                <div class="col-4">
                                    <label class="form-label">Name of Claimant*</label>
                                    <input type="text" class="form-control"  wire:model="claimant" required>
                                </div>
                                <div class="col-4">
                                    <label class="form-label">Name of Injured Party*</label>
                                    <input type="text" class="form-control" wire:model="injuredParty" required>
                                </div>
                            @endif
                            @if($caseType == "self")
                                <div class="col-4">
                                    <label class="form-label">Name of Injured Party*</label>
                                    <input type="text" class="form-control" wire:model="injuredParty" required>
                                </div>
                            @endif

                        </div>
                        <div class="mt-4 row">
                            <div class="col-4">
                                <label class="form-label">Phone Number*</label>
                                <input type="text" class="form-control"  aria-describedby="emailHelp"  wire:model="phoneNumber" required>
                                @error('phoneNumber') <span style="color: #8B0000">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-4">
                                <label  class="form-label">Alt. Phone number</label>
                                <input type="text" class="form-control" wire:model="altPhoneNumber">
                                @error('altPhoneNumber') <span style="color: #8B0000">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-4">
                                <label  class="form-label">DOB*</label>
                                <input type="text" id="datepickerDob" class="form-control" wire:model="dob" required>
                            </div>
                        </div>
                        <div class="mt-4 row">
                            <div class="col-4">
                                <label  class="form-label">Email*</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" wire:model="email" required>
                            </div>
                            <div class="col-5">
                                <label class="form-label">Address*</label>
                                <input type="text" class="form-control" wire:model="address" required>
                            </div>
                            <div class="col-3">
                                <label  class="form-label">SSN*</label>
                                <input type="text" class="form-control"  wire:model="ssn" required>
                                @error('ssn') <span style="color: #8B0000">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="mt-4 row">
                            <div class="col-3">
                                <label  class="form-label">Agent*</label>
                                <input type="text" class="form-control" wire:model.live="agent" wire:blur="removeSearch" wire:click="clickSearch" required>
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
                            </div>
                            <div class="col-3">
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
                            </div>
                            <div class="col-3">
                                <label  class="form-label">Verifier*</label>
                                <input type="text" class="form-control" wire:model.live="verifier" wire:blur="removeSearchVerifier" wire:click="clickSearchVerifier" required>
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
                            </div>
                            <div class="col-3">
                                <div>
                                    <label class="form-label">Source*</label>
                                </div>
                                <div>
                                    <select class="form-select" aria-label="Default select example" wire:model="source">
                                        <option value="self">Dialer</option>
                                        <option value="obo">Agent callback</option>
                                        <option value="self">DQ from other campaign</option>
                                        <option value="obo">Retransfer</option>
                                        <option value="self">Rework</option>
                                        <option value="obo">Special lead</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 row">
                            <div class="col-2">
                                <label class="form-label">Result</label>
                            </div>
                            <div class="col-10">
                                <div class="row mb-3">
                                    <div class="col-3">
                                        <input class="form-check-input" type="checkbox" wire:model="result" value="submitted" id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Submitted
                                        </label>
                                    </div>
                                    <div class="col-3">
                                        <input class="form-check-input" type="checkbox" wire:model="result" value="litigator" id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Litigator
                                        </label>
                                    </div>
                                    <div class="col-3">
                                        <input class="form-check-input" type="checkbox" wire:model="result" value="warmXfer" id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Warm XFER
                                        </label>
                                    </div>
                                    <div class="col-3">
                                        <input class="form-check-input" type="checkbox" wire:model="result" value="federalDNC" id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Federal DNC
                                        </label>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-3">
                                        <input class="form-check-input" type="checkbox" wire:model="result" value="tcpa" id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            TCPA
                                        </label>
                                    </div>
                                    <div class="col-3">
                                        <input class="form-check-input" type="checkbox" wire:model="result" value="alreadyRep" id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Already REP
                                        </label>
                                    </div>
                                    <div class="col-3">
                                        <input class="form-check-input" type="checkbox" wire:model="findings" value="blacklist only" id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Blacklist
                                        </label>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-3">
                                        <input class="form-check-input" type="checkbox" wire:model="findings" value="Diagnos" id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Plaintiff
                                        </label>
                                    </div>
                                    <div class="col-3">
                                        <input class="form-check-input" type="checkbox" wire:model="findings" value="Systems only" id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Thatsthem issue-not found
                                        </label>
                                    </div>
                                    <div class="col-3">
                                        <input class="form-check-input" type="checkbox" wire:model="findings" value="Systems only" id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Felony charge
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mt-4" style="width: 30%; margin-left: 35%;">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @include('partial.header')
</div>

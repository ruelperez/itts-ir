<div wire:ignore.self class="modal" tabindex="-1" id="edit">
    <div class="modal-dialog modal-xl">
        <div class="modal-content" >
            <div class="modal-header">
                <h5 class="modal-title">EDIT</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" id="formClose" aria-label="Close"></button>
            </div>
            <div style="background-color: #696969; color: white; padding: 15px 40px; width: 96%; margin-left: 2%; border-radius: 2%;" class="mt-2">
                <form wire:submit.prevent="submitEdit">
                    <div class="d-flex">
                        <div class="mb-2"><i>Put "n/a" if not applicable</i></div>
                        <div>
                            <i class="fa-solid fa-pen-to-square ms-4" style="cursor: pointer;" title="Edit" wire:click="clickEdit"></i>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-4">
                            <label class="form-label">Date*</label>
                            <input type="text" id="datepickerDupe" class="form-control" wire:model="date" required @if($base == true) disabled @endif >
                        </div>
                        <div class="col-4">
                            <div>
                                <label class="form-label">Campaign*</label>
                            </div>
                            <div>
                                <select class="form-select" aria-label="Default select example" wire:model.live="campaign" @if($base == true) disabled @endif>
                                    @foreach($campaignList as $list)
                                        @if($list->campaign == $campaign)
                                            <option selected value="{{$list->campaign}}">{{$list->campaign}}</option>
                                        @else
                                            <option value="{{$list->campaign}}">{{$list->campaign}}</option>
                                        @endif

                                    @endforeach
                                </select>
                                @error('campaign') <span style="color: #8B0000">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-4">
                            <div>
                                <label class="form-label">Client*</label>
                            </div>
                            <div>
                                <select class="form-select" aria-label="Default select example" wire:model="client" @if($base == true) disabled @endif>
                                    @foreach($clientList as $list)
                                        @if($list->client == $client)
                                            <option selected value="{{$list->client}}">{{$list->client}}</option>
                                        @else
                                            <option value="{{$list->client}}">{{$list->client}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('client') <span style="color: #8B0000">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 row">
                        <div class="col-4">
                            <div>
                                <label class="form-label">Self / OBO</label>
                            </div>
                            <div>
                                <select class="form-select" aria-label="Default select example" wire:model.live="caseType" @if($base == true) disabled @endif>
                                    <option value="self">Self</option>
                                    <option value="obo">OBO</option>
                                </select>
                                @error('caseType') <span style="color: #8B0000">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        @if($caseType == "obo")
                            <div class="col-4">
                                <label class="form-label">Name of Claimant*</label>
                                <input type="text" class="form-control"  wire:model="claimant" required @if($base == true) disabled @endif>
                                @error('claimant') <span style="color: #8B0000">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-4">
                                <label class="form-label">Name of Injured Party*</label>
                                <input type="text" class="form-control" wire:model="injuredParty" required @if($base == true) disabled @endif>
                                @error('injuredParty') <span style="color: #8B0000">{{ $message }}</span> @enderror
                            </div>
                        @endif
                        @if($caseType == "self")
                            <div class="col-4">
                                <label class="form-label">Name of Claimant*</label>
                                <input type="text" class="form-control" wire:model="claimant" required @if($base == true) disabled @endif>
                                @error('claimant') <span style="color: #8B0000">{{ $message }}</span> @enderror
                            </div>
                        @endif

                    </div>
                    <div class="mt-4 row">
                        <div class="col-4">
                            <label class="form-label">Phone Number*</label>
                            <input type="text" class="form-control"  wire:model="phoneNumber" placeholder="Put &quot;0000&quot; if not applicable" required @if($base == true) disabled @endif>
                            @error('phoneNumber') <span style="color: #8B0000">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-4">
                            <label  class="form-label">Alt. Phone number</label>
                            <input type="text" class="form-control" wire:model="altPhoneNumber" placeholder="Put &quot;0000&quot; if not applicable" @if($base == true) disabled @endif>
                            @error('altPhoneNumber') <span style="color: #8B0000">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-4">
                            <label  class="form-label">DOB*</label>
                            <input type="text" id="datepickerDobDupe" class="form-control" wire:model="dob" required @if($base == true) disabled @endif>
                            @error('dob') <span style="color: #8B0000">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="mt-4 row">
                        <div class="col-4">
                            <label  class="form-label">Email*</label>
                            <input type="text" class="form-control" wire:model="email" required @if($base == true) disabled @endif>
                            @error('email') <span style="color: #8B0000">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-5">
                            <label class="form-label">Address*</label>
                            <input type="text" class="form-control" wire:model="address" required @if($base == true) disabled @endif>
                            @error('address') <span style="color: #8B0000">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-3">
                            <label  class="form-label">SSN*</label>
                            <input type="text" class="form-control"  wire:model="ssn" placeholder="Put &quot;0000&quot; if not applicable" required @if($base == true) disabled @endif>
                            @error('ssn') <span style="color: #8B0000">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="mt-4 row">
                        <div class="col-3">
                            <label  class="form-label">Agent*</label>
                            <input type="text" class="form-control" wire:model.live="agent" wire:blur="removeSearch" wire:click="clickSearch" required @if($base == true) disabled @endif>
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
                        <div class="col-3">
                            <label  class="form-label">Coach*</label>
                            <input type="text" class="form-control" wire:model.live="coach" wire:blur="removeSearchCoach" wire:click="clickSearchCoach" required @if($base == true) disabled @endif>
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
                        <div class="col-3">
                            <label  class="form-label">Verifier*</label>
                            <input type="text" class="form-control" wire:model.live="verifier" wire:blur="removeSearchVerifier" wire:click="clickSearchVerifier" required @if($base == true) disabled @endif>
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
                        <div class="col-3">
                            <div>
                                <label class="form-label">Source*</label>
                            </div>
                            <div>
                                <select class="form-select" aria-label="Default select example" wire:model="source" required @if($base == true) disabled @endif>
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
                    <div class="mt-4 row">
                        @if($base == true)
                            <div class="col-4">
                                <label class="form-label">Remarks - {{$displayRemarks}}</label>
                            </div>
                            <div class="col-4 d-flex">
                                <div>
                                    <label class="form-label me-3">Result</label>
                                </div>
                                <div>
                                    <select class="form-select" aria-label="Default select example" wire:model.live="result">
                                        <option value="Signed / Executed">Signed / Executed</option>
                                        <option value="Return by Client">Return by Client</option>
                                        <option value="DQ - Criteria">DQ - Criteria</option>
                                        <option value="DQ by Client">DQ by Client</option>
                                        <option value="DQ by QA">DQ by QA</option>
                                        <option value="DQ BTY Manager">DQ BTY Manager</option>
                                        <option value="DQ by VER">DQ by VER</option>
                                        <option value="Pending">Pending</option>
                                    </select>
                                    @error('result') <span style="color: #8B0000">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        @else
                            <div class="col-2">
                                <label class="form-label">Remarks</label>
                            </div>
                            <div class="col-10">
                                <div class="row mb-3">
                                    <div class="col-3">
                                        <input class="form-check-input" type="checkbox" wire:model="remarks" value="Submitted" id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Submitted
                                        </label>
                                    </div>
                                    <div class="col-3">
                                        <input class="form-check-input" type="checkbox" wire:model="remarks" value="Litigator" id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Litigator
                                        </label>
                                    </div>
                                    <div class="col-3">
                                        <input class="form-check-input" type="checkbox" wire:model="remarks" value="Warm XFER" id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Warm XFER
                                        </label>
                                    </div>
                                    <div class="col-3">
                                        <input class="form-check-input" type="checkbox" wire:model="remarks" value="Federal DNC" id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Federal DNC
                                        </label>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-3">
                                        <input class="form-check-input" type="checkbox" wire:model="remarks" value="TCPA" id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            TCPA
                                        </label>
                                    </div>
                                    <div class="col-3">
                                        <input class="form-check-input" type="checkbox" wire:model="remarks" value="Already REP" id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Already REP
                                        </label>
                                    </div>
                                    <div class="col-3">
                                        <input class="form-check-input" type="checkbox" wire:model="remarks" value="Blacklist" id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Blacklist
                                        </label>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-3">
                                        <input class="form-check-input" type="checkbox" wire:model="remarks" value="Plaintiff" id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Plaintiff
                                        </label>
                                    </div>
                                    <div class="col-3">
                                        <input class="form-check-input" type="checkbox" wire:model="remarks" value="Thatsthem issue-not found" id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Thatsthem issue-not found
                                        </label>
                                    </div>
                                    <div class="col-3">
                                        <input class="form-check-input" type="checkbox" wire:model="remarks" value="Felony charge" id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Felony charge
                                        </label>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    @if($base == false)
                        <div class="mt-2 row">
                            <div class="col-4 d-flex">
                                <div>
                                    <label class="form-label me-3">Result</label>
                                </div>
                                <div>
                                    <select class="form-select" aria-label="Default select example" wire:model.live="result">
                                        <option value="Signed / Executed">Signed / Executed</option>
                                        <option value="Return by Client">Return by Client</option>
                                        <option value="DQ - Criteria">DQ - Criteria</option>
                                        <option value="DQ by Client">DQ by Client</option>
                                        <option value="DQ by QA">DQ by QA</option>
                                        <option value="DQ BTY Manager">DQ BTY Manager</option>
                                        <option value="DQ by VER">DQ by VER</option>
                                        <option value="Pending">Pending</option>
                                    </select>
                                    @error('result') <span style="color: #8B0000">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                    @endif
                    <button type="submit" class="btn btn-primary mt-4" style="width: 30%; margin-left: 35%;">UPDATE</button>
                </form>
                <button id="btn123456" data-bs-toggle="modal" data-bs-target="#loading" style="display: none"></button>
            </div>
        </div>
    </div>
</div>

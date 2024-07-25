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
                    <h6 style="margin-left: 2%; margin-top: 3%;">Submission Tracker </h6>
                </div>
                <div style="background-color: #696969; color: white; padding: 15px 40px; width: 80%; margin-left: 10%; border-radius: 2%;" class="mt-2">
                    <form wire:submit.prevent="submit">
                        <div class="mb-2"><i>Put "n/a" if not applicable</i></div>
                        <div class="row">
                            <div class="col-3">
                                <label class="form-label">Date*</label>
                                <input type="text" id="datepicker" class="form-control" wire:model="date" required>
                            </div>
                            <div class="col-3">
                                <div>
                                    <label class="form-label">Campaign*</label>
                                </div>
                                <div>
                                    <select class="form-select" aria-label="Default select example" wire:model.live="campaign">
                                        <option value="selectCampaign">Select Campaign</option>
                                        <option value="n/a">n/a</option>
                                        @foreach($campaignList as $list)
                                            <option @if($campaign == $list->campaign) selected @else @endif value="{{$list->campaign}}">{{$list->campaign}}</option>
                                        @endforeach
                                    </select>
                                    @error('campaign') <span style="color: #8B0000">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-3">
                                <div>
                                    <label class="form-label">Client*</label>
                                </div>
                                <div>
                                    <select class="form-select" aria-label="Default select example" wire:model.live="client" @if($campaign == "selectCampaign") disabled @endif>
                                        <option value="selectClient">Select Client</option>
                                        <option value="n/a">n/a</option>
                                        @foreach($clientList as $list)
                                            <option value="{{$list->client}}">{{$list->client}}</option>
                                        @endforeach
                                    </select>
                                    @error('client') <span style="color: #8B0000">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-3">
                                <div>
                                    <label class="form-label">Lawfirm*</label>
                                </div>
                                <div>
                                    <select class="form-select" aria-label="Default select example" wire:model="lawfirm" @if($client == "selectClient") disabled @endif>
                                        <option value="selectLawfirm">Select Lawfirm</option>
                                        <option value="n/a">n/a</option>
                                        @foreach($lawfirmList as $list)
                                            <option value="{{$list->lawfirm}}">{{$list->lawfirm}}</option>
                                        @endforeach
                                    </select>
                                    @error('lawfirm') <span style="color: #8B0000">{{ $message }}</span> @enderror
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
                                    @error('caseType') <span style="color: #8B0000">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            @if($caseType == "obo")
                                <div class="col-4">
                                    <label class="form-label">Name of Claimant*</label>
                                    <input type="text" class="form-control"  wire:model="claimant" required>
                                    @error('claimant') <span style="color: #8B0000">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-4">
                                    <label class="form-label">Name of Injured Party*</label>
                                    <input type="text" class="form-control" wire:model="injuredParty" required>
                                    @error('injuredParty') <span style="color: #8B0000">{{ $message }}</span> @enderror
                                </div>
                            @endif
                            @if($caseType == "self")
                                <div class="col-4">
                                    <label class="form-label">Name of Claimant*</label>
                                    <input type="text" class="form-control" wire:model="claimant" required>
                                    @error('claimant') <span style="color: #8B0000">{{ $message }}</span> @enderror
                                </div>
                            @endif

                        </div>
                        <div class="mt-4 row">
                            <div class="col-4">
                                <label class="form-label">Phone Number*</label>
                                <input type="text" class="form-control"  wire:model="phoneNumber" placeholder="Put &quot;0000&quot; if not applicable" required>
                                @error('phoneNumber') <span style="color: #8B0000">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-4">
                                <label  class="form-label">Alt. Phone number</label>
                                <input type="text" class="form-control" wire:model="altPhoneNumber" placeholder="Put &quot;0&quot; if not applicable" required>
                                @error('altPhoneNumber') <span style="color: #8B0000">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-4">
                                <label  class="form-label">DOB*</label>
                                <input type="text" id="datepickerDob" class="form-control" wire:model="dob" required>
                                @error('dob') <span style="color: #8B0000">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="mt-4 row">
                            <div class="col-4">
                                <label  class="form-label">Email*</label>
                                <input type="text" class="form-control" wire:model="email" required>
                                @error('email') <span style="color: #8B0000">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-5">
                                <label class="form-label">Address*</label>
                                <input type="text" class="form-control" wire:model="address" required>
                                @error('address') <span style="color: #8B0000">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-3">
                                <label  class="form-label">SSN*</label>
                                <input type="text" class="form-control"  wire:model="ssn" placeholder="Put &quot;0&quot; if not applicable" required>
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
                                @error('agent') <span style="color: #8B0000">{{ $message }}</span> @enderror
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
                                @error('coach') <span style="color: #8B0000">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-3">
                                <label  class="form-label">Verifier*</label>
                                <input type="text" class="form-control" wire:model.live="verifier" wire:blur="removeSearchVerifier" wire:click="clickSearchVerifier">
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
                                    <select class="form-select" aria-label="Default select example" wire:model="source" required>
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
                            <div class="col-2">
                                <label class="form-label">Remarks</label>
                            </div>
                            <div class="col-10">
                                <div class="row mb-3">
                                    <div class="col-3">
                                        <input class="form-check-input" type="checkbox" wire:model="remarks" value="Submitted" id="flexCheckDefault" @if($toChecked == true) disabled @endif>
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Submitted
                                        </label>
                                    </div>
                                    <div class="col-3">
                                        <input class="form-check-input" type="checkbox" wire:model="remarks" value="Verified - Signed" id="flexCheckDefault" @if($toChecked == true) disabled @endif>
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Verified - Signed
                                        </label>
                                    </div>
                                    <div class="col-4">
                                        <input class="form-check-input" type="checkbox" wire:model="remarks" value="Verified - For Signing" id="flexCheckDefault" @if($toChecked == true) disabled @endif>
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Verified - For Signing
                                        </label>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-3">
                                        <input class="form-check-input" type="checkbox" wire:model="remarks" value="Transferred" id="flexCheckDefault" @if($toChecked == true) disabled @endif>
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Transferred
                                        </label>
                                    </div>
                                    <div class="col-3">
                                        <input class="form-check-input" type="checkbox" wire:model="remarks" value="Qualify for CB" id="flexCheckDefault" @if($toChecked == true) disabled @endif>
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Qualify for CB
                                        </label>
                                    </div>
                                    <div class="col-3">
                                        <input class="form-check-input" type="checkbox" wire:model="remarks" value="Qualify for Xfer" id="flexCheckDefault" @if($toChecked == true) disabled @endif>
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Qualify for Xfer
                                        </label>
                                    </div>
                                </div>

                                <div class="row mt-5 mb-3">
                                    <div class="col-3">
                                        <input class="form-check-input" type="checkbox" wire:model="remarks" value="DNC" id="flexCheckDefault" @if($toChecked == true) disabled @endif>
                                        <label class="form-check-label" for="flexCheckDefault">
                                            DNC
                                        </label>
                                    </div>
                                    <div class="col-3">
                                        <input class="form-check-input" type="checkbox" wire:model="remarks" value="TCPA" id="flexCheckDefault" @if($toChecked == true) disabled @endif >
                                        <label class="form-check-label" for="flexCheckDefault">
                                            TCPA
                                        </label>
                                    </div>
                                    <div class="col-5">
                                        <input class="form-check-input" type="checkbox" wire:model="remarks" value="ThatsThem Issue - Not found" id="flexCheckDefault" @if($toChecked == true) disabled @endif >
                                        <label class="form-check-label" for="flexCheckDefault">
                                            ThatsThem Issue - Not found
                                        </label>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-3">
                                        <input class="form-check-input" type="checkbox" wire:model="remarks" value="Litigator" id="flexCheckDefault" @if($toChecked == true) disabled @endif>
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Litigator
                                        </label>
                                    </div>
                                    <div class="col-3">
                                        <input class="form-check-input" type="checkbox" wire:model="remarks" value="Already Rep" id="flexCheckDefault" @if($toChecked == true) disabled @endif >
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Already Rep
                                        </label>
                                    </div>
                                    <div class="col-4">
                                        <input class="form-check-input" type="checkbox" wire:model="remarks" value="Felony" id="flexCheckDefault" @if($toChecked == true) disabled @endif >
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Felony
                                        </label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-3">
                                        <input class="form-check-input" type="checkbox" wire:model="remarks" value="Blackllist" id="flexCheckDefault" @if($toChecked == true) disabled @endif>
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Blackllist
                                        </label>
                                    </div>
                                    <div class="col-3">
                                        <input class="form-check-input" type="checkbox" wire:model="remarks" value="Plaintiff" id="flexCheckDefault" @if($toChecked == true) disabled @endif >
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Plaintiff
                                        </label>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" wire:model="checkboxTO"  wire:click="clickTO" value="turnover">
                                            <label class="form-check-label" for="flexCheckChecked">
                                                Turnover
                                            </label>
                                        </div>
                                        @if($toChecked == true)
                                            <textarea class="form-control" rows="2" id="reason" wire:model="turnover"  style="border: none;" placeholder="Reason:" required></textarea>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

{{--                        <div class="mt-4 row">--}}
{{--                            <div class="col-2">--}}
{{--                                <label class="form-label">Remarks</label>--}}
{{--                            </div>--}}
{{--                            <div class="col-10">--}}
{{--                                <div class="row mb-3">--}}
{{--                                    <div class="col-3">--}}
{{--                                        <input class="form-check-input" type="checkbox" wire:model="remarks" value="Submitted" id="flexCheckDefault" @if($toChecked == true) disabled @endif>--}}
{{--                                        <label class="form-check-label" for="flexCheckDefault">--}}
{{--                                            Submitted--}}
{{--                                        </label>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-3">--}}
{{--                                        <input class="form-check-input" type="checkbox" wire:model="remarks" value="Litigator" id="flexCheckDefault" @if($toChecked == true) disabled @endif>--}}
{{--                                        <label class="form-check-label" for="flexCheckDefault">--}}
{{--                                            Litigator--}}
{{--                                        </label>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-3">--}}
{{--                                        <input class="form-check-input" type="checkbox" wire:model="remarks" value="Warm XFER" id="flexCheckDefault" @if($toChecked == true) disabled @endif>--}}
{{--                                        <label class="form-check-label" for="flexCheckDefault">--}}
{{--                                            Warm XFER--}}
{{--                                        </label>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-3">--}}
{{--                                        <input class="form-check-input" type="checkbox" wire:model="remarks" value="Federal DNC" id="flexCheckDefault" @if($toChecked == true) disabled @endif>--}}
{{--                                        <label class="form-check-label" for="flexCheckDefault">--}}
{{--                                            Federal DNC--}}
{{--                                        </label>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="row mb-3">--}}
{{--                                    <div class="col-3">--}}
{{--                                        <input class="form-check-input" type="checkbox" wire:model="remarks" value="TCPA" id="flexCheckDefault" @if($toChecked == true) disabled @endif>--}}
{{--                                        <label class="form-check-label" for="flexCheckDefault">--}}
{{--                                            TCPA--}}
{{--                                        </label>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-3">--}}
{{--                                        <input class="form-check-input" type="checkbox" wire:model="remarks" value="Already REP" id="flexCheckDefault" @if($toChecked == true) disabled @endif>--}}
{{--                                        <label class="form-check-label" for="flexCheckDefault">--}}
{{--                                            Already REP--}}
{{--                                        </label>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-3">--}}
{{--                                        <input class="form-check-input" type="checkbox" wire:model="remarks" value="Blacklist" id="flexCheckDefault" @if($toChecked == true) disabled @endif>--}}
{{--                                        <label class="form-check-label" for="flexCheckDefault">--}}
{{--                                            Blacklist--}}
{{--                                        </label>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-3">--}}
{{--                                        <input class="form-check-input" type="checkbox" wire:model="remarks" value="Plaintiff" id="flexCheckDefault" @if($toChecked == true) disabled @endif>--}}
{{--                                        <label class="form-check-label" for="flexCheckDefault">--}}
{{--                                            Plaintiff--}}
{{--                                        </label>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="row mb-3">--}}
{{--                                    <div class="col-3">--}}
{{--                                        <input class="form-check-input" type="checkbox" wire:model="remarks" value="Thatsthem issue-not found" id="flexCheckDefault" @if($toChecked == true) disabled @endif>--}}
{{--                                        <label class="form-check-label" for="flexCheckDefault">--}}
{{--                                            Thatsthem issue-not found--}}
{{--                                        </label>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-3">--}}
{{--                                        <input class="form-check-input" type="checkbox" wire:model="remarks" value="Felony charge" id="flexCheckDefault" @if($toChecked == true) disabled @endif >--}}
{{--                                        <label class="form-check-label" for="flexCheckDefault">--}}
{{--                                            Felony charge--}}
{{--                                        </label>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-6">--}}
{{--                                        <div class="form-check">--}}
{{--                                            <input class="form-check-input" type="checkbox" wire:model="checkboxTO"  wire:click="clickTO" value="turnover">--}}
{{--                                            <label class="form-check-label" for="flexCheckChecked">--}}
{{--                                                Turnover--}}
{{--                                            </label>--}}
{{--                                        </div>--}}
{{--                                        @if($toChecked == true)--}}
{{--                                            <textarea class="form-control" rows="2" id="reason" wire:model="turnover"  style="border: none;" placeholder="Reason:" required></textarea>--}}
{{--                                        @endif--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <div class="d-flex mt-3">
                            <button type="submit" class="btn btn-warning mt-4" style="width: 30%; margin-left: 35%; margin-right: 10%;">Submit</button>
                            <button type="button" class="btn btn-primary mt-4" style="width: 15%;" wire:click="clear">Clear</button>
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

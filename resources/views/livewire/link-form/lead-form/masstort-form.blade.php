<div>
    @include('modal.news-update.show-photo')
    @include('modal.submission.saveOrNot')
                <div>
                    <h5>Lead Form</h5>
                </div>
                <div style="background-color: #696969; color: white;border-radius: 2%;" class="px-sm-5 py-sm-4 mt-4">
                    @include('components.submission-form.campaign-link')
                    <form wire:submit.prevent="submit">
                        <div class="row" x-data="{ selectedOptions: '' }">
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
                        <div class="row mt-4">
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
                                    <select class="form-select" aria-label="Default select example" wire:model.live="lawfirm" @if($client == "selectClient") disabled @endif>
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
                                <input type="text" class="form-control" wire:model.live="agent" wire:blur="removeSearch" required>
                                @if(session()->has('badAgent'))
                                    <small style="color: #800000">Agent's name should be selected from the search suggestions.</small>
                                @endif
                                @if($showSearch == true)
                                    <div style="position: absolute; box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.9);">
                                        <ul class="list-group">
                                            @foreach($results as $data)
                                                <li class="list-group-item btn text-start" style="background-color: #E0FFFF;" wire:click="click_items({{$data->id}})">
                                                    <i class="fa-solid fa-magnifying-glass me-3"></i> {{ucfirst($data->employeeFullname)}}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                @error('agent') <span style="color: #8B0000">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-3">
                                <label  class="form-label">Coach*</label>
                                <input type="text" class="form-control" wire:model.live="coach" wire:blur="removeSearchCoach" required>
                                @if($showSearchCoach == true)
                                    <div style="position: absolute; box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.9);">
                                        <ul class="list-group">
                                            @foreach($resultsCoach as $data)
                                                <li class="list-group-item btn text-start" style="background-color: #E0FFFF;" wire:click="click_itemsCoach({{$data->id}})">
                                                    <i class="fa-solid fa-magnifying-glass me-3"></i> {{ucfirst($data->employeeFullname)}}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                @error('coach') <span style="color: #8B0000">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-3">
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
                            <div class="col-3">
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
                        <div class="mt-4 row">
                            <div class="col-2">
                                <label class="form-label">Remarks : @if(isset($bbb)) @if($bam == 0) <u>{{strtoupper($bbb->method)}}</u> @endif @endif </label>
                            </div>
                            @if(isset($bbb))
                                @if($bam == 0)
                                    <input type="text" id="input1" value="{{$bbb->method}}" style="display: none">
                                @endif
                            @else
                                <input type="text" id="input1" value="none" style="display: none">
                            @endif
                            <div class="col-10">
                                @if(isset($bbb))
                                    @if($bam == 0)
                                        @if(trim(strtolower($bbb->method)) === trim(strtolower("cpa")))
                                            <div class="row mb-3">
                                                <div class="col-3">
                                                    <input class="form-check-input" type="checkbox" value="signed" wire:model="submission" id="checkbox1" wire:click="clickCplTrans" @if($toChecked == true) disabled @endif>
                                                    <label class="form-check-label" for="flexCheckDefault">
                                                        Signed
                                                    </label>
                                                </div>
                                                <div class="col-3">
                                                    <input class="form-check-input" type="checkbox" wire:model="remarks" value="Callback" id="checkbox2" wire:click="clickBox" @if($toChecked == true) disabled @elseif($cplCheck == true) disabled @endif>
                                                    <label class="form-check-label" for="flexCheckDefault">
                                                        For Callback
                                                    </label>
                                                </div>
                                                <div class="col-4">
                                                    <input class="form-check-input" type="checkbox" wire:model="remarks" value="Not Interested/Declined" id="checkbox3" wire:click="clickBox" @if($toChecked == true) disabled @elseif($cplCheck == true) disabled @endif>
                                                    <label class="form-check-label" for="flexCheckDefault">
                                                        Not Interested/Declined
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-3">
                                                    {{--                                        <input class="form-check-input" type="checkbox" wire:model="remarks" value="Transferred" id="flexCheckDefault" @if($toChecked == true) disabled @endif>--}}
                                                </div>
                                                <div class="col-3">
                                                    <input class="form-check-input" type="checkbox" wire:model="remarks" value="Docs Needed" id="checkbox4" wire:click="clickBox" @if($toChecked == true) disabled @elseif($cplCheck == true) disabled @endif>
                                                    <label class="form-check-label" for="flexCheckDefault">
                                                        Docs Needed
                                                    </label>
                                                </div>
                                                <div class="col-3">
                                                    <input class="form-check-input" type="checkbox" wire:model="remarks" value="DQ" id="checkbox5" wire:click="clickBox" @if($toChecked == true) disabled @elseif($cplCheck == true) disabled @endif>
                                                    <label class="form-check-label" for="flexCheckDefault">
                                                        DQ
                                                    </label>
                                                </div>
                                            </div>
                                            @if($displayComment == true)
                                                <div class="row" id="hm1">
                                                    <div class="col-3">

                                                    </div>
                                                    <div class="col-6">
                                                        <textarea class="form-control" rows="2" wire:model="comment"  style="border: none;" placeholder="Reason:"></textarea>
                                                    </div>
                                                    <div class="col-3">

                                                    </div>
                                                </div>
                                            @endif
                                        @elseif(trim(strtolower($bbb->method)) === trim(strtolower("cpl")))
                                            <div class="row mb-3">
                                                <div class="col-3">
                                                    <input class="form-check-input" type="checkbox" wire:model="submission" id="checkbox6"  wire:click="clickCplTrans" value="transferred" @if($toChecked == true) disabled @endif>
                                                    <label class="form-check-label" for="flexCheckDefault">
                                                        Transferred
                                                    </label>
                                                </div>
                                                <div class="col-3">
                                                    <input class="form-check-input" type="checkbox" wire:model="remarks" value="Need Retransfer" id="checkbox7" wire:click="clickBox" @if($cplCheck == true) disabled @elseif($toChecked == true) disabled @endif>
                                                    <label class="form-check-label" for="flexCheckDefault">
                                                        Need Retransfer
                                                    </label>
                                                </div>
                                                <div class="col-4">
                                                    <input class="form-check-input" type="checkbox" wire:model="remarks" value="For Callback" id="checkbox8" wire:click="clickBox" @if($cplCheck == true) disabled @elseif($toChecked == true) disabled @endif>
                                                    <label class="form-check-label" for="flexCheckDefault">
                                                        For Callback
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="row mb-1">
                                                <div class="col-3">
                                                    <input class="form-check-input" type="checkbox" wire:model="remarks" value="Docs Needed" id="checkbox9" wire:click="clickBox" @if($cplCheck == true) disabled @elseif($toChecked == true) disabled @endif>
                                                    <label class="form-check-label" for="flexCheckDefault">
                                                        Docs Needed
                                                    </label>
                                                </div>
                                                <div class="col-3">
                                                    <input class="form-check-input" type="checkbox" id="checkbox10" wire:model="remarks" value="DQ"  wire:click="clickBox" @if($cplCheck == true) disabled @elseif($toChecked == true) disabled @endif>
                                                    <label class="form-check-label" for="flexCheckDefault">
                                                        DQ
                                                    </label>
                                                </div>
                                                <div class="col-6">
                                                    <input class="form-check-input" type="checkbox" wire:model="remarks" value="For Callback" id="checkbox8" wire:click="clickBox" @if($cplCheck == true) disabled @elseif($toChecked == true) disabled @endif>
                                                    <label class="form-check-label" for="flexCheckDefault">
                                                        For transfer - Closer Unavailable
                                                    </label>
                                                </div>
                                            </div>
                                            @if($displayComment == true)
                                                <div class="row" id="hm2">
                                                    <div class="col-3">

                                                    </div>
                                                    <div class="col-6">
                                                        <textarea class="form-control" rows="2" wire:model="comment"  style="border: none;" placeholder="Reason:"></textarea>
                                                    </div>
                                                    <div class="col-3">

                                                    </div>
                                                </div>
                                            @endif
                                        @else
                                            <div class="row mb-3">
                                                <div class="col-3">
                                                    <input class="form-check-input" type="checkbox" wire:model="submission" value="submitted" id="checkbox11" wire:click="clickCplTrans" id="checkbox11" @if($toChecked == true) disabled @endif>
                                                    <label class="form-check-label" for="flexCheckDefault">
                                                        Submitted
                                                    </label>
                                                </div>
                                                <div class="col-3">
                                                    <input class="form-check-input" type="checkbox" wire:model="remarks" value="For Callback" id="checkbox12" wire:click="clickBox" @if($cplCheck == true) disabled @elseif($toChecked == true) disabled @endif>
                                                    <label class="form-check-label" for="flexCheckDefault">
                                                        For Callback
                                                    </label>
                                                </div>
                                                <div class="col-4">
                                                    <input class="form-check-input" type="checkbox" wire:model="remarks" value="DQ" id="checkbox13" wire:click="clickBox" @if($cplCheck == true) disabled @elseif($toChecked == true) disabled @endif>
                                                    <label class="form-check-label" for="flexCheckDefault">
                                                        DQ
                                                    </label>
                                                </div>
                                            </div>
                                            @if($displayComment == true)
                                                <div class="row" id="hm3">
                                                    <div class="col-3">

                                                    </div>
                                                    <div class="col-6">
                                                        <textarea class="form-control" rows="2" wire:model="comment"  style="border: none;" placeholder="Reason:"></textarea>
                                                    </div>
                                                    <div class="col-3">

                                                    </div>
                                                </div>
                                            @endif
                                        @endif
                                    @endif
                                @endif
                                <hr>
                                <div class="row mt-2 mb-3">
                                    <div class="col-3">
                                        <input class="form-check-input" type="checkbox" wire:model="remarks" value="DNC" @if($cplCheck == true) disabled @elseif($toChecked == true) disabled @endif>
                                        <label class="form-check-label" for="flexCheckDefault">
                                            DNC
                                        </label>
                                    </div>
                                    <div class="col-3">
                                        <input class="form-check-input" type="checkbox" wire:model="remarks" value="TCPA" @if($cplCheck == true) disabled @elseif($toChecked == true) disabled @endif >
                                        <label class="form-check-label" for="flexCheckDefault">
                                            TCPA
                                        </label>
                                    </div>
                                    <div class="col-5">
                                        <input class="form-check-input" type="checkbox" wire:model="remarks" value="ThatsThem Issue - Not found"  @if($cplCheck == true) disabled @elseif($toChecked == true) disabled @endif >
                                        <label class="form-check-label" for="flexCheckDefault">
                                            ThatsThem Issue - Not found
                                        </label>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-3">
                                        <input class="form-check-input" type="checkbox" wire:model="remarks" value="Litigator"  @if($cplCheck == true) disabled @elseif($toChecked == true) disabled @endif>
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Litigator
                                        </label>
                                    </div>
                                    <div class="col-3">
                                        <input class="form-check-input" type="checkbox" wire:model="remarks" value="Already Rep"  @if($cplCheck == true) disabled @elseif($toChecked == true) disabled @endif >
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Already Rep
                                        </label>
                                    </div>
                                    <div class="col-4">
                                        <input class="form-check-input" type="checkbox" wire:model="remarks" value="Felony" @if($cplCheck == true) disabled @elseif($toChecked == true) disabled @endif >
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Felony
                                        </label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-3">
                                        <input class="form-check-input" type="checkbox" wire:model="remarks" value="Blackllist"  @if($cplCheck == true) disabled @elseif($toChecked == true) disabled @endif>
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Blackllist
                                        </label>
                                    </div>
                                    <div class="col-3">
                                        <input class="form-check-input" type="checkbox" wire:model="remarks" value="Plaintiff"  @if($cplCheck == true) disabled @elseif($toChecked == true) disabled @endif>
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Plaintiff
                                        </label>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" wire:model="checkboxTO"  wire:click="clickTO" value="TO" @if($cplCheck == true) disabled @endif @if($mll == 2) disabled @endif>
                                            <label class="form-check-label" for="flexCheckChecked">
                                                Turnover
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" wire:model="checkboxTO" wire:click="clickTO" value="Invalid TO" @if($cplCheck == true) disabled @endif @if($mll == 1) disabled @endif>
                                            <label class="form-check-label" for="flexCheckChecked">
                                                Invalid TO
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-end">
                                    <div class="col-6">
                                        @if($toChecked == true)
                                            <textarea class="form-control" rows="2" id="reason" wire:model="turnover"  style="border: none;" placeholder="Reason:"></textarea>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex mt-3">
                            <button type="submit" class="btn btn-warning mt-4" style="width: 30%; margin-left: 35%; margin-right: 10%;">Submit</button>
                            <button type="button" class="btn btn-primary mt-4" style="width: 15%;" wire:click="clear">Clear</button>
                        </div>
                    </form>
                    <button id="btn123" data-bs-toggle="modal" data-bs-target="#loading" style="display: none"></button>
                </div>
    @script
    <script>
        $wire.on('subSubmitted', () => {
            $('#btn123').click();
        });
    </script>
    @endscript
</div>

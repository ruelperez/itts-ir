<div wire:ignore.self class="modal fade" id="viewDetail" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" >
            <div class="modal-header">
                <h5 class="modal-title">{{ucfirst($claimant)}} ({{$phoneNumber}})</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" id="formClose" aria-label="Close"></button>
            </div>
            <div wire:loading>
                Saving post...
            </div>
            <div class="ms-3 mt-3"  wire:loading.remove>
                @if($caseType == "obo")
                    <div>
                        <p>Claimant: <b>{{ucfirst($claimant)}}</b></p>
                    </div>
                    <div>
                        <p>Injured Party: <b>{{ucfirst($injuredParty)}}</b></p>
                    </div>
                @else
                    <div>
                        <p>Claimant: <b>{{ucfirst($claimant)}}</b></p>
                    </div>
                @endif
                <div>
                    <p>Phone Number: <b>{{$phoneNumber}}</b></p>
                </div>
                <div>
                    <p>Alt. Phone Number: <b>{{$altPhoneNumber}}</b></p>
                </div>
                <div>
                    <p>DOB: <b>{{$dob}}</b></p>
                </div>
                <div>
                    <p>Email: <b>{{$email}}</b></p>
                </div>
                <div>
                    <p>Address: <b>{{$address}}</b></p>
                </div>
                <div>
                    <p>SSN: <b>{{$ssn}}</b></p>
                </div>
            </div>
        </div>
    </div>
</div>

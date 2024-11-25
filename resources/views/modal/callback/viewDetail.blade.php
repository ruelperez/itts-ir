<div wire:ignore.self class="modal fade" id="viewDetail" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content pb-3" >
            <div class="modal-header">
                <h5 class="modal-title">{{ucfirst($claimant)}} ({{$phoneNumber}})</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" id="formClose" aria-label="Close" wire:click="closeBtn"></button>
            </div>
            <div class="text-center">
                <div class="spinner-border mt-3" role="status" wire:loading>
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
            <div class="ms-3 mt-3 me-3"  wire:loading.remove>
                <div>
                    <p>Date: <b>{{$date}}</b></p>
                </div>
                <div>
                    <p>Campaign: <b>{{ucfirst($campaign)}}</b></p>
                </div>
                <div>
                    <p>Claimant: <b>{{ucfirst($claimant)}}</b></p>
                </div>
                <div>
                    <p>Injured Party: <b>{{ucfirst($injuredParty)}}</b></p>
                </div>
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
                <hr style="border: solid black 2px">
                <div>
                    <p>Agent: <b>{{ucfirst($agent)}}</b></p>
                </div>
                <div>
                    <p>Reason: <b>{{$reason}}</b></p>
                </div>
                <div>
                    <p>Time left: <b>{{$timeRemaining}}</b></p>
                </div>
                <div>
                    <p>Time left: <b>{{$is_expired ? 'Yes' : 'No'}}</b></p>
                </div>
            </div>
        </div>
    </div>
</div>

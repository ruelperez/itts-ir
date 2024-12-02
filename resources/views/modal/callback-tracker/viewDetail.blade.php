<div wire:ignore.self class="modal fade" id="viewDetailModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content pb-3" >
            <div class="modal-header">
                <h5 class="modal-title">{{ucfirst($claimant)}} ({{$phoneNumber}})</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" id="formClose" aria-label="Close" wire:click="closeBtn"></button>
            </div>
            <div class="ms-3 mt-3 me-3">
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
                    @if($viewAnswered)
                        <!-- Display concatenated answers -->
                        <div class="mt-3">
                            <!-- Directly output the content with raw HTML rendering -->
                            <p>{!! $viewAnswered !!}</p>
                        </div>
                    @else
                        No qualifying questionnaire, features implement (Nov 28, 2024)
                    @endif
                </div>
                <hr style="border: solid black 2px">
                <div>
                    <p>Agent: <b>{{ucfirst($agent)}}</b></p>
                </div>
                <div>
                    <p>Callback reason: <b>{{$reason}}</b></p>
                </div>
{{--                <div>--}}
{{--                    <p>DQ Reason: <b>{{ !empty($viewDqReason) ? $viewDqReason : 'None' }}</b></p>--}}
{{--                </div>--}}
                <div>
                    <p>Time left: <b>{{$timeRemaining}} hrs.</b></p>
                </div>
                <div>
                    <p>Is expired: <b>{{$is_expired ? 'Yes' : 'No'}}</b></p>
                </div>
            </div>
        </div>
    </div>
</div>

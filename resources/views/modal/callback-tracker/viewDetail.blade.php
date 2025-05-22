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
                    <p>Guest 1: <b>{{ucfirst($guest1)}}</b></p>
                </div>
                <div>
                    <p>Guest 2: <b>{{ucfirst($guest2)}}</b></p>
                </div>
                <div>
                    <p>Age 1: <b>{{ucfirst($age1)}}</b></p>
                </div>
                <div>
                    <p>Age 2: <b>{{ucfirst($age2)}}</b></p>
                </div>
                <div>
                    <p>Phone Number: <b>{{$phoneNumber}}</b></p>
                </div>
                <div>
                    <p>Alt. Phone Number: <b>{{$altPhoneNumber}}</b></p>
                </div>
                <div>
                    <p>Email: <b>{{$email}}</b></p>
                </div>
                <div>
                    <p>State: <b>{{$state}}</b></p>
                </div>
                <div>
                    <p>Relationship: <b>{{$relationship}}</b></p>
                </div>
                <hr style="border: solid black 2px">
                <div>
                    <p>Gift: <b>{{$gift}}</b></p>
                </div>
                <div>
                    <p>Day: <b>{{$day}}</b></p>
                </div>
                <div>
                    <p>Time: <b>{{$time}}</b></p>
                </div>
                <div>
                    <p>Credit Card Provider: <b>{{$creditCard}}</b></p>
                </div>
                <hr style="border: solid black 2px">
                <div>
                    <p>Have a combined $50K annual income?: <b>{{$is_50k}}</b></p>
                </div>
                <div>
                    <p>First time to attend a travel webinar?: <b>{{$is_firsTime}}</b></p>
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

<div wire:ignore.self class="modal fade" id="viewDetail">
    <div class="modal-dialog">
        <div class="modal-content pb-3" >
            <div class="modal-header">
                <h5 class="modal-title">{{ucfirst($claimant)}} ({{$phoneNumber}})</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" id="formClose" aria-label="Close"></button>
            </div>
            <div class="text-center">
                <div class="spinner-border mt-3" role="status" wire:loading>
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
            <div class="ms-3 mt-3 me-3"  wire:loading.remove>
                <div>
                    <ul class="list-group">
                        @foreach($leadLogsData as $logsData)
                            <li class="list-group-item p-1">
                                <div class="row">
                                    <div class="mt-1 col-sm-3 text-start">
                                        <p class="mb-1">{{$logsData->date}}</p>
                                    </div>
                                    <div class="mt-1 col-sm-5">
                                        <p class="mb-1">{{$logsData->action}}</p>
                                    </div>
                                    <div class="mt-1 fw-light col-sm-4 text-md-end">
                                        <p class="mb-1">{{$logsData->user_name}}</p>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <hr style="border: solid black 2px">
                <div>
                    <p>Campaign : <b>{{ucfirst($campaign)}}</b></p>
                </div>
                <div>
                    <p>Client : <b>{{ucfirst($client)}}</b></p>
                </div>
                <hr style="border: solid black 2px">
                <div>
                    <p>Source : <b>{{ucfirst($source)}}</b></p>
                </div>
                @if($leadOwnership == "1st Touch")
                    <div>
                        <p>Agent (1st Touch) : <b>{{ucfirst($agent)}}</b></p>
                    </div>
                    <div>
                        <p>Agent (2nd Touch) : -------</p>
                    </div>
                @elseif($leadOwnership == "2nd Touch")
                    <div>
                        <p>Agent (1st Touch) : <b>{{ucfirst($agent2)}}</b></p>
                    </div>
                    <div>
                        <p>Agent (2nd Touch) : <b>{{ucfirst($agent)}}</b></p>
                    </div>
                @else
                    <div>
                        <p>Agent : <b>{{ucfirst($agent)}}</b></p>
                    </div>
                @endif
                <div>
                    <p>Coach : <b>{{ucfirst($coach)}}</b></p>
                </div>
                <div>
                    <p>Verifier : <b>{{ucfirst($verifier)}}</b></p>
                </div>
                <hr style="border: solid black 2px">
                <div>
                    <p>Guest 1 : <b>{{$guest1}}</b></p>
                </div>
                <div>
                    <p>Guest 2 : <b>{{$guest2}}</b></p>
                </div>
                <div>
                    <p>Phone Number : <b>{{$phoneNumber}}</b></p>
                </div>
                <div>
                    <p>Alt. Phone Number : <b>{{$altPhoneNumber}}</b></p>
                </div>
                <div>
                    <p>Email : <b>{{$email}}</b></p>
                </div>
            </div>
        </div>
    </div>
</div>

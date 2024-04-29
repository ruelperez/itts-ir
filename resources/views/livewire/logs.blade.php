<div>
    @include('modal.click-settings')
    @include('modal.news-update.show-photo')
    <div style="display: flex; width: 100%; margin-top: 135px;">
        <div style="width: 81%; margin-left: 19%;">
            <div class="container">
                <div>
                    <h5 style="margin-left: 2%; margin-top: 3%;">Activity Logs</h5>
                </div>
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" wire:model.live="search" style="width: 30%; margin-left: 10%; margin-bottom: 1%; margin-top: 2%;">
                <div style="width: 80%; margin-left: 10%;">
                    <ul class="list-group">
                        @foreach($logsData as $data)
                            <li class="list-group-item" style="padding: 2%;">
                                <div style="display: flex;">
                                    <div class="profile-picture-logs">
                                        <img src="{{asset('storage/'.$data->photo)}}" alt="Profile Picture">
                                    </div>
                                    <div style="display: flex">
                                        <div>
                                            <b>{{ucwords($data->fullname)}}</b>
                                        </div>
                                        <div>
                                            <p style="margin-left: 20px">{{ucfirst($data->action)}}, post id number <b>{{$data->note_id}}</b></p>
                                        </div>
                                    </div>
                                    <div style="margin-left: auto">
                                        <p class="fw-light">{{$data->updated_at->format('M-d-Y, H:i A')}}</p>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div style="width: 19%; background-color: #0077b6; position: fixed;top: 125px; left: 0; z-index: 1000;">
            @include('components.layouts.profile')
            @include('components.layouts.navigation')
        </div>
    </div>
    @include('partial.header')
</div>

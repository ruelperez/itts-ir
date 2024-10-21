<div>
    @include('modal.click-settings')
    @include('modal.news-update.show-photo')
    <div>
        <h6>DTR RECORD</h6>
    </div>
    <div class="row mt-4">
        <div class="col-md-6 col-xl-4">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search Name" wire:model.live="search" style="width: 100%;">
        </div>
        <div class="mt-2 mt-md-0 col-md-3 col-xl-2">
            <button class="btn btn-info" style="width: 100%" onclick="location.href = '/dtr/all-record/daily-shift';">Daily Shift</button>
        </div>
        <div class="mt-2 mt-md-0 col-md-3 col-xl-2">
            <button class="btn btn-warning" style="width: 100%" onclick="location.href = '/dtr/all-record/current-shift';">Current Shift</button>
        </div>
    </div>

    <div class="mt-3">
        <ul class="list-group">
            @foreach($dtrData as $data)
                <li class="list-group-item" style="padding: 2%; cursor: pointer" wire:click="clickName({{$data->id}})">
                    <div style="display: flex;">
                        <div class="profile-picture-logs">
                            <img src="{{asset('photos/photos/'.$data->photo)}}" alt="Profile Picture">
                        </div>
                        <div style="display: flex">
                            <div>
                                <b>{{$data->fullname}}</b>
                            </div>
                        </div>
                    </div>

                </li>
                {{$data->user_id}}
            @endforeach
        </ul>
    </div>
</div>

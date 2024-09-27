<div>
    @include('modal.click-settings')
    @include('modal.news-update.show-photo')
    <div>
        <h6>DTR RECORD</h6>
    </div>
    <div class="row">
        <div class="mt-2">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search Name" wire:model.live="search" style="width: 100%;">
        </div>
        <div class="mt-2">
            <button class="btn btn-info" style="width: 100%" onclick="location.href = '/itts/12/per-shift';">Daily Shift</button>
        </div>
        <div class="mt-2">
            <button class="btn btn-warning" style="width: 100%" onclick="location.href = '/itts/current-shift';">Current Shift</button>
        </div>
    </div>

    <div class="mt-3">
        <ul class="list-group">
            @foreach($dtrData as $data)
                <li class="list-group-item" style="padding: 2%; cursor: pointer" wire:click="clickName({{$data->user_id}})">
                    <div style="display: flex;">
                        <div class="profile-picture-logs">
                            <img src="{{asset('photos/photos/'.$data->photo)}}" alt="Profile Picture">
                        </div>
                        <div style="display: flex">
                            <div>
                                <b>{{ucwords($data->fullname)}}</b>
                            </div>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</div>

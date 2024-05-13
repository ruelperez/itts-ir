<div>
    @include('modal.click-settings')
    @include('modal.news-update.show-photo')
    <div style="display: flex; width: 100%; margin-top: 135px;">
        <div style="width: 81%; margin-left: 19%;">
            <div class="container">
                <div>
                    <h5 style="margin-left: 2%; margin-top: 3%;">DTR Record</h5>
                </div>
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search Name" wire:model.live="search" style="width: 30%; margin-left: 10%; margin-bottom: 1%; margin-top: 2%;">
                <div style="width: 80%; margin-left: 10%;">
                    <ul class="list-group">
                        @foreach($dtrData as $data)
                            <li class="list-group-item" style="padding: 2%; cursor: pointer" wire:click="clickName({{$data->user_id}})">
                                <div style="display: flex;">
                                    <div class="profile-picture-logs">
                                        <img src="{{asset('storage/'.$data->photo)}}" alt="Profile Picture">
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
        </div>
        <div style="width: 19%; background-color: #0077b6; position: fixed;top: 125px; left: 0; z-index: 1000; height: 100%;">
            @include('components.layouts.profile')
            @include('components.layouts.navigation')
        </div>
    </div>
    @include('partial.header')
</div>

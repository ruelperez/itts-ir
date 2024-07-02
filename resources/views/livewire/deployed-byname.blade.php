<div>
    @include('components.layouts.profile')
    @include('components.layouts.navigation')
    @include('modal.click-settings')
    @include('modal.news-update.show-photo')
    <div style="display: flex; width: 100%; margin-top: 105px;">
        <div style="width: 81%; margin-left: 19%;">
            <div class="container">
                <div>
                    <h6 style="margin-left: 2%; margin-top: 3%;">DEPLOYED DEVICE</h6>
                </div>
                <div style="display: flex; width: 90%;  margin-left: 10%; margin-bottom: 1%; margin-top: 2%;">
                    <div style="width: 30%;">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search Name" wire:model.live="search" style="width: 100%;">
                    </div>
                </div>

                <div style="width: 80%; margin-left: 10%;">
                    <ul class="list-group">
                        @foreach($deviceData as $data)
                            <li class="list-group-item" style="padding: 2%; cursor: pointer" wire:click="clickName({{$data->user_id}})">
                                <div style="display: flex;">
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
    </div>
    @include('partial.header')
</div>

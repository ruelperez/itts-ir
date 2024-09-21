<div>
    @include('components.layouts.profile')
    @include('components.layouts.navigation')
    @include('modal.click-settings')
    @include('modal.news-update.show-photo')
    @include('modal.deployed-item-record.has-active')
    <div style="display: flex; width: 100%; margin-top: 105px;">
        <div style="width: 81%; margin-left: 19%;">
            <div class="container">
                <div style="display: flex;">
                    <i style="margin-left: 2%; margin-top: 3%; cursor: pointer" class="fa-solid fa-backward" onclick="location.href = '/itts/20/deployed-item';" title="back"></i>
                    <h6 style="margin-left: 2%; margin-top: 3%;">DEPLOYED DEVICE</h6>
                    <div style="display: flex; font-size: 14px;" class="mt-4 align-items-center ms-5 w-75">
                        <div style="margin-top: 20px;">
                            <i class="fa-solid fa-circle" style="color: green"></i> Active
                        </div>
                        <div class="ms-5" style="margin-top: 20px;">
                            <i class="fa-solid fa-circle" style="color: red"></i> Returned
                        </div>
                        <div class="ms-5" style="margin-top: 20px;">
                            <i class="fa-solid fa-circle" style="color: blue"></i> Declined
                        </div>
                        <select class="form-select ms-5" aria-label="Default select example" wire:model.live="status" style="margin-top: 10px; width: 13%;">
                            <option value="all">All</option>
                            <option value="active">Active</option>
                            <option value="returned">Returned</option>
                            <option value="declined">Declined</option>
                        </select>
                        <div class="ms-5" style="cursor: pointer; margin-top: 20px;" wire:click="clickClearance({{$deviceUserID}})">
                            <i class="fa-solid fa-download" style="color: #0c63e4; font-size: 20px;"></i> Clearance
                        </div>
                    </div>
                </div>
                <hr>
                <div class="ms-5" style="display: flex">
                    <div>
                        <b>{{$deviceUserFullname}}</b>
                    </div>
                </div>
                <div style="font-size: 14px; margin-top: 15px; width: 92%; margin-left: 4%; box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.5);"  class="px-5 py-3">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col">Device</th>
                            <th scope="col">Brand name</th>
                            <th scope="col">Serial</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($deviceData as $data)
                            <tr>
                                <td>
                                    @if($data->status != "for approval"  and $data->status != "return approval") {{ucfirst($data->name)}}  @else <b>{{ucfirst($data->name)}}</b> @endif
                                </td>
                                <td>
                                    @if($data->status != "for approval" and $data->status != "return approval") {{ucfirst($data->brand_name)}}  @else <b>{{ucfirst($data->brand_name)}}</b> @endif
                                </td>
                                <td>
                                    @if($data->status != "for approval" and $data->status != "return approval") {{ucfirst($data->serial)}}  @else <b>{{ucfirst($data->serial)}}</b> @endif
                                </td>
                                <td>
                                    @if($data->status != "for approval" and $data->status != "return approval") {{ucfirst($data->quantity)}}  @else <b>{{ucfirst($data->quantity)}}</b> @endif
                                </td>
                                <td>
                                    @if($data->status == "deployed") <i class="fa-solid fa-circle" style="color: green"></i> @elseif($data->status == "declined") <i class="fa-solid fa-circle" style="color: blue"></i> @elseif($data->status == "returned") <i class="fa-solid fa-circle" style="color: red"></i> @else <b>{{ucfirst($data->status)}}</b> @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <button id="btn2" data-bs-toggle="modal" data-bs-target="#hasAct" style="display: none"></button>
    </div>
    @script
    <script>
        $wire.on('hasActive', () => {
            $('#btn2').click();
        });
    </script>
    @endscript
</div>

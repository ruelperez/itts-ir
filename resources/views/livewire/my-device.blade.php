<div>
    @include('components.layouts.profile')
    @include('components.layouts.navigation')
    @include('modal.click-settings')
    @include('modal.news-update.show-photo')
    @include('modal.my_device.add')
    @include('modal.my_device.cancel')
    @include('modal.my_device.return')
    <div style="display: flex; width: 100%; margin-top: 105px;">
        <div style="width: 81%; margin-left: 19%;">
            <div class="container">
                <div style="display: flex;">
                    <h6 style="margin-left: 2%; margin-top: 3%;">MY DEVICE</h6>
                    <div style="margin-left: 3%; margin-top: 2.5%; width: 25%;">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" wire:model.live="mydeviceSearch">
                    </div>
                    <div style="margin-left: 3%; margin-top: 3%">
                        <i class="fa-solid fa-circle-plus" style="font-size: 30px;cursor: pointer" data-bs-toggle="modal" data-bs-target="#add"></i>
                    </div>
                    <div style="display: flex; font-size: 14px; width: 50%;" class="mt-4 align-items-center ms-5">
                        <div style="margin-top: 20px;">
                            <i class="fa-solid fa-circle" style="color: green"></i> Active
                        </div>
                        <div class="ms-5" style="margin-top: 20px;">
                            <i class="fa-solid fa-circle" style="color: red"></i> Returned
                        </div>
                        <div class="ms-5" style="margin-top: 20px;">
                            <i class="fa-solid fa-circle" style="color: blue"></i> Declined
                        </div>
                        <select class="form-select ms-5" aria-label="Default select example" wire:model.live="status" style="margin-top: 10px; width: 20%;">
                            <option value="all">All</option>
                            <option value="active">Active</option>
                            <option value="returned">Returned</option>
                            <option value="declined">Declined</option>
                        </select>
                    </div>
                </div>
                <hr>
                <div style="font-size: 14px; margin-top: 30px; width: 92%; margin-left: 4%; box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.5);"  class="px-5 py-3">
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
                            <tr @if($data->status != "for approval" and $data->status != "return approval") style=" filter: contrast(75%); cursor: pointer" @else data-bs-toggle="modal" data-bs-target="#cancel" wire:click="cancelApproval({{$data->id}})" style=" cursor: pointer;" @endif @if($data->status == "deployed") data-bs-toggle="modal" data-bs-target="#return" wire:click="return({{$data->id}})" @endif>
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
    </div>
</div>

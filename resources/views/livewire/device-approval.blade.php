<div>
    @include('components.layouts.profile')
    @include('components.layouts.navigation')
    @include('modal.click-settings')
    @include('modal.news-update.show-photo')
    @include('modal.my_device.add')
    @include('modal.device-approval.approval')
    <div style="display: flex; width: 100%; margin-top: 105px;">
        <div style="width: 81%; margin-left: 19%;">
            <div class="container">
                <div style="display: flex">
                    <h6 style="margin-left: 2%; margin-top: 3%;">DEVICE APPROVAL</h6>
                    <div style="margin-left: 3%; margin-top: 2.5%; width: 25%;">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" wire:model.live="searchApproval">
                    </div>
                </div>
                <hr>
                <div style="font-size: 14px; margin-top: 30px; width: 92%; margin-left: 4%; box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.5);"  class="px-4 py-3">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Employee name</th>
                                <th scope="col">Device</th>
                                <th scope="col">Brand name</th>
                                <th scope="col">Serial</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($deviceData as $data)
                            <tr onmouseover="hoverStaff({{$data->id}})" onmouseout="hoverOutStaff({{$data->id}})" @if($data->status != "pending deployment" and $data->status != "pending return") style=" filter: contrast(75%);" @else style=" cursor: pointer;" data-bs-toggle="modal" data-bs-target="#clickRow" wire:click="clickData({{$data->id}})" @endif>
                                <td>
                                    @if($data->status != "pending deployment" and $data->status != "pending return") {{ucfirst($data->fullname)}}  @else <b>{{ucfirst($data->fullname)}}</b> @endif
                                </td>
                                <td>
                                    @if($data->status != "pending deployment" and $data->status != "pending return") {{ucfirst($data->name)}}  @else <b>{{ucfirst($data->name)}}</b> @endif
                                </td>
                                <td>
                                    @if($data->status != "pending deployment" and $data->status != "pending return") {{ucfirst($data->brand_name)}}  @else <b>{{ucfirst($data->brand_name)}}</b> @endif
                                </td>
                                <td>
                                    @if($data->status != "pending deployment" and $data->status != "pending return") {{ucfirst($data->serial)}}  @else <b>{{ucfirst($data->serial)}}</b> @endif
                                </td>
                                <td>
                                    @if($data->status != "pending deployment" and $data->status != "pending return") {{ucfirst($data->quantity)}}  @else <b>{{ucfirst($data->quantity)}}</b> @endif
                                </td>
                                <td>
                                    @if($data->status != "pending deployment" and $data->status != "pending return") {{ucfirst($data->status)}}  @else <b>{{ucfirst($data->status)}}</b> @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('partial.header')
</div>

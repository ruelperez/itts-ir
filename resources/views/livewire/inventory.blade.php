<div>
    @include('components.layouts.profile')
    @include('components.layouts.navigation')
    @include('modal.click-settings')
    @include('modal.news-update.show-photo')
    @include('modal.inventory.add')
    <div style="display: flex; width: 100%; margin-top: 105px;">
        <div style="width: 81%; margin-left: 19%;">
            <div class="container">
                <div style="display: flex;">
                    <h6 style="margin-left: 2%; margin-top: 3%;">INVENTORY</h6>
                    <div style="margin-left: 3%; margin-top: 2.5%; width: 20%;">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" wire:model="inven">
                    </div>
                    <div style="margin-left: 3%; margin-top: 3%">
                        <i class="fa-solid fa-circle-plus" style="font-size: 25px;cursor: pointer" data-bs-toggle="modal" data-bs-target="#add"></i>
                    </div>
                    <div style="display: flex; font-size: 14px;" class="mt-4 align-items-center ms-5">
                        <div style="margin-top: 20px;">
                            <i class="fa-solid fa-circle" style="color: green"></i> Deployed
                        </div>
                        <div class="ms-4" style="margin-top: 20px;">
                            <i class="fa-solid fa-circle" style="color: blue"></i> Stocked
                        </div>
                        <div class="ms-4" style="margin-top: 20px;">
                            <i class="fa-solid fa-circle" style="color: red"></i> Disposed
                        </div>
                        <div class="ms-4" style="margin-top: 20px;">
                            <i class="fa-solid fa-circle" style="color: yellow "></i> Pending
                        </div>
                    </div>
                    <div class="mt-4 ms-5" onclick="location.href = '/itts/19/device-approval';">
                        <button class="btn btn-primary">Device approval</button>
                    </div>
                    <div class="mt-4 align-items-center ms-auto me-5">
                        @if(count($checkBox) == 1)
                            <i class="fa-solid fa-eye text-primary" style="cursor: pointer; margin-top: 20px;"></i>
                            <i class="fa-solid fa-pen-to-square ms-3" style="cursor: pointer"></i>
                            <i class="fa-solid fa-trash ms-3 text-danger" style="cursor: pointer"></i>
                        @elseif(count($checkBox) > 1)
                            <i class="fa-solid fa-trash ms-3 text-danger" style="cursor: pointer; margin-top: 20px;"></i>
                        @endif
                    </div>
                </div>
              <HR>
                <div style="font-size: 14px; margin-top: 30px;"  class="px-5">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col">Device</th>
                            <th scope="col">Brand name</th>
                            <th scope="col">Serial</th>
                            <th scope="col">Quantity</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($InvData as $data)
                            <tr onmouseover="hoverStaff({{$data->id}})" onmouseout="hoverOutStaff({{$data->id}})">
                                <td>
                                    {{ucfirst($data->name)}}
                                </td>
                                <td>
                                    {{ucfirst($data->brand_name)}}
                                </td>
                                <td>
                                    {{$data->serial}}
                                </td>
                                <td>
                                    {{$data->quantity}}
                                </td>
                                <td>
                                    @if($data->status == "deployed") <i class="fa-solid fa-circle" style="color: green"></i> @elseif($data->status == "stocked") <i class="fa-solid fa-circle" style="color: blue"></i> @elseif($data->status == "pending") <i class="fa-solid fa-circle" style="color: yellow"></i>@else <i class="fa-solid fa-circle" style="color: red"></i> @endif
                                </td>
                                <td>
                                    <input class="form-check-input" type="checkbox" wire:model.live="checkBox" value="{{$data->id}}" style="font-size: 18px; cursor: pointer">
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

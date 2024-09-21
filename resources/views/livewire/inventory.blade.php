<div>
    @include('components.layouts.profile')
    @include('components.layouts.navigation')
    @include('modal.click-settings')
    @include('modal.news-update.show-photo')
    @include('modal.inventory.add')
    @include('modal.inventory.edit')
    <div style="display: flex; width: 100%; margin-top: 105px;">
        <div style="width: 81%; margin-left: 19%;">
            <div class="container">
                <div style="position: fixed;top: 15%; left: 19%; width: 81%; background-color: #41464b; color: white; padding-bottom: 20px;">
                    <div style="display: flex; width: 100%;">
                        <div class="dropdown">
                            <i class="btn btn-secondary dropdown-toggle ps-2 py-0 ms-2 mt-4" data-bs-toggle="dropdown"  style="color: white; font-size: 23px; cursor: pointer; "> </i>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li onclick="location.href = '/itts/19/device-approval';" style="cursor: pointer"><a class="dropdown-item" ><i class="fa-solid fa-thumbs-up me-2" ></i>Device approval</a></li>
                                <li onclick="location.href = '/itts/20/deployed-item';" style="cursor: pointer"><a class="dropdown-item" ><i class="fa-solid fa-person-walking-luggage me-2"></i>Deployed device</a></li>
                            </ul>
                        </div>
                        <h6 style="margin-left: 1%; margin-top: 3%;">INVENTORY</h6>
                        <div style="margin-left: 3%; margin-top: 2.5%; width: 20%;">
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" wire:model.live="search">
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
                        <div class="mt-4 align-items-center ms-5">
                            @if(count($checkBox) == 1)
                                <i class="fa-solid fa-circle-minus" style="cursor: pointer; margin-top: 20px; font-size: 17px;" title="Dispose" wire:click="dispose" wire:confirm="Are you sure you want to dispose this device?"></i>
                                <i class="fa-solid fa-pen-to-square ms-3" style="cursor: pointer" title="Edit" wire:click="edit" data-bs-toggle="modal" data-bs-target="#edit"></i>
                                <i class="fa-solid fa-trash ms-3 text-danger" style="cursor: pointer" title="Delete" wire:click="delete" wire:confirm="Are you sure you want to delete?"></i>
                            @elseif(count($checkBox) > 1)
                                <i class="fa-solid fa-circle-minus" style="cursor: pointer; margin-top: 20px; font-size: 17px;" title="Dispose" wire:click="dispose" wire:confirm="Are you sure you want to dispose this device?"></i>
                                <i class="fa-solid fa-trash ms-3 text-danger" style="cursor: pointer; margin-top: 20px;" title="Delete" wire:click="delete" wire:confirm="Are you sure you want to delete?"></i>
                            @endif
                        </div>
                    </div>
                </div>

                <div style="font-size: 14px; margin-top: 9%; width: 92%; margin-left: 4%; box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.5); "  class="px-4 py-3" >
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col" style="width: 18%;">Device</th>
                            <th scope="col" style="width: 18%;">Brand name</th>
                            <th scope="col" style="width: 18%;">Serial</th>
                            <th scope="col" style="width: 18%;">Quantity</th>
                            <th scope="col" style="width: 18%;">Name</th>
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
                                    {{$data->deployed_name}}
                                </td>
                                <td>
                                    @if($data->status == "deployed") <i class="fa-solid fa-circle" style="color: green"></i> @elseif($data->status == "stocked") <i class="fa-solid fa-circle" style="color: blue"></i> @elseif($data->status == "for approval" or $data->status == "return approval")<i class="fa-solid fa-circle" style="color: yellow"></i>@else <i class="fa-solid fa-circle" style="color: red"></i> @endif
                                </td>
                                <td>
                                    @if($data->status == "stocked")
                                        <input class="form-check-input" type="checkbox" wire:model.live="checkBox" value="{{$data->id}}" style="font-size: 18px; cursor: pointer">
                                    @endif
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

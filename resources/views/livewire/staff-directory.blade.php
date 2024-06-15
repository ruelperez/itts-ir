<div>
    @include('components.layouts.profile')
    @include('components.layouts.navigation')
    @include('partial.header')
    @include('modal.click-settings')
    @include('modal.news-update.show-photo')

    <div style="display: flex; width: 100%; margin-top: 105px;">
        <div style="width: 81%; margin-left: 19%;">
            <div>
                <div class=" position-fixed d-flex align-items-center px-2 py-4" style="top: 15%; width: 81%; background-color: #41464b; color: white;">
                    <div class="w-50 ps-3">
                        <h6>STAFF DIRECTORY</h6>
                    </div>
                    <div class="w-25 me-">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" wire:model.live="search">
                    </div>
                    <div class="w-25 ps-5">
                        @if(count($checkBox) == 1)
                            <i class="fa-solid fa-eye text-primary" style="cursor: pointer"></i>
                            <i class="fa-solid fa-pen-to-square ms-3" style="cursor: pointer"></i>
                            <i class="fa-solid fa-trash ms-3 text-danger" style="cursor: pointer"></i>
                        @elseif(count($checkBox) > 1)
                            <i class="fa-solid fa-trash ms-3 text-danger" style="cursor: pointer"></i>
                        @endif
                    </div>
                </div>
                <div style="font-size: 14px; margin-top: 120px;"  class="px-5">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col">Fullname</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone number</th>
                            <th scope="col">ID</th>
                            <th scope="col">Date of birth</th>
                            <th scope="col">Position</th>
                            <th scope="col">Department</th>
                            <th scope="col">Branch</th>
                            <th scope="col">Act/Inact</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $i=0; @endphp
                        @foreach($staffData as $data)
                            <tr onmouseover="hoverStaff({{$data->id}})" onmouseout="hoverOutStaff({{$data->id}})">
                                <td>
                                    {{ucwords($data->fname.' '.$data->mi.' '.$data->lname)}}
                                </td>
                                <td>
                                    {{$data->personal_email}}
                                </td>
                                <td>
                                    {{$data->phone_number}}
                                </td>
                                <td>
                                    {{$data->id_user}}
                                </td>
                                <td>
                                    {{$data->dob}}
                                </td>
                                <td>
                                    {{ucwords($data->designation)}}
                                </td>
                                <td>
                                    {{$data->department}}
                                </td>
                                <td>
                                    {{ucwords($data->branch)}}
                                </td>
                                <td>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" wire:model="stat.{{$i}}" value="{{$stat[$i]}}" wire:change="status({{$i}},{{$data->id}})">
                                    </div>
                                </td>
                                <td>
                                    <input class="form-check-input" type="checkbox" wire:model.live="checkBox" value="{{$data->id}}" id="flexCheckDefault{{$data->id}}" style="font-size: 18px; cursor: pointer">
                                </td>
                            </tr>
                            @php $i++; @endphp
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

</div>

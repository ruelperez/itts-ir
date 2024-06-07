<div>
    @include('modal.click-settings')
    @include('modal.news-update.show-photo')
    <div style="display: flex; width: 100%; margin-top: 135px;">
        <div style="width: 81%; margin-left: 19%;">
            <div class="container">
                <div>
                    <h6 style="margin-left: 2%; margin-top: 2%;">STAFF DIRECTORY</h6>
                </div>
                <hr>
                <div class="px-5 d-flex">
                    <div style="width: 30%;">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" wire:model.live="search">
                    </div>
                    <div style="width: 90px;" class="ms-auto me-5 mt-3">
                        @if(count($checkBox) == 1)
                            <i class="fa-solid fa-eye text-primary" style="cursor: pointer"></i>
                            <i class="fa-solid fa-pen-to-square ms-3" style="cursor: pointer"></i>
                            <i class="fa-solid fa-trash ms-3 text-danger" style="cursor: pointer"></i>
                        @elseif(count($checkBox) > 1)
                            <i class="fa-solid fa-trash ms-3 text-danger" style="cursor: pointer"></i>
                        @endif
                    </div>
                </div>
                <hr>
                <div style="font-size: 14px;"  class="px-5">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Fullname</th>
                                <th scope="col">Email</th>
                                <th scope="col">Phone number</th>
                                <th scope="col">ID number</th>
                                <th scope="col">Date of birth</th>
                                <th scope="col">Position</th>
                                <th scope="col">Department</th>
                                <th scope="col">Branch</th>
                                <th scope="col">Act/Inact</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($staffData as $data)
                                <tr onmouseover="hoverStaff({{$data->id}})" onmouseout="hoverOutStaff({{$data->id}})">
                                    <td>
                                        {{ucwords($data->fname.' '.$data->mi.'. '.$data->lname)}}
                                    </td>
                                    <td>
                                        {{$data->personal_email}}
                                    </td>
                                    <td>
                                        {{$data->phone_number}}
                                    </td>
                                    <td>
                                       ITTS-00{{$data->user_id}}
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
                                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" wire:model.live="stat" value="{{$stat}}">
                                        </div>
                                    </td>
                                    <td>
                                        <input class="form-check-input" type="checkbox" wire:model.live="checkBox" value="{{$data->id}}" id="flexCheckDefault{{$data->id}}" style="font-size: 18px; cursor: pointer">
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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

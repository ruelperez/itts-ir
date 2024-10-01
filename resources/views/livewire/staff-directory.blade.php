<div>
    @include('modal.news-update.show-photo')
    @include('modal.staff-directory.viewDetail')
    <div>
        <div class="row">
            <div class="col-lg-3 pt-lg-2">
                <h6>STAFF DIRECTORY</h6>
            </div>
            <div class="col-sm-6 col-lg-4 mt-1 mt-lg-0">
                <input class="form-control" type="search" placeholder="Search" aria-label="Search" wire:model.live="search">
            </div>
            <div class="col-sm-6 col-lg-4 mt-2">
                @if(count($checkBox) == 1)
                    <i class="fa-solid fa-eye text-primary" style="cursor: pointer" wire:click="clickView"
                       data-bs-toggle="modal" data-bs-target="#viewDetail"></i>
                    <i class="fa-solid fa-pen-to-square ms-3" style="cursor: pointer"></i>
                    <i class="fa-solid fa-trash ms-3 text-danger" style="cursor: pointer"></i>
                @elseif(count($checkBox) > 1)
                    <i class="fa-solid fa-trash ms-3 text-danger" style="cursor: pointer"></i>
                @endif
            </div>
        </div>
        <div class="table-responsive mt-lg-4">
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
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked"
                                       wire:model="stat.{{$i}}" value="{{$stat[$i]}}"
                                       wire:change="status({{$i}},{{$data->id}})">
                            </div>
                        </td>
                        <td>
                            <input class="form-check-input" type="checkbox" wire:model.live="checkBox"
                                   value="{{$data->id}}" id="flexCheckDefault{{$data->id}}"
                                   style="font-size: 18px; cursor: pointer">
                        </td>
                    </tr>
                    @php $i++; @endphp
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>

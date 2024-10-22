<div>
    @include('modal.news-update.show-photo')
    @include('modal.staff-directory.viewDetail')
    <div>
        <div class="row">
            <div class="col-lg-3 col-xl-2 pt-lg-2">
                <h6>STAFF DIRECTORY</h6>
            </div>
            <div class="col-sm-8 col-lg-6 mt-1 mt-lg-0 col-xl-5">
                <input class="form-control" type="search" placeholder="Search" aria-label="Search" wire:model.live="search">
            </div>
            <div class="col-12 col-sm-4 col-lg-3 col-xl-3 mt-2 mt-sm-1 mt-lg-0">
                <select class="form-select" aria-label="Default select example" wire:model.live="empStat" id="staffStat">
                    <option value="all">All</option>
                    <option value=1>Active</option>
                    <option value=0>Inactive</option>
                </select>
            </div>
        </div>
        <div class="mt-3 mt-sm-5 mt-md-4 mt-lg-5 text-end">
            @if(count($checkBox) == 1)
                <i class="fa-solid fa-eye text-primary" style="cursor: pointer" wire:click="clickView"
                   data-bs-toggle="modal" data-bs-target="#viewDetail"></i>
                <i class="fa-solid fa-pen-to-square ms-3" style="cursor: pointer"></i>
                <i class="fa-solid fa-trash ms-3 text-danger" style="cursor: pointer"></i>
            @elseif(count($checkBox) > 1)
                <i class="fa-solid fa-trash ms-3 text-danger" style="cursor: pointer"></i>
            @endif
        </div>
        <div class="table-responsive" style="font-size: 14px">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col">Fullname</th>
                    <th scope="col">Work email</th>
                    <th scope="col">Phone number</th>
                    <th scope="col">ID</th>
                    <th scope="col">Date of birth</th>
                    <th scope="col">Position</th>
                    <th scope="col">Department</th>
{{--                    <th scope="col">Branch</th>--}}
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
                            {{$data->current_working_email}}
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
                            {{$data->user_id}}
                        </td>
{{--                        <td>--}}
{{--                            {{ucwords($data->branch)}}--}}
{{--                        </td>--}}
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
    <div class="row">
        <div class="col-12 col-md-6 col-lg-3 col-xl-3">
            <button class="btn btn-success w-100" wire:click="previousPage">Previous</button>
        </div>
        <div class="col-12 col-md-6 col-lg-3 col-xl-3 mt-2 mt-md-0">
            <button class="btn btn-primary w-100" wire:click="nextPage">Next</button>
        </div>
    </div>

    @script
    <script>
        $wire.on('remove-loading', (event) => {
            JsLoadingOverlay.hide();
        });
    </script>
    @endscript
</div>
@push('js')
    <script>
        $(document).ready(function() {
            $('#staffStat').on('change', function() {
                JsLoadingOverlay.show({
                    overlayBackgroundColor: '#666666',
                    overlayOpacity: 0.6,
                    spinnerIcon: 'ball-pulse',  // Choose your spinner icon
                    spinnerColor: '#ffffff',
                    spinnerSize: '2x'
                });

            });
        });
    </script>

@endpush

<div>
    @include('components.layouts.profile')
    @include('components.layouts.navigation')
    @include('modal.click-settings')
    @include('modal.news-update.show-photo')
    @include('modal.dtr.current')
    <div style="display: flex; width: 100%; margin-top: 105px;">
        <div style="width: 81%; margin-left: 19%;">
            <div class="container">
                <div>
                    <h6 style="margin-left: 2%; margin-top: 3%;">DTR CURRENT SHIFT</h6>
                </div>
                <div style="display: flex; width: 92%; margin-top: 2%; margin-left: 4%;">
                    <div style="width: 10%;">
                        <b style="font-size: 17px; ">@if(isset($date)) {{Carbon\Carbon::parse($date->in)->format('m-d-Y')}}@endif </b>
                    </div>
                    <div style="margin-left: 3%; width: 25%;">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" wire:model.live="search">
                    </div>
                    <select class="form-select ms-4" aria-label="Default select example" wire:model.live="branch" style="width: 11%;">
                        <option value="all">All</option>
                        <option value="mindoro">Mindoro</option>
                        <option value="bicol">Bicol</option>
                    </select>
                </div>
                <div style="margin-left: 4%; margin-top: 1%; width: 92%;">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col">Fullname</th>
                            <th scope="col">Time in</th>
                            <th scope="col">Time out</th>
                            <th scope="col">Time in</th>
                            <th scope="col">Time out</th>
                            <th scope="col">Total hour</th>
                            <th scope="col">Site</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($dtrData as $data)
                            <tr onmouseover="hoverTimeEdit({{$data->id}})" onmouseout="hoverOutTimeEdit({{$data->id}})">
                                <td>{{ucwords($data->fullname)}}</td>
                                {{--                                    <td>{{Carbon\Carbon::parse($data->in)->format('M/d/Y')}}</td>--}}
                                {{--                                    <th scope="row">@if($data->in == null) @else {{Carbon\Carbon::parse($data->in)->format('D') }} @endif</th>--}}
                                <td>@if($data->in == null) @else {{Carbon\Carbon::parse($data->in)->format('h:i A') }} @endif</td>
                                <td>@if($data->out == null) @else {{Carbon\Carbon::parse($data->out)->format('h:i A') }} @endif</td>
                                <td>@if($data->in2 == null) @else {{Carbon\Carbon::parse($data->in2)->format('h:i A') }} @endif</td>
                                <td>@if($data->out2 == null) @else {{Carbon\Carbon::parse($data->out2)->format('h:i A') }} @endif</td>
                                <td>
                                    @php
                                        $hours = floor($data->minute / 60);
                                        $totalHours = floor($hours + $data->hour);
                                        $remainingMinutes = $data->minute % 60;
                                        $result = $totalHours . ':' . $remainingMinutes;
                                    @endphp
                                    {{$result}}
                                </td>
                                <td style="width: 15%;padding-right: 60px;" id="uiy{{$data->id}}">
                                    {{ucfirst($data->branch)}}
                                    <i class="fa-solid fa-pen-to-square" style="cursor: pointer; margin-left: 20%; display: none" wire:click="clickTimeEdit({{$data->id}})" id="timeEdit{{$data->id}}"  data-bs-toggle="modal" data-bs-target="#current"></i>
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

<div>
    @include('modal.news-update.show-photo')
    @include('modal.dtr.current')
    <div>
        <h6>DTR CURRENT SHIFT</h6>
    </div>
    <div class="row mt-4">
        <div class="col-md-3 col-lg-2">
            <b style="font-size: 15px; ">@if(isset($date)) {{Carbon\Carbon::parse($date->in)->format('m-d-Y')}}@endif</b>
        </div>
        <div class="mt-2 mt-md-0 col-md-8 col-lg-6 col-xl-5">
            <input class="form-control" type="search" placeholder="Search" aria-label="Search" wire:model.live="search">
        </div>
{{--        <div class="mt-2 mt-md-0 col-md-4 col-lg-4 col-xl-2">--}}
{{--            <select class="form-select" aria-label="Default select example" wire:model.live="branch">--}}
{{--                <option value="all">All</option>--}}
{{--                <option value="mindoro">Mindoro</option>--}}
{{--                <option value="bicol">Bicol</option>--}}
{{--            </select>--}}
{{--        </div>--}}
    </div>
    <div class="table-responsive mt-4">
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">Fullname</th>
                <th scope="col">Time in</th>
                <th scope="col">Time out</th>
                <th scope="col">Time in</th>
                <th scope="col">Time out</th>
{{--                <th scope="col">Total hour</th>--}}
{{--                <th scope="col">Site</th>--}}
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
                    <td>@if($data->out2 == 'early out') Early out  @elseif($data->out2 == null) @else {{Carbon\Carbon::parse($data->out2)->format('h:i A') }} @endif @if($data->isEarlyOut == 1)<b style="color: white; background-color: red;" class="px-2">Early out</b> @endif</td>
{{--                    <td>--}}
{{--                        @php--}}
{{--                            $hours = floor($data->minute / 60);--}}
{{--                            $totalHours = floor($hours + $data->hour);--}}
{{--                            $remainingMinutes = $data->minute % 60;--}}
{{--                            $result = $totalHours . ':' . $remainingMinutes;--}}
{{--                        @endphp--}}
{{--                        {{$result}}--}}
{{--                    </td>--}}
{{--                    <td id="uiy{{$data->id}}">--}}
{{--                        {{ucfirst($data->branch)}}--}}
{{--                    </td>--}}
                    <td>
                        <i class="fa-solid fa-pen-to-square" style="cursor: pointer; display: none" wire:click="clickTimeEdit({{$data->id}})" id="timeEdit{{$data->id}}"  data-bs-toggle="modal" data-bs-target="#current"></i>
                    </td>
                 </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

<div>
    @include('modal.click-settings')
    @include('modal.news-update.show-photo')
    @include('modal.dtr.current')
    <div style="display: flex; width: 100%; margin-top: 135px;">
        <div style="width: 81%; margin-left: 19%;">
            <div class="container">
                <div>
                    <h5 style="margin-left: 2%; margin-top: 3%;">DTR Current Shift</h5>
                </div>
                <div style="display: flex; width: 92%; margin-top: 2%; margin-left: 4%;">
                    <div style="width: 10%;">
                        <b style="font-size: 17px; ">@if(isset($date)) {{Carbon\Carbon::parse($date->in)->format('m-d-Y')}}@endif </b>
                    </div>
                </div>
                <div style="margin-left: 4%; margin-top: 1%; width: 92%;">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">Fullname</th>
                            {{--                            <th scope="col">Date</th>--}}
                            {{--                            <th scope="col">Day</th>--}}
                            <th scope="col">Time in</th>
                            <th scope="col">Time out</th>
                            <th scope="col">Time in</th>
                            <th scope="col">Time out</th>
                            <th scope="col">Total working hour</th>
                            {{--                            <th scope="col">Task</th>--}}
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
                                <td style="text-align: right;width: 15%;padding-right: 60px;" id="uiy{{$data->id}}">
                                    @php
                                        $hours = floor($data->minute / 60);
                                        $totalHours = floor($hours + $data->hour);
                                        $remainingMinutes = $data->minute % 60;
                                        $result = $totalHours . ':' . $remainingMinutes;
                                    @endphp
                                    {{$result}}
                                    <i class="fa-solid fa-pen-to-square" style="cursor: pointer; margin-left: 20%; display: none" wire:click="clickTimeEdit({{$data->id}})" id="timeEdit{{$data->id}}"  data-bs-toggle="modal" data-bs-target="#current"></i>
                                </td>
{{--                                <td style="display: none; border: solid black 1px;" id="timeEdit{{$data->id}}">--}}
{{--                                    <i class="fa-solid fa-pen-to-square" style="margin-left: 5%; cursor: pointer" wire:click="clickTimeEdit1"></i>--}}
{{--                                </td>--}}
                                    {{--                                    <td>--}}
                                    {{--                                        <i class="fa-solid fa-list-check" style="margin-right: 3%; cursor: pointer" data-bs-toggle="modal" data-bs-target="#taskRecord" wire:click="clickTask({{$data->id}})"></i>--}}
                                    {{--                                    </td>--}}
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

<div>
    @include('modal.click-settings')
    @include('modal.news-update.show-photo')
    <div style="display: flex; width: 100%; margin-top: 135px;">
        <div style="width: 81%; margin-left: 19%;">
            <div class="container">
                <div>
                    <h5 style="margin-left: 2%; margin-top: 3%;">DTR Current Shift</h5>
                </div>
                <div style="display: flex; width: 92%; margin-top: 2%; margin-left: 4%;">
                    <div style="width: 10%;">
                        <b style="font-size: 17px; ">{{Carbon\Carbon::parse($date->in)->format('m-d-Y')}}</b>
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
                            <tr>
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

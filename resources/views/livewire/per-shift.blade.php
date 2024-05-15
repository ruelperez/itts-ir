<div>
    @include('modal.click-settings')
    @include('modal.news-update.show-photo')
    @include('modal.dtr_record.dtrRecord')
    <div style="display: flex; width: 100%; margin-top: 135px;">
        <div style="width: 81%; margin-left: 19%;">
            <div class="container">
                <div>
                    <h5 style="margin-left: 2%; margin-top: 3%;">DTR Per Shift</h5>
                </div>
                <div style="margin-top: 2%; width: 80%; margin-left: 4%; display: flex">
                    <input type="text" class="form-control" placeholder="Year" wire:model.live="year" style="width: 15%;">
                    {{--                    <select class="form-select" aria-label="Default select example" wire:model.live="month" style="width: 15%;">--}}
                    {{--                        <option value="Jan">January</option>--}}
                    {{--                        <option value="Feb">February</option>--}}
                    {{--                        <option value="Mar">March</option>--}}
                    {{--                        <option value="Apr">April</option>--}}
                    {{--                        <option value="May">May</option>--}}
                    {{--                        <option value="Jun">June</option>--}}
                    {{--                        <option value="Jul">July</option>--}}
                    {{--                        <option value="Aug">August</option>--}}
                    {{--                        <option value="Sept">September</option>--}}
                    {{--                        <option value="Oct">October</option>--}}
                    {{--                        <option value="Nov">November</option>--}}
                    {{--                        <option value="Dec">December</option>--}}
                    {{--                    </select>--}}
                    <select class="form-select" aria-label="Default select example" wire:model.live="month" style="width: 15%; margin-left: 1%;">
                        <option value="01">January</option>
                        <option value="02">February</option>
                        <option value="03">March</option>
                        <option value="04">April</option>
                        <option value="05">May</option>
                        <option value="06">June</option>
                        <option value="07">July</option>
                        <option value="08">August</option>
                        <option value="09">September</option>
                        <option value="10">October</option>
                        <option value="11">November</option>
                        <option value="12">December</option>
                    </select>
                    <select class="form-select" aria-label="Default select example" wire:model.live="day" style="width: 15%; margin-left: 1%;">
                        @for($n=1; $n<=31; $n++)
                            <option value={{$n}}>{{$n}}</option>
                        @endfor

                    </select>
                    <select class="form-select" aria-label="Default select example" wire:model.live="role" style="width: 15%; margin-left: 5%;">
                        <option value="all">All</option>
                        <option value="agent">Agent</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
                <div style="display: flex; width: 92%; margin-top: 1%; margin-left: 4%;">
                    <div style="width: 10%; padding-top: 10px;">
                        <b style="font-size: 17px; ">{{$month}}-{{$day}}-{{$year}}</b>
                    </div>
                    <div style="width: 15%;margin-left: auto; cursor: pointer" onclick="location.href = '/itts/per-shift-pdf/{{$month}}/{{$day}}/{{$year}}/{{$role}}'; ">
                        <i class="fa-solid fa-file-pdf" style="color: #0c63e4; font-size: 22px;"></i> Save as OED
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
                            @if($role == "admin")
                                <th scope="col">Task</th>
                            @endif

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($dtrData as $data)
                            @if($role == "all")
                                @if(Carbon\Carbon::parse($data->in)->format('Y') == $year and Carbon\Carbon::parse($data->in)->format('m') == $month and Carbon\Carbon::parse($data->in)->format('d') == $day)
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
                                @endif
                            @elseif($role == "agent")
                                @foreach($userID as $df)
                                    @if($df->id == $data->user_id)
                                        @if(Carbon\Carbon::parse($data->in)->format('Y') == $year and Carbon\Carbon::parse($data->in)->format('m') == $month and Carbon\Carbon::parse($data->in)->format('d') == $day)
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
                                        @endif
                                    @endif
                                @endforeach
                            @else
                                @foreach($userID as $df)
                                    @if($df->id == $data->user_id)
                                        @if(Carbon\Carbon::parse($data->in)->format('Y') == $year and Carbon\Carbon::parse($data->in)->format('m') == $month and Carbon\Carbon::parse($data->in)->format('d') == $day)
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
                                                <td>
                                                    <i class="fa-solid fa-list-check" style="margin-right: 3%; cursor: pointer" data-bs-toggle="modal" data-bs-target="#taskRecord" wire:click="clickTask({{$data->id}})"></i>
                                                </td>
                                            </tr>
                                        @endif
                                    @endif
                                @endforeach
                            @endif

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

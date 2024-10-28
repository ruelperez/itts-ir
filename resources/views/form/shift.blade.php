<table style="text-align: center; width: 100%; margin-left: 5%;">
    <tr>
        <td style="text-align: right; padding-right: 10px; width: 35%;">
            <img src="{{public_path('photo/logo.jpg')}}" width="100">
        </td>
        <td style="text-align: left;">
            <b>IND. Teleoutsource Telemarketing Services.</b>
        </td>
    </tr>
</table>
<table style="text-align: center; width: 100%;">
    <tr>
        <td>
            <h4>DAILY DTR</h4>
        </td>
    </tr>
    <tr style="text-align: left">
        <td style="text-align: left">
            <h4>{{$month}}-{{$day}}-{{$year}}</h4>
        </td>
    </tr>
</table>
<table style="width: 100%; text-align: center;border: 1px solid; border-collapse: collapse;" >
    <tr style="border: 1px solid;">
        <td style="border: 1px solid; padding: 8px;">
            <b>Employee Name</b>
        </td>
        <td style="border: 1px solid; padding: 8px;">
            <b>Time In</b>
        </td>
        <td style="border: 1px solid; padding: 8px;">
            <b>Lunch Out</b>
        </td>
        <td style="border: 1px solid; padding: 8px;">
            <b>Lunch In</b>
        </td>
        <td style="border: 1px solid; padding: 8px;">
            <b>Time Out</b>
        </td>
{{--        <td style="border: 1px solid; padding: 8px;">--}}
{{--            <b>Total Hour</b>--}}
{{--        </td>--}}
{{--        <td style="border: 1px solid; padding: 8px;">--}}
{{--            <b>Site</b>--}}
{{--        </td>--}}
        @if($role == "task executor")
            <td style="border: 1px solid; padding: 8px; width: 40%;">
                <b>Task</b>
            </td>
        @endif
    </tr>
    @foreach($dtrData as $data)
        @if($role == "all")
            @if(Carbon\Carbon::parse($data->in)->format('Y') == $year and Carbon\Carbon::parse($data->in)->format('m') == $month and Carbon\Carbon::parse($data->in)->format('d') == $day)
                <tr style="border: 1px solid;">
                    <td style="border: 1px solid; text-align: left; padding: 8px;">{{ucwords($data->fullname)}}</td>
                    <td style="border: 1px solid;">@if($data->in == null) @else {{Carbon\Carbon::parse($data->in)->format('h:i A') }} @endif</td>
                    <td style="border: 1px solid;">@if($data->out == null) @else {{Carbon\Carbon::parse($data->out)->format('h:i A') }} @endif</td>
                    <td style="border: 1px solid;">@if($data->in2 == null) @else {{Carbon\Carbon::parse($data->in2)->format('h:i A') }} @endif</td>
                    <td style="border: 1px solid;">@if($data->out2 == null) @else {{Carbon\Carbon::parse($data->out2)->format('h:i A') }} @endif</td>
{{--                    <td style="border: 1px solid;">--}}
{{--                        @php--}}
{{--                            $hours = floor($data->minute / 60);--}}
{{--                            $totalHours = floor($hours + $data->hour);--}}
{{--                            $remainingMinutes = $data->minute % 60;--}}
{{--                            $result = $totalHours . ':' . $remainingMinutes;--}}
{{--                        @endphp--}}
{{--                        {{$result}}--}}
{{--                    </td>--}}
{{--                    <td style="border: 1px solid;">--}}
{{--                        {{ucfirst($data->branch)}}--}}
{{--                    </td>--}}
                </tr>
            @endif
        @elseif($role == "Agent")
            @foreach($userID as $df)
                @if($df->id == $data->user_id)
                    @if(Carbon\Carbon::parse($data->in)->format('Y') == $year and Carbon\Carbon::parse($data->in)->format('m') == $month and Carbon\Carbon::parse($data->in)->format('d') == $day)
                        <tr style="border: 1px solid;">
                            <td style="border: 1px solid; text-align: left; padding: 8px;">{{ucwords($data->fullname)}}</td>
                            <td style="border: 1px solid;">@if($data->in == null) @else {{Carbon\Carbon::parse($data->in)->format('h:i A') }} @endif</td>
                            <td style="border: 1px solid;">@if($data->out == null) @else {{Carbon\Carbon::parse($data->out)->format('h:i A') }} @endif</td>
                            <td style="border: 1px solid;">@if($data->in2 == null) @else {{Carbon\Carbon::parse($data->in2)->format('h:i A') }} @endif</td>
                            <td style="border: 1px solid;">@if($data->out2 == null) @else {{Carbon\Carbon::parse($data->out2)->format('h:i A') }} @endif</td>
{{--                            <td style="border: 1px solid;">--}}
{{--                                @php--}}
{{--                                    $hours = floor($data->minute / 60);--}}
{{--                                    $totalHours = floor($hours + $data->hour);--}}
{{--                                    $remainingMinutes = $data->minute % 60;--}}
{{--                                    $result = $totalHours . ':' . $remainingMinutes;--}}
{{--                                @endphp--}}
{{--                                {{$result}}--}}
{{--                            </td>--}}
{{--                            <td style="border: 1px solid;">--}}
{{--                               {{ucfirst($data->branch)}}--}}
{{--                            </td>--}}
                        </tr>
                    @endif
                @endif
            @endforeach
        @elseif($role == "Admin")
            @foreach($userID as $df)
                @if($df->id == $data->user_id)
                    @if(Carbon\Carbon::parse($data->in)->format('Y') == $year and Carbon\Carbon::parse($data->in)->format('m') == $month and Carbon\Carbon::parse($data->in)->format('d') == $day)
                        <tr style="border: 1px solid;">
                            <td style="border: 1px solid; text-align: left; padding: 8px;">{{ucwords($data->fullname)}}</td>
                            <td style="border: 1px solid;">@if($data->in == null) @else {{Carbon\Carbon::parse($data->in)->format('h:i A') }} @endif</td>
                            <td style="border: 1px solid;">@if($data->out == null) @else {{Carbon\Carbon::parse($data->out)->format('h:i A') }} @endif</td>
                            <td style="border: 1px solid;">@if($data->in2 == null) @else {{Carbon\Carbon::parse($data->in2)->format('h:i A') }} @endif</td>
                            <td style="border: 1px solid;">@if($data->out2 == null) @else {{Carbon\Carbon::parse($data->out2)->format('h:i A') }} @endif</td>
{{--                            <td style="border: 1px solid;">--}}
{{--                                @php--}}
{{--                                    $hours = floor($data->minute / 60);--}}
{{--                                    $totalHours = floor($hours + $data->hour);--}}
{{--                                    $remainingMinutes = $data->minute % 60;--}}
{{--                                    $result = $totalHours . ':' . $remainingMinutes;--}}
{{--                                @endphp--}}
{{--                                {{$result}}--}}
{{--                            </td>--}}
{{--                            <td style="border: 1px solid;">--}}
{{--                                {{ucfirst($data->branch)}}--}}
{{--                            </td>--}}
                        </tr>
                    @endif
                @endif
            @endforeach
        @else
            @foreach($userID as $df)
                @if($df->id == $data->user_id)
                    @if(Carbon\Carbon::parse($data->in)->format('Y') == $year and Carbon\Carbon::parse($data->in)->format('m') == $month and Carbon\Carbon::parse($data->in)->format('d') == $day)
                        <tr style="border: 1px solid;">
                            <td style="border: 1px solid; text-align: left; padding: 8px;">{{ucwords($data->fullname)}}</td>
                            <td style="border: 1px solid;">@if($data->in == null) @else {{Carbon\Carbon::parse($data->in)->format('h:i A') }} @endif</td>
                            <td style="border: 1px solid;">@if($data->out == null) @else {{Carbon\Carbon::parse($data->out)->format('h:i A') }} @endif</td>
                            <td style="border: 1px solid;">@if($data->in2 == null) @else {{Carbon\Carbon::parse($data->in2)->format('h:i A') }} @endif</td>
                            <td style="border: 1px solid;">@if($data->out2 == null) @else {{Carbon\Carbon::parse($data->out2)->format('h:i A') }} @endif</td>
{{--                            <td style="border: 1px solid;">--}}
{{--                                @php--}}
{{--                                    $hours = floor($data->minute / 60);--}}
{{--                                    $totalHours = floor($hours + $data->hour);--}}
{{--                                    $remainingMinutes = $data->minute % 60;--}}
{{--                                    $result = $totalHours . ':' . $remainingMinutes;--}}
{{--                                @endphp--}}
{{--                                {{$result}}--}}
{{--                            </td>--}}
{{--                            <td style="border: 1px solid;">--}}
{{--                                {{ucfirst($data->branch)}}--}}
{{--                            </td>--}}
                            <td style="border: 1px solid; white-space: pre-line; text-align: left; padding: 8px;">
                                {{$data->task}}
                            </td>
                        </tr>

                    @endif
                @endif
            @endforeach
        @endif

    @endforeach
</table>

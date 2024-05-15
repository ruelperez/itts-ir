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
            <h4>EOD REPORT</h4>
        </td>
    </tr>
</table>
<table style="width: 100%; text-align: center;border: 1px solid; border-collapse: collapse;" >
    <tr style="border: 1px solid; text-align: left;" >
        <td colspan="6" style="border: 1px solid; padding: 10px;">
            <b>Employee Name: </b>{{$userData->fullname}}
        </td>
        <td colspan="1" style="border: 1px solid; padding: 10px;">
            <b>Date Coverage:</b>
        </td>
    </tr>
    <tr style="border: 1px solid; text-align: left;">
        <td colspan="6" style="border: 1px solid; padding: 10px;">
            <b>Designation:</b> {{$userData->position}}
        </td>
        <td colspan="1" style="border: 1px solid; padding: 10px;">
            <b>Immediate Supervisor:</b>
        </td>
    </tr>
    <tr style="border: 1px solid; text-align: left;">
        <td colspan="6" style="border: 1px solid; padding: 10px;">
            <b>Department:</b>
        </td>
        <td colspan="1" style="border: 1px solid; padding: 10px;">

        </td>
    </tr>
    <tr style="border: 1px solid; text-align: left;">
        <td style="border: 1px solid; padding: 10px;">

        </td>
        <td colspan="5" style="border: 1px solid; padding: 10px;">
            <b>Regular Hours (i.e. 8am TO 5pm, 9am to 6pm)</b>
        </td>
        <td style="border: 1px solid;">

        </td>
    </tr>
    <tr style="border: 1px solid;">
        <td style="border: 1px solid; padding: 10px;">
            <b>Date & Day</b>
        </td>
        <td style="border: 1px solid; padding: 10px;">
            <b>Time In</b>
        </td>
        <td style="border: 1px solid; padding: 10px;">
            <b>Lunch Out</b>
        </td>
        <td style="border: 1px solid; padding: 10px;">
            <b>Lunch In</b>
        </td>
        <td style="border: 1px solid; padding: 10px;">
            <b>Time Out</b>
        </td>
        <td style="border: 1px solid; padding: 10px;">
            <b>Total Working Hour</b>
        </td>
        <td style="border: 1px solid; padding: 10px;">
            <b>EOD</b>
        </td>
    </tr>
    @foreach($dtrData as $data)
        <tr style="border: 1px solid;">
            <td style="border: 1px solid;">
                {{Carbon\Carbon::parse($data->in)->format('M-d-Y (D)')}}
            </td>
            <td style="border: 1px solid;">
                {{Carbon\Carbon::parse($data->in)->format('h:i a')}}
            </td>
            <td style="border: 1px solid;">
                {{$data->out}}
            </td>
            <td style="border: 1px solid;">
                {{Carbon\Carbon::parse($data->in2)->format('h:i a')}}
            </td>
            <td style="border: 1px solid;">
                {{$data->out2}}
            </td>
            <td style="border: 1px solid;">
                @php
                    $hours = floor($data->minute / 60);
                    $totalHours = floor($hours + $data->hour);
                    $remainingMinutes = $data->minute % 60;
                    $result = $totalHours . ':' . $remainingMinutes;
                @endphp
                {{$result}}
            </td>
            <td style="border: 1px solid; white-space: pre-line; text-align: left; padding: 10px;">
                {{$data->task}}
            </td>
        </tr>
    @endforeach
</table>

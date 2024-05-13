<table style="text-align: center; width: 100%;">
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
<table style="width: 100%; text-align: center;border: 1px solid; border-collapse: collapse;">
    <tr style="border: 1px solid;">
        <td colspan="3" rowspan="3" style="border: 1px solid; text-align: left;">
{{--            <b>Item: {{ucwords($item)}}</b>--}}
        </td>
        <td colspan="2" rowspan="2" style="border: 1px solid;text-align: left;">
            <b>Description:</b>
        </td>
        <td colspan="2" style="border: 1px solid; text-align: left;">
{{--            <b>Stock No.: {{$stockNum}}</b>--}}
        </td>
    </tr>
    <tr style="border: 1px solid;">
        <td colspan="2" style="border: 1px solid; text-align: left;">
            <b>Re-order Point:</b>
        </td>
    </tr>
    <tr style="border: 1px solid;">
        <td colspan="2" style="border: 1px solid;">
            <b>Issuance</b>
        </td>
        <td style="border: 1px solid;">
            <b>Balance</b>
        </td>
        <td rowspan="2" style="border: 1px solid;">
            <b>No. of Days to Consume</b>
        </td>
    </tr>
    <tr style="text-align: center;">
        <td style="border: 1px solid; width: 15%;">
            <b>Date</b>
        </td>
        <td style="border: 1px solid;">
            <b>Day</b>
        </td>
        <td style="border: 1px solid;">
            <b>Time in</b>
        </td>
        <td style="border: 1px solid;">
            <b>Time out</b>
        </td>
        <td style="border: 1px solid; width: 26%;">
            <b>Time in</b>
        </td>
        <td style="border: 1px solid;">
            <b>Time in</b>
        </td>
        <td style="border: 1px solid;">
            <b>Total time</b>
        </td>
        <td style="border: 1px solid;">
            <b>Task</b>
        </td>
    </tr>
    @foreach($dtrData as $data)
        <tr>
            <td style="border: 1px solid;">
{{--                {{ $data->created_at->format('M-d-Y')}}--}}
            </td>
            <td style="border: 1px solid;">

            </td>
            <td style="border: 1px solid;">
{{--                {{$data->receiptQty}}--}}
            </td>
            <td style="border: 1px solid;">
{{--                {{$data->quantity}}--}}
            </td>
            <td style="border: 1px solid;">
{{--                {{ucwords($data->receiver)}}--}}
            </td>
            <td style="border: 1px solid;">
{{--                {{$data->receiptQty - $data->quantity}}--}}
            </td>
            <td style="border: 1px solid;">

            </td>

        </tr>
    @endforeach
</table>

<table style="text-align: center; width: 100%; margin-left: 5%;">
    <tr>
        <td style="text-align: right; padding-right: 10px; width: 35%;">
            <img src="{{public_path('photo/logo.jpg')}}" width="100">
        </td>
        <td style="text-align: left;">
            <b>IND. Teleoutsource Telemarketing Services.</b><br>
            <small><i>Sta Maria Felimon Salcedo, Bansud, Philippines <br> https://www.facebook.com/Indtelemarketingservices</i></small>
        </td>
    </tr>
</table>
<table style="width: 100%; text-align: center; margin-top: 15px; font-size: 15px;">
    <tr>
        <td>
            <h4>EXIT CLEARANCE FORM</h4>
        </td>
    </tr>
</table>
<table style="width: 100%; border: 1px solid; border-collapse: collapse; margin-bottom: 15px; font-size: 13px" >
    <tr style="border: 1px solid;">
        <td style="border: 1px solid; padding: 8px;">
            <b>Name:</b> {{strtoupper($userInfo->fname)}} {{strtoupper($userInfo->lname)}}
        </td>
        <td style="border: 1px solid; padding: 8px;">
            <b>Date</b> {{\Carbon\Carbon::now()->format('m-d-Y')}}
        </td>
    </tr>
    <tr style="border: 1px solid;">
        <td style="border: 1px solid; padding: 8px;">
            <b>Department:</b> {{strtoupper($userInfo->department)}}
        </td>
        <td style="border: 1px solid; padding: 8px;">
            <b>ID Number</b> {{$userInfo->id_user}}
        </td>
    </tr>
    <tr style="border: 1px solid;">
        <td style="border: 1px solid; padding: 8px;">
            <b>Forwarding Address:</b>
        </td>
        <td style="border: 1px solid; padding: 8px;">
            <b>Position Held:</b>
        </td>
    </tr>
    <tr style="border: 1px solid;">
        <td style="border: 1px solid; padding: 8px;">
            <b>Employee Signature:</b>
        </td>
        <td style="border: 1px solid; padding: 8px;">
            <b>Last Day of Service:</b>
        </td>
    </tr>
</table>
<i>Before your departure, please ensure that you surrender to and clear with your immediate supervisor, relevant parties, and the Finance and Administration Office. The following items</i>
<table style="width: 100%; margin-top: 25px; font-size: 13px">
    <tr>
        <td>
            <h4>IT Department</h4>
        </td>
    </tr>
</table>
<table style="width: 100%; text-align: center;border: 1px solid; border-collapse: collapse; font-size: 13px" >
    <tr style="border: 1px solid;">
        <td style="border: 1px solid; padding: 8px;">
            <b>Device</b>
        </td>
        <td style="border: 1px solid; padding: 8px;">
            <b>Serial number</b>
        </td>
        <td style="border: 1px solid; padding: 8px;">
            <b>Status</b>
        </td>
        <td style="border: 1px solid; padding: 8px;">
            <b>Signature</b>
        </td>
        <td style="border: 1px solid; padding: 8px;">
            <b>Date</b>
        </td>
    </tr>
    @foreach($deviceData as $data)
        <tr style="border: 1px solid;">
            <td style="border: 1px solid; text-align: left; padding: 8px;">{{ucwords($data->name)}} ({{ucwords($data->brand_name)}})</td>
            <td style="border: 1px solid;">{{$data->serial}}</td>
            <td style="border: 1px solid;">{{$data->status}}</td>
            <td style="border: 1px solid;">@if($data->status == "returned") <img src="{{public_path('photo/signature.png')}}" width="170"> @endif</td>
            <td style="border: 1px solid;">{{\Carbon\Carbon::now()->format('m-d-Y')}}</td>
        </tr>
    @endforeach
</table>
<table style="width: 100%; margin-top: 25px; font-size: 13px">
    <tr>
        <td>
            <h4>IT Officer</h4>
        </td>
    </tr>
</table>
<table style="width: 100%; text-align: center;border: 1px solid; border-collapse: collapse; margin-bottom: 15px; font-size: 13px" >
    <tr style="border: 1px solid;">
        <td style="border: 1px solid; padding: 8px; width: 30%;">

        </td>
        <td style="border: 1px solid; padding: 8px;">
            <b>Asset/Serial number/ID number</b>
        </td>
        <td style="border: 1px solid; padding: 8px;">
            <b>Comment</b>
        </td>
        <td style="border: 1px solid; padding: 8px;">
            <b>Signature</b>
        </td>
        <td style="border: 1px solid; padding: 8px;">
            <b>Date</b>
        </td>
    </tr>
    <tr style="border: 1px solid;">
        <td style="border: 1px solid; text-align: left; padding: 8px;">Confirm the deletion of employees from system access & password.</td>
        <td style="border: 1px solid;"></td>
        <td style="border: 1px solid;"></td>
        <td style="border: 1px solid;"><img src="{{public_path('photo/signature.png')}}" width="180"></td>
        <td style="border: 1px solid;">{{\Carbon\Carbon::now()->format('m-d-Y')}}</td>
    </tr>
    <tr style="border: 1px solid;">
        <td style="border: 1px solid; text-align: left; padding: 8px;">Confirm the deletion/suspension of email address and redirection of email to supervisor</td>
        <td style="border: 1px solid;"></td>
        <td style="border: 1px solid;"></td>
        <td style="border: 1px solid;"><img src="{{public_path('photo/signature.png')}}" width="180"></td>
        <td style="border: 1px solid;">{{\Carbon\Carbon::now()->format('m-d-Y')}}</td>
    </tr>
    <tr style="border: 1px solid;">
        <td style="border: 1px solid; text-align: left; padding: 8px;">Confirm the deletion/suspension of the links and dialer</td>
        <td style="border: 1px solid;"></td>
        <td style="border: 1px solid;"></td>
        <td style="border: 1px solid;"><img src="{{public_path('photo/signature.png')}}" width="180"></td>
        <td style="border: 1px solid;">{{\Carbon\Carbon::now()->format('m-d-Y')}}</td>
    </tr>
</table>
<i>Return this form to the Finance and Administration Department on completion to facilitate the release of final dues</i>

<div style="page-break-before: always; margin: 0; padding: 0;">
    <img src="{{ public_path('photo/hr_clearance.png') }}" style="width: 100%; height: 100vh; object-fit: cover; display: block;">
</div>

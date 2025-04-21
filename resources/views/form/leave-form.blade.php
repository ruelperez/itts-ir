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
<table style="width: 100%; text-align: center; margin-top: 15px; font-size: 15px; background-color: #00B0F0; color: white;">
    <tr>
        <td>
            <h4 style="margin: 10px 0;">EMPLOYEE LEAVE APPLICATION FORM</h4>
        </td>
    </tr>
</table>
<ol style="font-size: 14px; margin-top: 10px;">
    <li>All leave applications must be approved by the Management/ Admin.</li>
    <li>Leave due to sickness/ medical reasons for more than 2 days must be supported by a doctor's certificate and must be filed upon return to work/ duty.</li>
    <li>Bereavement Leave can be filed as immediate and no approval is required, but must be supported by pertinent documents upon return to work (Death Certificate or Funeral Letter).</li>
    <li>A Planned Leave application for 3 days or more must be filed at least a week in advance.</li>
    <li>Alteration / Cancelation of applied leave must have the approval of the immediate Supervisor and the Human Resource Office must be properly notified.</li>
    <li>Application response will be provided by the Human Resource Officer via email or will notify the applicants 1 or 2 days before the start date of the leave request.</li>
</ol>
<table border="1" cellspacing="0" cellpadding="5" style="width: 100%; border-collapse: collapse; font-family: Arial; font-size: 14px;">
    <tr style="background-color: #00B0F0; color: white;">
        <td style="width: 50%;"><strong>APPLICATION DATE</strong></td>
        <td><strong>PURPOSE</strong></td>
    </tr>
    <tr>
        <td>{{\Carbon\Carbon::now()->format('m-d-Y')}}</td>
        <td>New Leave Application</td>
    </tr>
    <tr style="background-color: #00B0F0; color: white;">
        <td><strong>EMPLOYEE NAME</strong></td>
        <td><strong>EMPLOYEE ID</strong></td>
    </tr>
    <tr>
        <td>{{$data->employee->employeeFullname ?? 'N/A' }}</td>
        <td>{{$data->employee->id_user ?? 'N/A' }}</td>
    </tr>
    <tr style="background-color: #00B0F0; color: white;">
        <td><strong>DEPARTMENT</strong></td>
        <td><strong>DESIGNATION</strong></td>
    </tr>
    <tr>
        <td>{{$data->employee->department ?? 'N/A' }}</td>
        <td>{{$data->employee->designation ?? 'N/A' }}</td>
    </tr>
</table>

<br>

<table border="1" cellspacing="0" cellpadding="5" style="width: 100%; border-collapse: collapse; font-family: Arial; font-size: 14px;">
    <tr style="background-color: #00B0F0; color: white;">
        <td colspan="2" style="text-align: center;"><strong>REQUEST DETAILS</strong></td>
    </tr>
    <tr>
        <td style="width: 50%; background-color: #D9EDF7;"><strong>START DATE</strong></td>
        <td>{{$data->start ?? 'N/A' }}</td>
    </tr>
    <tr>
        <td style="background-color: #D9EDF7;"><strong>END DATE</strong></td>
        <td>{{$data->end ?? 'N/A' }}</td>
    </tr>
    <tr>
        <td style="background-color: #D9EDF7;"><strong>NO. OF DAYS LEAVE REQUEST</strong></td>
        <td>{{$data->numOfDays ?? 'N/A' }}</td>
    </tr>
    <tr>
        <td style="background-color: #D9EDF7;"><strong>RESUMING WORK DATE</strong></td>
        <td>{{$data->resume ?? 'N/A' }}</td>
    </tr>
    <tr>
        <td style="background-color: #D9EDF7;"><strong>LEAVE TYPE</strong></td>
        <td>{{$data->leaveType ?? 'N/A' }}</td>
    </tr>
    <tr>
        <td style="background-color: #D9EDF7;"><strong>PLEASE SPECIFY THE REASON OF LEAVE</strong></td>
        <td>{{$data->reason ?? 'N/A' }}</td>
    </tr>
</table>

<br>

<table border="1" cellspacing="0" cellpadding="5" style="width: 100%; border-collapse: collapse; font-family: Arial; font-size: 14px;">
    <tr style="background-color: #00B0F0; color: white;">
        <td colspan="2"><strong>WOULD YOU LIKE TO ADD EMERGENCY CONTACT?</strong></td>
    </tr>
    <tr>
        <td colspan="2">@if($data->name == null and $data->address == null and $data->phoneNum == null and $data->relationship == null) No  @else Yes @endif  </td>
    </tr>
    <tr style="background-color: #D9EDF7;">
        <td><strong>NAME</strong></td>
        <td>{{$data->name ?? 'N/A' }}</td>
    </tr>
    <tr style="background-color: #D9EDF7;">
        <td><strong>ADDRESS</strong></td>
        <td>{{$data->address ?? 'N/A' }}</td>
    </tr>
    <tr style="background-color: #D9EDF7;">
        <td><strong>PHONE NUMBER</strong></td>
        <td>{{$data->phoneNum ?? 'N/A' }}</td>
    <tr style="background-color: #D9EDF7;">
        <td><strong>RELATIONSHIP</strong></td>
        <td>{{$data->relationship ?? 'N/A' }}</td>
    </tr>
</table>
<div style="font-family: Arial, sans-serif; font-size: 13px; line-height: 1.6; margin-top: 30px; page-break-before: always;">
    <p style="text-align: justify;">
        I <b>{{$data->employee->employeeFullname ?? 'N/A' }}</b>, thus declare that I have a leave of absence from my duties as stated above,
        and I attest that this leave of absence is being sought for the stated purpose or purposes. I am aware
        that in order to obtain a leave of absence from my employer, I must abide by the company’s guidelines
        and processes (and submit any additional supporting evidence, such as a medical certification, if needed).
        I also understand that submitting a false form could result in disciplinary action, such as termination or dismissal.
    </p>

    <table style="width: 100%; margin-top: 25px;">
        <tr>
            <td style="width: 33%; text-align: left; position: relative;">
                <div style="position: relative; height: 50px;">
                <span style="display: inline-block; border-bottom: 1px solid #000; width: 250px; height: 40px;">
                    @if($data->signature ?? false)
                        <img src="{{ public_path($data->signature) }}"
                             alt="Signature"
                             style="position: absolute; top: -5px; left: 0; height: 40px;">
                    @endif
                </span>
                </div>
                <p style="margin-top: 2px;"><b>{{ $data->employee->employeeFullname ?? 'N/A' }}</b></p>
            </td>
            <td style="text-align: left;">
                <p>Date: {{ \Carbon\Carbon::now()->format('m-d-Y') }}</p>
            </td>
        </tr>
    </table>


    <table style="width: 100%; margin-top: 15px;">
        <tr>
            <td style="width: 33%; text-align: left;">
                <p>Requestor</p>
                <p><b>Earl Mandy Sarion</b><br><small>Immediate Supervisor</small></p>
            </td>
            <td style="text-align: left;">
                <p>Date: {{\Carbon\Carbon::now()->format('m-d-Y')}}</p>
            </td>
        </tr>
    </table>

    <table style="width: 100%; margin-top: 15px;">
        <tr>
            <td style="width: 33%; text-align: left;">
                <p>Verified</p>
                <p><b>Jeraldine Burgos</b><br><small>Human Resource Officer</small></p>
            </td>
            <td style="text-align: left;">
                <p>Date: {{\Carbon\Carbon::now()->format('m-d-Y')}}</p>
            </td>
        </tr>
    </table>

    <p style="margin-top: 20px;"><b>Remarks</b></p>
    <ul style="list-style: none; padding-left: 0;">
        <li><input type="checkbox" checked> APPROVED</li>
        <li><input type="checkbox"> DECLINED</li>
        <li><input type="checkbox"> DATE ADJUSTED ____________________</li>
    </ul>

    <p style="margin-top: 50px; text-align: center;">
        <b><u>Mrs. April Benosa - Martos</u><br>ITTS Owner / CEO</b>
    </p>
</div>



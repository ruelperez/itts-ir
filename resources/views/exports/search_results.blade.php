<table>
    <thead>
    <tr>
        <th>Tracker ID</th>
        <th>Date</th>
        <th>Agent</th>
        <th>Claimant</th>
        <th>Injured Party</th>
        <th>Phone Number</th>
        <th>Alt. Phone Number</th>
        <th>Campaign</th>
        <th>Client</th>
        <th>Lawfirm</th>
        <th>Remarks</th>
        <th>Result</th>
    </tr>
    </thead>
    <tbody>
    @foreach($submissionData as $data)
        <tr>
            <td>{{ $data->id }}</td>
            <td>{{ $data->date }}</td>
            <td>{{ $data->agent }}</td>
            <td>{{ $data->claimant }}</td>
            <td>{{ $data->injuredParty }}</td>
            <td>{{ $data->phoneNumber }}</td>
            <td>{{ $data->altPhoneNumber }}</td>
            <td>{{ ucwords($data->campaign) }}</td>
            <td>{{ ucwords($data->client) }}</td>
            <td>{{ ucwords($data->lawfirm) }}</td>
            <td>{{ $data->remarks }}</td>
            <td>{{ ucfirst($data->result) }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

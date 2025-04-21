<div>
    <div class="row mb-3">
        <div class="col-sm-6">
            <h5>My Leave Approval</h5>
        </div>
        <div class="col-sm-6 text-sm-end">
            <button type="button" class="btn btn-dark" onclick="location.href = '/link-form/leave-form';"><i class="fa-solid fa-code-pull-request me-2" ></i>Leave Form</button>
        </div>
    </div>

    <hr>
    <div style="font-size: 14px; margin-top: 30px; width: 92%; margin-left: 4%; box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.5);"  class="px-5 py-3">
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">Start date</th>
                <th scope="col">End date</th>
                <th scope="col">No. days leave</th>
                <th scope="col">Resuming work date</th>
                <th scope="col">Leave type</th>
                <th scope="col">Reason</th>
                <th scope="col">Remark</th>
            </tr>
            </thead>
            <tbody>
            @foreach($datas as $data)
                <tr>
                    <td>
                        {{$data->start}}
                    </td>
                    <td>
                        {{$data->end}}
                    </td>
                    <td>
                        {{$data->numOfDays}}
                    </td>
                    <td>
                        {{$data->resume}}
                    </td>
                    <td>
                        {{$data->leaveType}}
                    </td>
                    <td>
                        {{$data->reason}}
                    </td>
                    <td>
                        @if ($data->remark != "Declined" and $data->remark != "Approved" and $data->remark != null)
                            <p style="color: blue">Adjusted ({{ $data->remark }})</p>
                        @else
                            <p @if($data->remark == "Approved") style="color: green" @endif  @if($data->remark == "Declined") style="color: red" @endif>{{ $data->remark }}</p>
                        @endif
                    </td>
                    @if($data->remark == "Approved")
                        <td>
                            <i class="fa-regular fa-file text-primary" style="cursor: pointer" onclick="location.href = '/pdf/leave-form/{{$data->id}}';" ></i>
                        </td>
                    @endif

                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    @script
    <script>
        $wire.on('success', () => {
            Swal.fire({
                title: 'Submitted!',
                text: 'Successfully Updated.',
                icon: 'success',
                allowOutsideClick: false,
                allowEscapeKey: false
            }).then((result) => {
                if (result.isConfirmed) {
                    location.reload();
                }
            });
        });
    </script>
    @endscript
</div>

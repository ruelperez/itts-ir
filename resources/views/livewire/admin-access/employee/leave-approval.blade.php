<div>
    <!-- Modal -->
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Update Leave Remark</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <label for="actionSelect" class="form-label">Choose Action:</label>
                    <select wire:model.live="selectedAction" id="actionSelect" class="form-select">
                        <option value="">-- Select --</option>
                        <option value="Approved">Approved</option>
                        <option value="Declined">Declined</option>
                        <option value="Adjusted">Adjusted</option>
                    </select>

                    @if($selectedAction === 'Adjusted')
                        <div class="mt-3">
                            <label for="adjustedDate" class="form-label">Select New Date:</label>
                            <input type="date" id="adjustedDate" wire:model="adjustedDate" class="form-control">
                        </div>
                    @endif
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" wire:click="updateRemark">OK</button>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-sm-6">
            <h5>Employee Leave Approval</h5>
        </div>
    </div>
    <hr>
    <div style="font-size: 14px; margin-top: 30px; width: 92%; margin-left: 4%; box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.5);"  class="px-5 py-3">
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">Employee Name</th>
                <th scope="col">Designation</th>
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
                <tr @if($data->remark == null) class="fw-bold" @endif>
                    <td>
                        {{ $data->employee->employeeFullname ?? 'N/A' }}
                    </td>
                    <td>
                        {{ $data->employee->designation ?? 'N/A' }}
                    </td>
                    <td>
                        {{ $data->start }}
                    </td>
                    <td>
                        {{ $data->end }}
                    </td>
                    <td>
                        {{ $data->numOfDays }}
                    </td>
                    <td>
                        {{ $data->resume }}
                    </td>
                    <td>
                        {{$data->leaveType}}
                    </td>
                    <td>
                        {{ $data->reason }}
                    </td>
                    <td>
                        @if ($data->remark != "Declined" and $data->remark != "Approved" and $data->remark != null)
                            <p style="color: blue">Adjusted ({{ $data->remark }})</p>
                        @else
                            <p @if($data->remark == "Approved") style="color: green" @endif  @if($data->remark == "Declined") style="color: red" @endif>{{ $data->remark }}</p>
                        @endif
                    </td>
                    <td style="cursor: pointer" onclick="location.href = '/pdf/leave-form/{{$data->id}}';">
                        @if($data->remark == "Approved")
                            <i class="fa-regular fa-file text-primary"></i>
                        @endif
                    </td>
                    <td class="edit-icon" style="cursor: pointer"
                        wire:click="$set('selectedLeaveId', {{ $data->id }})"
                        data-bs-toggle="modal"
                        data-bs-target="#updateModal">
                        <i class="fa-solid fa-marker"></i>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    @script
    <script>
        $wire.on('success', () => {
            Swal.fire({
                title: 'Updated!',
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

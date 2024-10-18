<div>
    <div class="modal fade" id="positionModal" tabindex="-1" aria-labelledby="positionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="positionModalLabel">Update Role ({{$user_fullname}})</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="submitEditRole">
                    <div class="modal-body">
                        <select id="positionSelect" class="form-select" wire:model="user_position">
                            <option value="Super Admin">Super Admin</option>
                            <option value="Admin">Admin</option>
                            <option value="Agent">Agent</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                    <button type="button" class="btn-close d-none" data-bs-dismiss="modal" id="btnclose122" aria-label="Close"></button>
                </form>
            </div>
        </div>
    </div>
    <div>
        <div class="row">
            <div class="col-lg-3 pt-lg-2">
                <h6>User Access</h6>
            </div>
            <div class="col-sm-6 col-lg-4 mt-1 mt-lg-0">
                <input class="form-control" type="search" placeholder="Search" aria-label="Search" wire:model.live="search">
            </div>
        </div>
        <div class="text-center">
            <div class="spinner-border mt-5" role="status" wire:loading>
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
        <div class="table-responsive mt-lg-4" style="font-size: 13px">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col">Name</th>
                    <th scope="col">Role</th>
                    <th scope="col">Can login</th>
                    <th scope="col">Dtr record</th>
                    <th scope="col">Camp CRUD</th>
                    <th scope="col">Staff Direct.</th>
                    <th scope="col">Logs</th>
                    <th scope="col">EOD</th>
                    <th scope="col">Inventory</th>
                    <th scope="col">Lead tracker</th>
                    <th scope="col">User credential</th>
                    <th scope="col">Settings</th>
                </tr>
                </thead>
                <tbody>
                @foreach($datas as $data)
                    <tr onmouseover="hoverStaff({{$data->id}})" onmouseout="hoverOutStaff({{$data->id}})">
                        <td>
                            <div class="profile-picture-logs">
                                <img src="{{asset('photos/photos/'.$data->user->photo)}}" alt="Profile Picture">
                            </div>
                        </td>
                        <td class="text-capitalize" >
                            {{$data->user->fullname}}
                        </td>
                        <td x-data
                            @dblclick="$dispatch('openPositionModal', { id: {{ $data->user_id }} })">
                            {{$data->user->position}}
                        </td>
                        <td
                            ondblclick="confirmEdit({{ $data->id }},{{$data->can_login}},'can_login')"
                            data-original-value="{{ $data->can_login }}"
                        >
                            {{ $data->can_login ? '1' : '0' }}
                        </td>
                        <td
                            ondblclick="confirmEdit({{ $data->id }},{{$data->dtr_record}},'dtr_record')"
                            data-original-value="{{ $data->dtr_record }}"
                        >
                            {{ $data->dtr_record ? '1' : '0' }}
                        </td>
                        <td
                            ondblclick="confirmEdit({{ $data->id }},{{$data->campaign_settings}},'campaign_settings')"
                            data-original-value="{{ $data->campaign_settings }}"
                        >
                            {{ $data->campaign_settings ? '1' : '0' }}
                        </td>
                        <td
                            ondblclick="confirmEdit({{ $data->id }},{{$data->staff_directory}},'staff_directory')"
                            data-original-value="{{ $data->staff_directory }}"
                        >
                            {{ $data->staff_directory ? '1' : '0' }}
                        </td>
                        <td
                            ondblclick="confirmEdit({{ $data->id }},{{$data->logs}},'logs')"
                            data-original-value="{{ $data->logs }}"
                        >
                            {{ $data->logs ? '1' : '0' }}
                        </td>
                        <td
                            ondblclick="confirmEdit({{ $data->id }},{{$data->eod}},'eod')"
                            data-original-value="{{ $data->eod }}"
                        >
                            {{ $data->eod ? '1' : '0' }}
                        </td>
                        <td
                            ondblclick="confirmEdit({{ $data->id }},{{$data->inventory}},'inventory')"
                            data-original-value="{{ $data->inventory }}"
                        >
                            {{ $data->inventory ? '1' : '0' }}
                        </td>
                        <td
                            ondblclick="confirmEdit({{ $data->id }},{{$data->lead_tracker}},'lead_tracker')"
                            data-original-value="{{ $data->lead_tracker }}"
                        >
                            {{ $data->lead_tracker ? '1' : '0' }}
                        </td>
                        <td
                            ondblclick="confirmEdit({{ $data->id }},{{$data->user_credential}},'user_credential')"
                            data-original-value="{{ $data->user_credential }}"
                        >
                            {{ $data->user_credential ? '1' : '0' }}
                        </td>
                        <td
                            ondblclick="confirmEdit({{ $data->id }},{{$data->settings}},'settings')"
                            data-original-value="{{ $data->settings }}"
                        >
                            {{ $data->settings ? '1' : '0' }}
                        </td>
                    </tr>
                    <button class="d-none" id="btn200_{{$data->id}}" wire:click="update_data({{$data->id}}, $('#btn200_{{$data->id}}').data('column'))"></button>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="row mt-4">
            <div class="col-12 col-md-6 col-lg-2">
                <button class="btn btn-success w-100" wire:click="previousPage">Previous</button>
            </div>
            <div class="col-12 col-md-6 col-lg-2 mt-2 mt-md-0">
                <button class="btn btn-primary w-100" wire:click="nextPage">Next</button>
            </div>
        </div>
    </div>

    @script
    <script>
        $wire.on('accessUpdated', () => {
            Swal.fire(
                'Updated!',
                'The value has been updated successfully.',
                'success'
            );
        });

        $wire.on('success', () => {btnclose122
            $('#btnclose122').click();
            Swal.fire(
                'Updated!',
                'Successfully Updated .',
                'success'
            );
        });
        $wire.on('error', () => {
            $('#btnclose122').click();
            Swal.fire(
                'Updated!',
                'Failed to Update.',
                'error'
            );
        });
    </script>
    @endscript
</div>

<script>
    function confirmEdit(userAccessId,datas,column) {
        if (datas == 0){
            datas = 1;
        }
        else {
            datas = 0;
        }

        // Trigger SweetAlert2 confirmation dialog
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to change this value to "+datas,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, update it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $('#btn200_'+userAccessId).data('column', column).click();
            }
        });
    }

    document.addEventListener('show-position-modal', function () {
        const positionModal = new bootstrap.Modal(document.getElementById('positionModal'));
        positionModal.show();
    });
</script>

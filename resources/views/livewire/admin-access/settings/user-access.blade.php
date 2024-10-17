<div>
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
        <div class="table-responsive mt-lg-4" style="font-size: 13px" wire:loading.remove>
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
                        <td>
                            {{$data->user->fullname}}
                        </td>
                        <td>
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
</script>

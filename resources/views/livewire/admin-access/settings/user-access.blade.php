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
        <div class="table-responsive mt-lg-4">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col">Name</th>
                    <th scope="col">Can login</th>
                    <th scope="col">Dtr record</th>
                    <th scope="col">Campaign Settings</th>
                    <th scope="col">Staff Directory</th>
                    <th scope="col">Logs</th>
                    <th scope="col">EOD</th>
                    <th scope="col">Inventory</th>
                    <th scope="col">Lead tracker</th>
                    <th scope="col">User credential</th>
                    <th scope="col">Settings</th>
                </tr>
                </thead>
                <tbody>
                @php $i=0; @endphp
                @foreach($staffData as $data)
                    <tr onmouseover="hoverStaff({{$data->id}})" onmouseout="hoverOutStaff({{$data->id}})">
                        <td>
                            <div class="profile-picture-logs">
                                <img src="{{asset('photos/photos/'.$data->photo)}}" alt="Profile Picture">
                            </div>

                        </td>
                        <td>
                            {{$data->fullname}}
                        </td>
                        <td>
                            {{$data->username}}
                        </td>
                        <td>
                            {{$data->password}}
                        </td>
                    </tr>
                    @php $i++; @endphp
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

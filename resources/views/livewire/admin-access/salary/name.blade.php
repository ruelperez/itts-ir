<div>
    <div class="row mb-4">
        <div class="col-sm-6 col-md-4 col-lg-4 col-xl-3">
            Employee Daily Rate
        </div>
        <div class="mt-sm-0 col-sm-6 col-md-8 col-lg-6 col-xl-4 mt-2">
            <input
                type="text"
                wire:model.live="search"
                placeholder="Search by fullname"
                class="form-control w-100"
            />
        </div>
    </div>
    <hr>
    <div class="table-responsive mt-lg-4" style="font-size: 14px;">
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">Name</th>
                {{--                <th scope="col">Basic Pay</th>--}}
                {{--                <th scope="col">Night Diff</th>--}}
                {{--                <th scope="col">Allowance</th>--}}
                {{--                <th scope="col">Holiday</th>--}}
                {{--                <th scope="col">Overtime</th>--}}
                {{--                <th scope="col">Other</th>--}}
            </tr>
            </thead>
            <tbody>
            @foreach($data as $datas)
                <tr>
                    <td>
                        <p class="hover-text" onclick="location.href = '/admin-access/salary/rate/{{$datas->id}}';">{{$datas->employeeFullname}}</p>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

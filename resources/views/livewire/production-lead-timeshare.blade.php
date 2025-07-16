<div>
    @include('modal.timeshare-tracker.viewDetail')
    <div>
        <h6>MY PRODUCTION LEAD</h6>
    </div>
    <div class="row  mt-3 mt-md-4">
        <div class="col-sm-5 col-lg-3 col-xl-2">
            <button class="btn btn-secondary dropdown-toggle w-100" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                TIMESHARE
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                <li><a class="dropdown-item" href="/production-lead-timeshare">Timeshare</a></li>
{{--                <li><a class="dropdown-item" href="/production-lead-travel">Travel</a></li>--}}
                <li><a class="dropdown-item" href="/production-lead-mass-tort">Mass Tort</a></li>
{{--                <li><a class="dropdown-item" href="/production-lead-dtv">Direct TV</a></li>--}}
            </ul>
        </div>
        <div class="col-sm-7 col-lg-5 col-xl-5 mt-2 mt-sm-0">
            <input class="form-control w-100" type="search" placeholder="Search" aria-label="Search" wire:model.live="search">
        </div>
        <div class="col-sm-5 col-lg-2 col-xl-2 mt-2 mt-sm-2 mt-lg-0 ms-lg-auto">
            <button class="btn btn-warning w-100" onclick="location.href = '/my-callback/timeshare';">My Callback</button>
        </div>
    </div>
    <div class="text-center">
        <div class="spinner-border mt-5" role="status" wire:loading>
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
    <div class="mt-2 mt-sm-4 text-danger" wire:loading.remove>
        <i class="fa-solid fa-circle-exclamation me-2"></i><small>To view <b>complete details</b>, click the record.</small>
    </div>
    <hr>
    <div style="font-size: 14px;" class="table-responsive" wire:loading.remove>
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col" style="width: 9%;">Tracker ID</th>
                <th scope="col" style="width: 9%;">Date</th>
                <th scope="col" style="width: 9%;">Agent</th>
                <th scope="col" style="width: 9%;">Guest 1</th>
                <th scope="col" style="width: 9%;">Guest 2</th>
                <th scope="col" style="width: 9%;">Phone</th>
                <th scope="col" style="width: 9%;">Alt. Phone</th>
                <th scope="col" style="width: 9%;">Email</th>
                <th scope="col" style="width: 15%;">Remarks</th>
            </tr>
            </thead>
            <tbody>
            @foreach($submissionData as $data)
                <tr wire:click="viewDetail({{$data->id}})" data-bs-toggle="modal" data-bs-target="#viewDetail" style="cursor: pointer">
                    <td>
                        {{$data->id}}
                    </td>
                    <td>
                        {{$data->date}}
                    </td>
                    <td>
                        {{$data->agent}}
                    </td>
                    <td>
                        {{$data->guest1}}
                    </td>
                    <td>
                        {{$data->guest2}}
                    </td>
                    <td>
                        {{$data->phoneNumber}}
                    </td>
                    <td>
                        {{$data->altPhoneNumber}}
                    </td>
                    <td>
                        {{ucwords($data->email)}}
                    </td>
                    <td>
                        @if($data->reason == "")
                            {{ucwords($data->remarks)}}
                        @else
                            {{ucwords($data->remarks)}} - {{$data->reason}}
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="row">
            <div class="col-12 col-md-6 col-lg-3 col-xl-2">
                <button class="btn btn-success w-100" wire:click="previousPage">Previous</button>
            </div>
            <div class="col-12 col-md-6 col-lg-3 col-xl-2 mt-2 mt-md-0">
                <button class="btn btn-primary w-100" wire:click="nextPage">Next</button>
            </div>
        </div>
    </div>

</div>

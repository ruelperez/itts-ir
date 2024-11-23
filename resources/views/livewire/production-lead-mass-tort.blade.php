<div>
    @include('modal.dupe-checker.viewDetail')
    <div>
        <h6>MY PRODUCTION LEAD</h6>
    </div>
    <div class="row  mt-3 mt-md-4">
        <div class="col-sm-5 col-lg-3 col-xl-2">
            <button class="btn btn-secondary dropdown-toggle w-100" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                MASS TORT
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                <li><a class="dropdown-item" href="/production-lead-mass-tort">Mass Tort</a></li>
                <li><a class="dropdown-item" href="/production-lead-dtv">Direct TV</a></li>
            </ul>
        </div>
        <div class="col-sm-7 col-lg-5 col-xl-5 mt-2 mt-sm-0">
            <input class="form-control w-100" type="search" placeholder="Search" aria-label="Search" wire:model.live="search">
        </div>
{{--        <div class="col-sm-5 col-lg-2 col-xl-2 mt-2 mt-sm-2 mt-lg-0 ms-lg-auto">--}}
{{--            <button class="btn btn-warning w-100" onclick="location.href = '/my-callback';">My Callback</button>--}}
{{--        </div>--}}
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
                <th scope="col" style="width: 9%;">Date</th>
                <th scope="col" style="width: 9%;">Agent</th>
                <th scope="col" style="width: 9%;">Claimant</th>
                <th scope="col" style="width: 9%;">Injured party</th>
                <th scope="col" style="width: 9%;">Phone #</th>
{{--                <th scope="col" style="width: 9%;">Alt. Phone #</th>--}}
                <th scope="col" style="width: 8%;">Campaign</th>
                <th scope="col" style="width: 8%;">Client</th>
                <th scope="col" style="width: 8%;">Lawfirm</th>
                <th scope="col" style="width: 15%;">Remarks</th>
                <th scope="col" style="width: 15%;">Result</th>
            </tr>
            </thead>
            <tbody>
            @foreach($submissionData as $data)
                <tr wire:click="viewDetail({{$data->id}})" data-bs-toggle="modal" data-bs-target="#viewDetail" style="cursor: pointer">
                    <td>
                        {{$data->date}}
                    </td>
                    <td>
                        {{$data->agent}}
                    </td>
                    @if($data->caseType == "self")
                        <td>
                            {{$data->claimant}}
                        </td>
                        <td>
                            (Claimant)
                        </td>
                    @else
                        <td>
                            {{$data->claimant}}
                        </td>
                        <td>
                            {{$data->injuredParty}}
                        </td>
                    @endif
                    <td>
                        {{$data->phoneNumber}}
                    </td>
{{--                    <td>--}}
{{--                        {{$data->altPhoneNumber}}--}}
{{--                    </td>--}}
                    <td>
                        {{ucwords($data->campaign)}}
                    </td>
                    <td>
                        {{ucwords($data->client)}}
                    </td>
                    <td>
                        {{ucwords($data->lawfirm)}}
                    </td>
                    <td>
                        {{$data->remarks}}
                    </td>
                    <td>
                        {{ucfirst($data->result)}}
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

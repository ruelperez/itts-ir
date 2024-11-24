<div>
{{--    @include('modal.dupe-checker.viewDetail')--}}
    @include('modal.callback.add')
    <div>
        <i class="fa-solid fa-arrow-left" onclick="location.href = '/production-lead-mass-tort';" style="cursor: pointer"></i>
        <h6>MY CALLBACK</h6>
    </div>
    <div class="row  mt-3 mt-md-4">
        <div class="col-sm-7 col-lg-5 col-xl-5 mt-2 mt-sm-0">
            <input class="form-control w-100" type="search" placeholder="Search" aria-label="Search" wire:model.live="search">
        </div>
        <div class="col-sm-3 col-lg-5 col-xl-5 mt-2 ">
            <i class="fa-solid fa-circle-plus" style="font-size: 18px; cursor: pointer" data-bs-toggle="modal" data-bs-target="#add"></i>
        </div>
    </div>
    <div class="text-center">
        <div class="spinner-border mt-5" role="status" wire:loading>
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
    <hr>
    <div style="font-size: 14px;" class="table-responsive" wire:loading.remove>
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col" style="width: 9%;">Date</th>
                <th scope="col" style="width: 8%;">Campaign</th>
                <th scope="col" style="width: 9%;">Claimant</th>
                <th scope="col" style="width: 9%;">Injured party</th>
                <th scope="col" style="width: 9%;">Phone #</th>
                <th scope="col" style="width: 9%;">Alt Phone #</th>
                <th scope="col" style="width: 9%;">Email</th>
                <th scope="col" style="width: 9%;">DOB</th>
                <th scope="col" style="width: 9%;">Address</th>
                <th scope="col" style="width: 9%;">Callback time</th>
                <th scope="col" style="width: 9%;">Reason</th>
                <th scope="col" style="width: 9%;">Remaining</th>
                <th scope="col" style="width: 9%;">Is expired</th>
            </tr>
            </thead>
            <tbody>
            @foreach($submissionData as $data)
                <tr @if($data->is_expired == "1") style=" background-color: #FF2828; color: white" @endif>
{{--                <tr wire:click="viewDetail({{$data->id}})" data-bs-toggle="modal" data-bs-target="#viewDetail" style="cursor: pointer">--}}
                    <td>
                        {{$data->created_at}}
                    </td>
                    <td>
                        {{$data->campaign}}
                    </td>
                    <td>
                        {{$data->agent}}
                    </td>
                    <td>
                        {{$data->claimant}}
                    </td>
                    <td>
                        {{$data->injuredParty}}
                    </td>
                    <td>
                        {{$data->phoneNumber}}
                    </td>
                    <td>
                        {{$data->altPhoneNumber}}
                    </td>
                    <td>
                        {{$data->email}}
                    </td>
                    <td>
                        {{$data->dob}}
                    </td>
                    <td>
                        {{$data->address}}
                    </td>
                    <td>
                        {{$data->callbackTime}}
                    </td>
                    <td>
                        {{$data->timeRemaining }}
                    </td>
                    <td>
                        {{$data->is_expired ? 'Yes' : 'No' }}
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

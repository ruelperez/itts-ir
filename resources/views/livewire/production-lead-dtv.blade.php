<div>
    @include('modal.dtv.view-details')
    <div>
        <h6>MY PRODUCTION LEAD</h6>
    </div>
    <div class="row  mt-3 mt-md-4">
        <div class="col-sm-5 col-lg-3 col-xl-2">
            <button class="btn btn-secondary dropdown-toggle w-100" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                DTV
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                <li><a class="dropdown-item" href="/production-lead-mass-tort">Mass Tort</a></li>
                <li><a class="dropdown-item" href="/production-lead-dtv">Direct TV</a></li>
            </ul>
        </div>
        <div class="col-sm-7 col-md- col-lg-5 col-xl-5 mt-2 mt-sm-0">
            <input class="form-control w-100" type="search" placeholder="Search" aria-label="Search" wire:model.live="search">
        </div>
    </div>
    <div class="text-center">
        <div class="spinner-border mt-5" role="status" wire:loading>
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
    <div class="table-responsive mt-sm-4" wire:loading.remove>
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">Date (U.S time)</th>
                <th scope="col" >Customer</th>
                <th scope="col" >Phone #</th>
                <th scope="col" >Alt. Phone #</th>
                <th scope="col" >Email</th>
                <th scope="col" >Service Addr.</th>
                <th scope="col" >Order #</th>
                <th scope="col" >Disposition</th>
                <th scope="col" >Result</th>
            </tr>
            </thead>
            <tbody>
            @foreach($submissionData as $data)
                <tr wire:click="viewDetail({{$data->id}})" data-bs-toggle="modal" data-bs-target="#viewDetail" style="cursor: pointer">
                    <td>
                        {{$data->date}}
                    </td>
                    <td>
                        {{ucwords($data->name)}}
                    </td>
                    <td>
                        {{$data->phone_num}}
                    </td>
                    <td>
                        {{$data->alt_num}}
                    </td>
                    <td>
                        {{$data->email}}
                    </td>
                    <td>
                        {{ucfirst($data->address)}}
                    </td>
                    <td>
                        {{$data->orderNumber}}
                    </td>
                    <td>
                       <b>{{ucfirst($data->disposition)}} - {{ucfirst($data->description)}}</b>
                    </td>
                    <td>
                        {{ucfirst($data->result)}}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="row">
            <div class="col-12 col-md-6 col-lg-3 col-xl-3">
                <button class="btn btn-success w-100" wire:click="previousPage">Previous</button>
            </div>
            <div class="col-12 col-md-6 col-lg-3 col-xl-3 mt-2 mt-md-0">
                <button class="btn btn-primary w-100" wire:click="nextPage">Next</button>
            </div>
        </div>
    </div>

</div>

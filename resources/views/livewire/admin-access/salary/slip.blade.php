<div>
    @include('modal.slip.dtr-content')
    @include('modal.slip.paper-slip')
    <div class="row mb-4">
        <div class="col-sm-8 col-md-6 col-lg-4 col-xl-3">
            <select class="form-select" aria-label="Default select example" wire:model.live="selectDate">
                <option value="">Select date</option>
                @foreach($dates as $date)
                    <option value="{{$date->id}}">{{$date->start}} - {{$date->end}}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3 col-sm-8 col-md-6 col-lg-5 col-xl-5">
            <input
                type="text"
                wire:model.live="search"
                placeholder="Search by fullname"
                class="form-control w-100"
            />
        </div>
        <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2 ms-auto">
            <button type="button " class="btn btn-warning w-100" onclick="location.href = '/admin-access/salary/record';"><i class="fa-solid fa-list me-2"></i>Salary Record</button>
        </div>
    </div>
<hr>
    <div class="table-responsive mt-lg-4">
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Pay slip</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data as $datas)
                <tr>
                    <td>
                        <p class="hover-text" data-bs-toggle="modal" data-bs-target="#showContent" wire:click="clickName({{$datas->user_id}})" >{{$datas->fullname}}</p>
                    </td>
                    <td>
                        <i class="fa-solid fa-sliders" style="cursor: pointer" data-bs-toggle="modal" data-bs-target="#paper"></i>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

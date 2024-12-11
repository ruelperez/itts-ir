<div>
    @include('modal.slip.dtr-content')
    <div class="row">
        <div class="col-sm-5 col-lg-3">
            <b>{{$interval->start}} - {{$interval->end}}</b>
        </div>
        <div class="col-sm-7 col-lg-5 mt-3 mt-sm-0 mt-lg-0 col-xl-5">
            <input class="form-control" type="search" placeholder="Search" aria-label="Search" wire:model.live="search">
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
                    <td class="p-3">
                        <p class="hover-text" data-bs-toggle="modal" data-bs-target="#showContent" wire:click="clickName({{$datas->user_id}})" >{{$datas->fullname}}</p>
                    </td>
                    <td class="p-3">
                        <i class="fa-solid fa-sliders" style="cursor: pointer"></i>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

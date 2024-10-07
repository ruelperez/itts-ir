<div>
    @include('modal.news-update.show-photo')
    @include('modal.dupe-checker.form')
    @include('modal.dupe-checker.saveOrNot')
    @include('modal.dtv.view-details')
                <div class="mb-4">
                    <h6>Direct TV Tracker</h6>
                </div>
                <div class="row">
                    <div class="col-md-6 col-lg-5 col-xl-4">
                        <input class="form-control" type="search" placeholder="Search" aria-label="Search" wire:model.live="search">
                    </div>
                    <div class="mt-3 col-6 col-sm-3 col-md-3 col-lg-5 col-xl-6 text-md-center pe-lg-5 text-lg-end">
                        @if(count($checkBox) == 1)
                            <i class="fa-solid fa-eye" style="cursor: pointer" title="View details" wire:loading.attr="disabled" wire:click="viewDetail" data-bs-toggle="modal" data-bs-target="#viewDetail"></i>
{{--                            <i class="fa-solid fa-pen-to-square ms-3" style="cursor: pointer" title="Edit" onclick="location.href = '/edit-leads/dtv-tracker-edit/{{$checkBox[0]}}';" id="dupeEditID" target="_blank"></i>--}}
                            <i class="fa-solid fa-trash ms-3 text-danger" style="cursor: pointer" title="Delete" wire:click="delete" wire:confirm="Are you sure you want to delete?"></i>
                        @endif
                        @if(count($checkBox) > 1)
                            <i class="fa-solid fa-trash ms-3 text-danger" style="cursor: pointer;" title="Delete" wire:click="delete" wire:confirm="Are you sure you want to delete?"></i>
                        @endif
                    </div>
                    @if(count($checkBox) > 0)
                        <div class="mt-3 mt-md-0 col-6 col-sm-5 col-md-3 col-lg-2">
                            <button type="button" class="btn btn-primary w-100" wire:click="clearCheck"><i class="fa-solid fa-broom me-2"></i>Uncheck</button>
                        </div>
                    @endif
                </div>
                <hr>
                <div class="text-center">
                    <div class="spinner-border mt-5" role="status" wire:loading>
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
                <div style="font-size: 13px;" class="table-responsive " wire:loading.remove>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col" style="width: 9%;">Date (U.S time)</th>
                            <th scope="col" style="width: 9%;">Customer</th>
                            <th scope="col" style="width: 9%;">Phone #</th>
                            <th scope="col" style="width: 9%;">Alt. Phone #</th>
                            <th scope="col" style="width: 8%;">Email</th>
                            <th scope="col" style="width: 8%;">Order #</th>
                            <th scope="col" style="width: 9%;">Service Addr.</th>
                            <th scope="col" style="width: 9%;">Agent</th>
                            <th scope="col" style="width: 15%;">Disposition</th>
{{--                            <th scope="col" style="width: 15%;">Result</th>--}}
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($submissionData as $data)
                            <tr onmouseover="hoverDupe({{$data->id}})" onmouseout="hoverOutDupe({{$data->id}})">
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
                                    {{$data->orderNumber}}
                                </td>
                                <td>
                                    {{ucfirst($data->address)}}
                                </td>
                                <td>
                                    {{ucwords($data->agent)}}
                                </td>
                                <td>
                                    <b>{{ucfirst($data->disposition)}} - {{ucfirst($data->description)}}</b>
                                </td>
{{--                                <td>--}}
{{--                                    {{ucfirst($data->result)}}--}}
{{--                                </td>--}}
                                <td>
                                    <input class="form-check-input" type="checkbox" wire:model.live="checkBox" value="{{$data->id}}" id="flexCheckDefault{{$data->id}}" style="font-size: 18px; cursor: pointer" wire:loading.attr="disabled">
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-3 col-xl-3">
                        <button class="btn btn-success w-100" wire:click="previousPage">Previous</button>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3 col-xl-3 mt-2 mt-md-0">
                        <button class="btn btn-primary w-100" wire:click="nextPage">Next</button>
                    </div>
                </div>
    @script
    <script>
        $wire.on('dupeSubmitted', () => {
            $('#formClose').click();
            $('#btn123456').click();
        });
    </script>
    @endscript
</div>

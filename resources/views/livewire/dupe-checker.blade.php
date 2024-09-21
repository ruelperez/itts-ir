<div>
    @include('components.layouts.profile')
    @include('components.layouts.navigation')
    @include('modal.click-settings')
    @include('modal.news-update.show-photo')
    @include('modal.dupe-checker.form')
    @include('modal.dupe-checker.saveOrNot')
    @include('modal.dupe-checker.viewDetail')
    <div style="display: flex; width: 100%; margin-top: 105px;">
        <div style="width: 81%; margin-left: 19%;">
            <div class="container">
                <div>
                    <h6 style="margin-left: 2%; margin-top: 3%;">Mass Tort Tracker</h6>
                </div>
                <hr>
                <div class="row">
                    <div class="col-6 ps-5 d-flex ms-2 mt-3">
                        <div class="w-50">
                            <input class="form-control" type="search" placeholder="Search" aria-label="Search" wire:model.live="search">
                        </div>
                        <div class="ms-5 pt-2">
                            @if(count($checkBox) == 1)
                                <i class="fa-solid fa-eye" style="cursor: pointer" title="View details" wire:loading.attr="disabled" wire:click="viewDetail" data-bs-toggle="modal" data-bs-target="#viewDetail"></i>
                                <i class="fa-solid fa-pen-to-square ms-3" style="cursor: pointer" title="Edit" onclick="location.href = '/itts/25/mass-tort-tracker/edit/{{$checkBox[0]}}';" id="dupeEditID" target="_blank"></i>
                                <i class="fa-solid fa-trash ms-3 text-danger" style="cursor: pointer" title="Delete" wire:click="delete" wire:confirm="Are you sure you want to delete?"></i>
                            @endif
                            @if(count($checkBox) > 1)
                                <i class="fa-solid fa-trash ms-3 text-danger" style="cursor: pointer;" title="Delete" wire:click="delete" wire:confirm="Are you sure you want to delete?"></i>
                            @endif
                        </div>
                    </div>
                    <div class="col-3">

                    </div>
                    @if(count($checkBox) > 0)
                        <div class="col-2 pt-3 ms-auto">
                            <button type="button" class="btn btn-primary" wire:click="clearCheck"><i class="fa-solid fa-broom me-2"></i>Clear checks</button>
                        </div>
                    @endif
                </div>
                <div class="text-center">
                    <div class="spinner-border mt-5" role="status" wire:loading>
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
                <div style="font-size: 13px; margin-top: 15px;"  class="px-2" wire:loading.remove>
                    <table class="table table-striped" style="width: 100%;">
                        <thead>
                        <tr>
                            <th scope="col" style="width: 9%;">Date</th>
                            <th scope="col" style="width: 9%;">Agent</th>
                            <th scope="col" style="width: 9%;">Claimant</th>
                            <th scope="col" style="width: 9%;">Injured party</th>
                            <th scope="col" style="width: 9%;">Phone number</th>
                            <th scope="col" style="width: 9%;">Alt. Phone number</th>
                            <th scope="col" style="width: 8%;">Campaign</th>
                            <th scope="col" style="width: 8%;">Client</th>
                            <th scope="col" style="width: 8%;">Lawfirm</th>
                            <th scope="col" style="width: 15%;">Remarks</th>
                            <th scope="col" style="width: 15%;">Result</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($submissionData as $data)
                            <tr onmouseover="hoverDupe({{$data->id}})" onmouseout="hoverOutDupe({{$data->id}})">
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
                                <td>
                                    {{$data->altPhoneNumber}}
                                </td>
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
                                <td>
                                    <input class="form-check-input" type="checkbox" wire:model.live="checkBox" value="{{$data->id}}" id="flexCheckDefault{{$data->id}}" style="font-size: 18px; cursor: pointer" wire:loading.attr="disabled">
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div style="margin-top: 1%; margin-bottom: 5%;">
                        <button class="btn btn-success" wire:click="previousPage" style="width: 10%;">Previous</button>
                        <button class="btn btn-primary" wire:click="nextPage" style="width: 10%;">Next</button>
                    </div>
                </div>
            </div>
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

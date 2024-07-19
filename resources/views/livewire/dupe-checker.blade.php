<div>
    @include('components.layouts.profile')
    @include('components.layouts.navigation')
    @include('modal.click-settings')
    @include('modal.news-update.show-photo')
    @include('modal.dupe-checker.form')
    @include('modal.dupe-checker.saveOrNot')
    <div style="display: flex; width: 100%; margin-top: 105px;">
        <div style="width: 81%; margin-left: 19%;">
            <div class="container">
                <div>
                    <h6 style="margin-left: 2%; margin-top: 3%;">Dupe Checker</h6>
                </div>
                <hr>
                <div class="row">
                    <div class="col-6 ps-5 d-flex ms-2 mt-3">
                        <div class="w-50">
                            <input class="form-control" type="search" placeholder="Search" aria-label="Search" wire:model.live="search">
                        </div>
                        <div class="ms-4 pt-2">
                            @if(count($checkBox) == 1)
                                <i class="fa-solid fa-pen-to-square ms-3" style="cursor: pointer" title="Edit" wire:click="edit" data-bs-toggle="modal" data-bs-target="#edit"></i>
                                <i class="fa-solid fa-trash ms-3 text-danger" style="cursor: pointer" title="Delete" wire:click="delete" wire:confirm="Are you sure you want to delete?"></i>
                            @elseif(count($checkBox) > 1)
                                <i class="fa-solid fa-trash ms-3 text-danger" style="cursor: pointer;" title="Delete" wire:click="delete" wire:confirm="Are you sure you want to delete?"></i>
                            @endif
                        </div>
                    </div>
                    <div class="col-3">

                    </div>
                    <div class="col-3">

                    </div>
                </div>
                <div style="font-size: 14px; margin-top: 15px;"  class="px-5">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col">Date</th>
                            <th scope="col">Agent</th>
                            <th scope="col">Case type</th>
                            <th scope="col">Claimant</th>
                            <th scope="col">Injured party</th>
                            <th scope="col">Phone number</th>
                            <th scope="col">Alt. Phone number</th>
                            <th scope="col">Campaign</th>
                            <th scope="col">Coach</th>
                            <th scope="col">Remarks</th>
                            <th scope="col">Result</th>
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
                                <td>
                                    {{$data->caseType}}
                                </td>
                                @if($data->caseType == "self")
                                    <td>

                                    </td>
                                    <td>
                                        {{$data->injuredParty}}
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
                                    {{$data->coach}}
                                </td>
                                <td>
                                    {{$data->remarks}}
                                </td>
                                <td>
                                    {{ucfirst($data->result)}}
                                </td>
                                <td>
                                    <input class="form-check-input" type="checkbox" wire:model.live="checkBox" value="{{$data->id}}" id="flexCheckDefault{{$data->id}}" style="font-size: 18px; cursor: pointer">
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('partial.header')
    @script
    <script>
        $wire.on('dupeSubmitted', () => {
            $('#btn123456').click();
        });
    </script>
    @endscript
</div>

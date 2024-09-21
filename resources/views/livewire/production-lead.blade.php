<div>
    @include('components.layouts.profile')
    @include('components.layouts.navigation')
    @include('modal.click-settings')
    @include('modal.news-update.show-photo')
    @include('modal.Notes.add')
    @include('modal.Notes.edit')
    @include('modal.dupe-checker.viewDetail')
    <div style="display: flex; width: 100%; margin-top: 105px;">
        <div style="width: 81%; margin-left: 19%;">
            <div class="container">
                <div>
                    <h6 style="margin-left: 2%; margin-top: 3%;">MY PRODUCTION LEAD</h6>
                </div>
                <hr>
                <div style="display: flex;">
                    <div style="margin-left: 3%;">
                        <p>{{ucwords($agentName)}}</p>
                    </div>
                    <div style="width: 25%; margin-left: 3%;">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" wire:model.live="search">
                    </div>
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
</div>

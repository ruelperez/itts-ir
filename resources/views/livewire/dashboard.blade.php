<div>
    @include('modal.click-settings')
    @include('modal.news-update.show-photo')
    @include('modal.dashboard.anounce')
    @include('modal.dashboard.saveOrNot')
    @include('modal.dashboard.click-data')
    @include('modal.dashboard.removedOrUpdate')
    <div class="container">
        <div class="row">
            <div class="col-lg-5 pb-3" style="background-color: #2F4F4F">
                <div style="margin-top: 20px;color: white; text-align: center;">
                    <h4>ANNOUNCEMENT</h4>
                </div>
                @if($authorizer)
                    <i class="fa-solid fa-circle-plus" style="font-size: 20px; cursor: pointer; color: white;" data-bs-toggle="modal" data-bs-target="#add"></i>
                @endif
                <hr style="color: white">
                @foreach($announceData as $data)
                    <div style="color: black; background-color: #F5F5F5; @if($authorizer) cursor: pointer @endif" class="rounded border border-dark px-3 py-2" @if($authorizer) data-bs-toggle="modal" data-bs-target="#clickData" wire:click="clickData({{$data->id}})" @endif>
                        <div class="fw-light text-end mb-1"><small>{{$data->updated_at->format('M-d-Y')}}</small></div>
                        <div class="text-center py-2 px-2" style="background-color: #2E8B57;">
                            <h5 class="text-white">{{ucwords($data->title)}}</h5>
                        </div>
                        <div class="px-2 mt-2">
                            <p style="white-space: pre-line;" class="text-break">{{ucfirst($data->text)}}</p>
                        </div>
                    </div>
                    <hr style="color: white">
                @endforeach
            </div>
            <div class="col-lg-7 pb-3 text-center">
                <div><h3>{{$monthView}} Top Performer</h3></div>
                <div class="table-responsive mt-lg-4" style="font-size: 13px">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">Rank</th>
                            <th scope="col">Agent</th>
                            <th scope="col">Sale</th>
                            <th scope="col">Submission</th>
                            <th scope="col">QA</th>
                            <th scope="col">Attendance</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($performer_data as $data)
                            <tr onmouseover="hoverStaff({{$data->id}})" onmouseout="hoverOutStaff({{$data->id}})" class="ngh">
                                <td>
                                    <div class="profile-picture-staff">
                                        <img src="{{asset('photos/photos/'.$data->user->photo)}}" alt="Profile Picture">
                                    </div>
                                </td>
                                <td>
                                    {{$data->rank}}
                                </td>
                                <td class="text-capitalize" >
                                    {{$data->fullname}}
                                </td>
                                <td>
                                    {{$data->sale}}
                                </td>
                                <td>
                                    {{$data->submission}}
                                </td>
                                <td>
                                    {{$data->qa}}
                                </td>
                                <td>
                                    {{$data->attendance}}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <button id="btn123" data-bs-toggle="modal" data-bs-target="#loading" style="display: none"></button>
    <button id="btn456" data-bs-toggle="modal" data-bs-target="#removedOrUpdate" style="display: none"></button>
{{--    <button wire:click="click">do not click</button>--}}
    @script
    <script>
        $wire.on('subSubmitted', () => {
            $('#addClose').click();
            $('#btn123').click();
        });
        $wire.on('remOrUp', () => {
            $('#resClose').click();
            $('#btn456').click();
        });
    </script>
    @endscript
</div>

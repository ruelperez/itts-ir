<div>
    @include('components.layouts.profile')
    @include('components.layouts.navigation')
    @include('modal.click-settings')
    @include('modal.news-update.show-photo')
    @include('modal.dtr_record.dtrRecord')
    <div style="display: flex; width: 100%; margin-top: 105px;">
        <div style="width: 81%; margin-left: 19%;">
            <div class="container">
                <div>
                    <h6 style="margin-left: 2%; margin-top: 3%;">DTR RECORD</h6>
                </div>
                <div style="margin-left: 4%; margin-top: 2%;">
                    <h6>{{$dtrFullName}}</h6>
                </div>
                <div style="margin-top: 2%; width: 80%; margin-left: 4%; display: flex">
                    <input type="text" class="form-control" placeholder="Year" wire:model.live="year" style="width: 15%;">
{{--                    <select class="form-select" aria-label="Default select example" wire:model.live="month" style="width: 15%;">--}}
{{--                        <option value="Jan">January</option>--}}
{{--                        <option value="Feb">February</option>--}}
{{--                        <option value="Mar">March</option>--}}
{{--                        <option value="Apr">April</option>--}}
{{--                        <option value="May">May</option>--}}
{{--                        <option value="Jun">June</option>--}}
{{--                        <option value="Jul">July</option>--}}
{{--                        <option value="Aug">August</option>--}}
{{--                        <option value="Sept">September</option>--}}
{{--                        <option value="Oct">October</option>--}}
{{--                        <option value="Nov">November</option>--}}
{{--                        <option value="Dec">December</option>--}}
{{--                    </select>--}}
                    <select class="form-select" aria-label="Default select example" wire:model.live="month" style="width: 15%; margin-left: 1%;">
                        <option value="01">January</option>
                        <option value="02">February</option>
                        <option value="03">March</option>
                        <option value="04">April</option>
                        <option value="05">May</option>
                        <option value="06">June</option>
                        <option value="07">July</option>
                        <option value="08">August</option>
                        <option value="09">September</option>
                        <option value="10">October</option>
                        <option value="11">November</option>
                        <option value="12">December</option>
                    </select>
                    <select class="form-select" aria-label="Default select example" wire:model.live="week" style="width: 15%; margin-left: 1%;">
                        <option value="1">Week 1</option>
                        <option value="2">Week 2</option>
                        <option value="3">Week 3</option>
                        <option value="4">Week 4</option>
                    </select>
                </div>
                <div style="margin-left: 4%; margin-top: 2%; width: 92%;">
                    <div style="margin-left: auto; width: 120px; margin-bottom: 1%; cursor: pointer" onclick="location.href = '/itts/save-eod/{{$otherUserID}}/{{$week}}';">
                        <i class="fa-solid fa-file-pdf" style="color: #0c63e4; font-size: 22px; margin-right: 1%;"></i> Save as OED
                    </div>
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col">Date</th>
                            <th scope="col">Day</th>
                            <th scope="col">Time in</th>
                            <th scope="col">Time out</th>
                            <th scope="col">Time in</th>
                            <th scope="col">Time out</th>
                            <th scope="col">Total time</th>
                            <th scope="col">Task</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($dtrData as $data)
                            @if(Carbon\Carbon::parse($data->in)->format('Y') == $year and Carbon\Carbon::parse($data->in)->format('m') == $month)
                                <tr>
                                    <td>{{Carbon\Carbon::parse($data->in)->format('M/d/Y')}}</td>
                                    <th scope="row">@if($data->in == null) @else {{Carbon\Carbon::parse($data->in)->format('D') }} @endif</th>
                                    <td>@if($data->in == null) @else {{Carbon\Carbon::parse($data->in)->format('h:i A') }} @endif</td>
                                    <td>@if($data->out == null) @else {{Carbon\Carbon::parse($data->out)->format('h:i A') }} @endif</td>
                                    <td>@if($data->in2 == null) @else {{Carbon\Carbon::parse($data->in2)->format('h:i A') }} @endif</td>
                                    <td>@if($data->out2 == null) @else {{Carbon\Carbon::parse($data->out2)->format('h:i A') }} @endif</td>
                                    <td>
                                        @php
                                            $hours = floor($data->minute / 60);
                                            $totalHours = floor($hours + $data->hour);
                                            $remainingMinutes = $data->minute % 60;
                                            $result = $totalHours . ':' . $remainingMinutes;
                                        @endphp
                                        {{$result}}
                                    </td>
                                    <td>
                                        <i class="fa-solid fa-list-check" style="margin-right: 3%; cursor: pointer" data-bs-toggle="modal" data-bs-target="#taskRecord" wire:click="clickTask({{$data->id}})"></i>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('partial.header')
</div>

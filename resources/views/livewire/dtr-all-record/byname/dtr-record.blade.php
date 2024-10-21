<div>
    @include('modal.news-update.show-photo')
    @include('modal.dtr_record.dtrRecord')
    <div>
        <h6>DTR RECORD</h6>
    </div>
    <div class="mt-3 mt-lg-4">
        <h6>{{$dtrFullName}}</h6>
    </div>
    <div class="row mt-3">
        <div class="col-md-4 col-xl-3">
            <input type="text" class="form-control" placeholder="Year" wire:model.live="year">
        </div>
        <div class="mt-2 mt-md-0 col-md-4 col-xl-3">
            <select class="form-select" aria-label="Default select example" wire:model.live="month">
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
        </div>
        <div class="mt-2 mt-md-0 col-md-4 col-xl-3">
            <select class="form-select" aria-label="Default select example" wire:model.live="week">
                <option value="all">Week (1 - 5)</option>
                <option value="1">Week 1</option>
                <option value="2">Week 2</option>
                <option value="3">Week 3</option>
                <option value="4">Week 4</option>
                <option value="5">Week 5</option>
            </select>
        </div>
    </div>
    <div class="mt-4 text-md-end mt-lg-5">
        <i class="fa-solid fa-file-pdf icon-pdf" onclick="window.open('/pdf/eod/{{$otherUserID}}/{{$year}}/{{$month}}/{{$week}}', '_blank');"></i>
    </div>
    <div class="text-center">
        <div class="spinner-border" role="status" wire:loading>
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
    <div class="table-responsive mt-2 mt-xl-3">
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
                @if($authorizer)
                    <th scope="col">Task</th>
                @endif
            </tr>
            </thead>
            <tbody>
            @foreach($dtrData as $data)
{{--                @if(Carbon\Carbon::parse($data->in)->format('Y') == $year and Carbon\Carbon::parse($data->in)->format('m') == $month)--}}
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
                        @if($authorizer)
                            <td>
                                <i class="fa-solid fa-list-check" style="margin-right: 3%; cursor: pointer" data-bs-toggle="modal" data-bs-target="#taskRecord" wire:click="clickTask({{$data->id}})"></i>
                            </td>
                        @endif
                    </tr>
{{--                @endif--}}
            @endforeach
            </tbody>
        </table>
    </div>
</div>

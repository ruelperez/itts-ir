<div>
    @include('modal.news-update.show-photo')
    @include('modal.dtr_record.dtrRecord')
    <div class="mb-4">
        <h6>DTR PER SHIFT</h6>
    </div>
    <div class="row">
        <div class="col-12 col-sm-6 col-lg-3 col-xl-3">
            <input type="text" class="form-control" placeholder="Year" wire:model="year">
        </div>
        <div class="col-12 col-sm-6 col-lg-3 col-xl-3 mt-2 mt-sm-0">
            <select class="form-select" aria-label="Default select example" wire:model="month">
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
        <div class="col-12 col-sm-6 col-lg-3 col-xl-3 mt-2 mt-lg-0">
            <select class="form-select" aria-label="Default select example" wire:model="day">
                @for($n=1; $n<=31; $n++)
                    <option value={{$n}}>{{$n}}</option>
                @endfor
            </select>
        </div>
        <div class="col-12 col-sm-6 col-lg-3 col-xl-3 mt-2 mt-lg-0">
            <select class="form-select" aria-label="Default select example" wire:model="role">
                <option value="all">All</option>
                <option value="Agent">Agent</option>
                <option value="Admin">Admin</option>
                <option value="task executor">Task Executor</option>
            </select>
        </div>
        <div class="text-start mt-4 col-4">
            <i class="fa-solid fa-rotate" style="font-size: 20px; cursor: pointer" id="generateButton"></i>
        </div>
    </div>
    <div class="row mt-4 mt-xl-5">
        <div class="col-6">
            <b style="font-size: 15px; ">{{$month}}-{{$day}}-{{$year}}</b>
        </div>
        <div class="col-6 text-end">
            <i class="fa-solid fa-file-pdf icon-pdf" onclick="window.open('/pdf/daily-shift/{{$month}}/{{$day}}/{{$year}}/{{$role}}', '_blank');"></i>
        </div>
    </div>
    <div class="table-responsive mt-4">
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">Fullname</th>
{{--                            <th scope="col">Date</th>--}}
{{--                            <th scope="col">Day</th>--}}
                <th scope="col">Time in</th>
                <th scope="col">Time out</th>
                <th scope="col">Time in</th>
                <th scope="col">Time out</th>
{{--                <th scope="col">Total hour</th>--}}
{{--                <th scope="col">Site</th>--}}
                @if($role == "task executor")
                    <th scope="col">Task</th>
                @endif

            </tr>
            </thead>
            <tbody>
            @foreach($dtrData as $data)
                @if($role == "all")
                    @if(Carbon\Carbon::parse($data->in)->format('Y') == $year and Carbon\Carbon::parse($data->in)->format('m') == $month and Carbon\Carbon::parse($data->in)->format('d') == $day)
                        <tr>
                            <td>{{ucwords($data->fullname)}}</td>
                            {{--                                    <td>{{Carbon\Carbon::parse($data->in)->format('M/d/Y')}}</td>--}}
                            {{--                                    <th scope="row">@if($data->in == null) @else {{Carbon\Carbon::parse($data->in)->format('D') }} @endif</th>--}}
                            <td>@if($data->in == null) @else {{Carbon\Carbon::parse($data->in)->format('h:i A') }} @endif</td>
                            <td>@if($data->out == null) @else {{Carbon\Carbon::parse($data->out)->format('h:i A') }} @endif</td>
                            <td>@if($data->in2 == null) @else {{Carbon\Carbon::parse($data->in2)->format('h:i A') }} @endif</td>
                            <td>@if($data->out2 == null) @else {{Carbon\Carbon::parse($data->out2)->format('h:i A') }} @endif</td>
{{--                            <td>--}}
{{--                                @php--}}
{{--                                    $hours = floor($data->minute / 60);--}}
{{--                                    $totalHours = floor($hours + $data->hour);--}}
{{--                                    $remainingMinutes = $data->minute % 60;--}}
{{--                                    $result = $totalHours . ':' . $remainingMinutes;--}}
{{--                                @endphp--}}
{{--                                {{$result}}--}}
{{--                            </td>--}}
{{--                            <td>--}}
{{--                               {{ucfirst($data->branch)}}--}}
{{--                            </td>--}}
                        </tr>
                    @endif
                @elseif($role == "Agent")
                    @foreach($userID as $df)
                        @if($df->id == $data->user_id)
                            @if(Carbon\Carbon::parse($data->in)->format('Y') == $year and Carbon\Carbon::parse($data->in)->format('m') == $month and Carbon\Carbon::parse($data->in)->format('d') == $day)
                                <tr>
                                    <td>{{ucwords($data->fullname)}}</td>
                                    {{--                                    <td>{{Carbon\Carbon::parse($data->in)->format('M/d/Y')}}</td>--}}
                                    {{--                                    <th scope="row">@if($data->in == null) @else {{Carbon\Carbon::parse($data->in)->format('D') }} @endif</th>--}}
                                    <td>@if($data->in == null) @else {{Carbon\Carbon::parse($data->in)->format('h:i A') }} @endif</td>
                                    <td>@if($data->out == null) @else {{Carbon\Carbon::parse($data->out)->format('h:i A') }} @endif</td>
                                    <td>@if($data->in2 == null) @else {{Carbon\Carbon::parse($data->in2)->format('h:i A') }} @endif</td>
                                    <td>@if($data->out2 == null) @else {{Carbon\Carbon::parse($data->out2)->format('h:i A') }} @endif</td>
{{--                                    <td>--}}
{{--                                        @php--}}
{{--                                            $hours = floor($data->minute / 60);--}}
{{--                                            $totalHours = floor($hours + $data->hour);--}}
{{--                                            $remainingMinutes = $data->minute % 60;--}}
{{--                                            $result = $totalHours . ':' . $remainingMinutes;--}}
{{--                                        @endphp--}}
{{--                                        {{$result}}--}}
{{--                                    </td>--}}
{{--                                    <td>--}}
{{--                                        {{ucfirst($data->branch)}}--}}
{{--                                    </td>--}}
                                </tr>
                            @endif
                        @endif
                    @endforeach
                @elseif($role == "Admin")
                    @foreach($userID as $df)
                        @if($df->id == $data->user_id)
                            @if(Carbon\Carbon::parse($data->in)->format('Y') == $year and Carbon\Carbon::parse($data->in)->format('m') == $month and Carbon\Carbon::parse($data->in)->format('d') == $day)
                                <tr>
                                    <td>{{ucwords($data->fullname)}}</td>
                                    {{--                                    <td>{{Carbon\Carbon::parse($data->in)->format('M/d/Y')}}</td>--}}
                                    {{--                                    <th scope="row">@if($data->in == null) @else {{Carbon\Carbon::parse($data->in)->format('D') }} @endif</th>--}}
                                    <td>@if($data->in == null) @else {{Carbon\Carbon::parse($data->in)->format('h:i A') }} @endif</td>
                                    <td>@if($data->out == null) @else {{Carbon\Carbon::parse($data->out)->format('h:i A') }} @endif</td>
                                    <td>@if($data->in2 == null) @else {{Carbon\Carbon::parse($data->in2)->format('h:i A') }} @endif</td>
                                    <td>@if($data->out2 == null) @else {{Carbon\Carbon::parse($data->out2)->format('h:i A') }} @endif</td>
{{--                                    <td>--}}
{{--                                        @php--}}
{{--                                            $hours = floor($data->minute / 60);--}}
{{--                                            $totalHours = floor($hours + $data->hour);--}}
{{--                                            $remainingMinutes = $data->minute % 60;--}}
{{--                                            $result = $totalHours . ':' . $remainingMinutes;--}}
{{--                                        @endphp--}}
{{--                                        {{$result}}--}}
{{--                                    </td>--}}
{{--                                    <td>--}}
{{--                                        {{ucfirst($data->branch)}}--}}
{{--                                    </td>--}}
                                </tr>
                            @endif
                        @endif
                    @endforeach
                @else
                    @foreach($userID as $df)
                        @if($df->id == $data->user_id)
                            @if(Carbon\Carbon::parse($data->in)->format('Y') == $year and Carbon\Carbon::parse($data->in)->format('m') == $month and Carbon\Carbon::parse($data->in)->format('d') == $day)
                                <tr>
                                    <td>{{ucwords($data->fullname)}}</td>
                                    {{--                                    <td>{{Carbon\Carbon::parse($data->in)->format('M/d/Y')}}</td>--}}
                                    {{--                                    <th scope="row">@if($data->in == null) @else {{Carbon\Carbon::parse($data->in)->format('D') }} @endif</th>--}}
                                    <td>@if($data->in == null) @else {{Carbon\Carbon::parse($data->in)->format('h:i A') }} @endif</td>
                                    <td>@if($data->out == null) @else {{Carbon\Carbon::parse($data->out)->format('h:i A') }} @endif</td>
                                    <td>@if($data->in2 == null) @else {{Carbon\Carbon::parse($data->in2)->format('h:i A') }} @endif</td>
                                    <td>@if($data->out2 == null) @else {{Carbon\Carbon::parse($data->out2)->format('h:i A') }} @endif</td>
{{--                                    <td>--}}
{{--                                        @php--}}
{{--                                            $hours = floor($data->minute / 60);--}}
{{--                                            $totalHours = floor($hours + $data->hour);--}}
{{--                                            $remainingMinutes = $data->minute % 60;--}}
{{--                                            $result = $totalHours . ':' . $remainingMinutes;--}}
{{--                                        @endphp--}}
{{--                                        {{$result}}--}}
{{--                                    </td>--}}
                                    {{--                                    <td>--}}
                                    {{--                                        {{ucfirst($data->branch)}}--}}
                                    {{--                                    </td>--}}
                                    <td>
                                        <i class="fa-solid fa-list-check" style="margin-right: 3%; cursor: pointer" data-bs-toggle="modal" data-bs-target="#taskRecord" wire:click="clickTask({{$data->id}})"></i>
                                    </td>
                                </tr>
                            @endif
                        @endif
                    @endforeach
                @endif
            @endforeach
            </tbody>
        </table>
    </div>
    @script
    <script>
        $wire.on('loadingsss', (event) => {
                JsLoadingOverlay.hide();
        });
    </script>
    @endscript
</div>
@push('js')
    <script>
        document.getElementById('generateButton').addEventListener('click', function () {
            // Show loading overlay
            JsLoadingOverlay.show({
                overlayBackgroundColor: '#666666',
                overlayOpacity: 0.6,
                spinnerIcon: 'ball-pulse',  // Choose your spinner icon
                spinnerColor: '#ffffff',
                spinnerSize: '2x'
            });

            Livewire.dispatch('gen')
        });
    </script>
@endpush



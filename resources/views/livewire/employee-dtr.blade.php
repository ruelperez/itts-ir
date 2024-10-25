<div>
    @include('modal.click-settings')
    @include('modal.news-update.show-photo')
    @include('modal.dtr.resetDtr')
    @include('modal.dtr.task')
    @include('modal.dtr.setTime')
    <div>
        <h5>DTR</h5>
        @if($authorizer)
            <div class="row">
                <div class="col-lg-3 col-xl-6">

                </div>
                <div class="col-12 col-sm-4 col-md-4 col-lg-3 col-xl-2">
                    <button type="button" class="btn btn-dark w-100" onclick="location.href = '/dtr/all-record/dtr-name';"><i class="fa-solid fa-arrows-to-circle" style="margin-right: 8px;"></i>Record</button>
                </div>
                <div class="col-12 col-sm-4 col-md-4 mt-1 mt-sm-0 col-lg-3 col-xl-2" data-bs-toggle="modal" data-bs-target="#setTime">
                    <button type="button" class="btn btn-primary w-100"><i class="fa-regular fa-clock" style="margin-right: 8px; font-size: 20px;"></i>Schedule</button>
                </div>
                <div class="col-12 col-sm-4 col-md-4 mt-1 mt-sm-0 col-lg-3 col-xl-2">
                    <button type="button" class="btn btn-secondary w-100" @if(count($dtrAll) != 0) style="cursor: pointer" data-bs-toggle="modal" data-bs-target="#resetDtr" @endif >@if(count($dtrAll) == 0) <i class="fa-solid fa-check" style="color: green;font-size: 20px;"></i>  @else <i class="fa-solid fa-rotate" style="font-size: 20px;" type="button"></i> @endif Reset DTR</button>
                </div>
            </div>
            <hr>
        @endif
        <div>
            <div style="display: flex;
            justify-content: center; /* Horizontally center */
            align-items: center; /* Vertically center */@if($dtr_data == null )  @elseif($dtr_data->in != null and $dtr_data->out != null) display: none @endif">
                <div class="py-5" style=" width: 120px;
            height: 120px;
            background-color: #4CAF50; /* Any background color */
            border-radius: 50%; /* Makes it a circle */
            justify-content: center;
            align-items: center;
            text-align: center;
            color: white;
            box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.9);
            /*padding-top: 20px;*/@if($dtr_data == null or $dtr_data->in == null) color: white; cursor: pointer @endif" @if($dtr_data == null or $dtr_data->in == null) wire:click="in" @endif id="dtr-in-btn"><h5>Time In</h5></div>
            </div>
            <div style="display: flex;
            justify-content: center; /* Horizontally center */
            align-items: center; /* Vertically center */@if($dtr_data == null ) display: none @elseif($dtr_data->in != null and $dtr_data->out != null)  @else display: none @endif">
                <div class="py-5" style=" width: 120px;
            height: 120px;
            background-color: #4CAF50; /* Any background color */
            border-radius: 50%; /* Makes it a circle */
            justify-content: center;
            align-items: center;
            text-align: center;
            color: white;
            box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.9);
            /*padding-top: 20px;*/@if($dtr_data == null) display: none @elseif($dtr_data->in != null and $dtr_data->out != null and $dtr_data->in2 != null) color: black; @elseif($dtr_data->in != null and $dtr_data->out != null ) color: white; cursor: pointer @endif" @if($dtr_data == null) @elseif($dtr_data->in != null and $dtr_data->out != null and $dtr_data->in2 != null) wire:click="needToReset"  @elseif($dtr_data->in != null and $dtr_data->out != null) wire:click="in2" @endif id="dtr-in2-btn"><h5>Time In</h5> <p style="font-size: 14px;">(After lunch)</p></div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-sm-6 col-lg-4 col-xl-3" style="margin-top: 15px">
                <input class="form-control" placeholder="User id" type="text" wire:model="designated_id">
            </div>
        </div>
        <div style="margin-top: 5px">
            @if (session('good'))
                <p style="color: blue; text-align: center; font-size: 19px;">{{ session('good') }}</p>
            @elseif(session('bad'))
                <p style="color: red; text-align: center; font-size: 17px;">{{ session('bad') }}</p>
            @endif
        </div>
            <div class="table-responsive emp-dtr-table">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Day</th>
                        <th scope="col">In</th>
                        <th scope="col">Out</th>
                        <th scope="col">In</th>
                        <th scope="col">Out</th>
                        <th scope="col">Total</th>
                        @if($authorizer2) <th scope="col">Task</th> @endif
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($dtr_permanent_data as $data)
                        <tr>
                            <th disabled scope="row">@if($data->in == null) @else {{Carbon\Carbon::parse($data->in)->format('D') }} @endif</th>
                            <td disabled>@if($data->in == null) @else {{Carbon\Carbon::parse($data->in)->format('h:i A') }} @endif</td>
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
                            @if($authorizer2)
                                <td>
                                    <i class="fa-solid fa-list-check" style="margin-right: 3%; cursor: pointer" data-bs-toggle="modal" data-bs-target="#task" wire:click="clickTask({{$data->id}})"></i>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
    </div>
    @script
    <script>
        $wire.on('remove-loading', (event) => {
            JsLoadingOverlay.hide();
        });
        $wire.on('remove-loading-need-to-reset', (event) => {
            JsLoadingOverlay.hide();
            Swal.fire({
                title: 'Please reset the DTR',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        });
    </script>
    @endscript
</div>
@push('js')
    <script>
        document.getElementById('dtr-in-btn').addEventListener('click', function () {
            JsLoadingOverlay.show({
                overlayBackgroundColor: '#666666',
                overlayOpacity: 0.6,
                spinnerIcon: 'ball-pulse',  // Choose your spinner icon
                spinnerColor: '#ffffff',
                spinnerSize: '2x'
            });

        });

        document.getElementById('dtr-in2-btn').addEventListener('click', function () {
            JsLoadingOverlay.show({
                overlayBackgroundColor: '#666666',
                overlayOpacity: 0.6,
                spinnerIcon: 'ball-pulse',  // Choose your spinner icon
                spinnerColor: '#ffffff',
                spinnerSize: '2x'
            });

        });
    </script>
@endpush

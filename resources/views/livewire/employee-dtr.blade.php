<div>
    @include('modal.news-update.show-photo')
    @include('modal.dtr.resetDtr')
    @include('modal.dtr.task')
    @include('modal.dtr.setTime')
    <div>
        <h5>DTR</h5>
        @if($authorizer)
            <div class="row mt-4 justify-content-end">
                <div class="col-sm-4 col-md-4 col-lg-3 col-xl-2">
                    <button type="button" class="btn btn-dark w-100" onclick="location.href = '/dtr/all-record/dtr-name';"><i class="fa-solid fa-arrows-to-circle" style="margin-right: 8px;"></i>Record</button>
                </div>
                <div class="col-12 col-sm-4 col-md-4 mt-1 mt-sm-0 col-lg-3 col-xl-2" >
                    <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#setTime" wire:click="clickSchedule"><i class="fa-regular fa-clock" style="margin-right: 8px; font-size: 20px;"></i>Schedule</button>
                </div>
                <div class="col-12 col-sm-4 col-md-4 mt-1 mt-sm-0 col-lg-3 col-xl-2">
                    <button type="button" class="btn btn-secondary w-100" @if(count($dtrAll) != 0) style="cursor: pointer" data-bs-toggle="modal" data-bs-target="#resetDtr" @endif >@if(count($dtrAll) == 0) <i class="fa-solid fa-check" style="color: green;font-size: 20px;"></i>  @else <i class="fa-solid fa-rotate" style="font-size: 20px;" type="button"></i> @endif Reset DTR</button>
                </div>
            </div>
            <hr class="mt-4">
        @endif
            <div class="table-responsive emp-dtr-table mt-4">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Day</th>
                        <th scope="col">In</th>
                        <th scope="col">Out</th>
                        <th scope="col">In</th>
                        <th scope="col">Out</th>
{{--                        <th scope="col">Total</th>--}}
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
                            <td>@if($data->isEarlyOut == 1)<b style="color: white; background-color: red;" class="px-2">Early out</b> @endif @if($data->is_edited == 1)<b style="color: blue" class="fst-italic">(Adjusted)@endif</td>
{{--                            <td>--}}
{{--                                @php--}}
{{--                                    $hours = floor($data->minute / 60);--}}
{{--                                    $totalHours = floor($hours + $data->hour);--}}
{{--                                    $remainingMinutes = $data->minute % 60;--}}
{{--                                    $result = $totalHours . ':' . $remainingMinutes;--}}
{{--                                @endphp--}}
{{--                                {{$result}}--}}
{{--                            </td>--}}
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
        $wire.on('success', () => {
            Swal.fire({
                title: 'SUCCESS!',
                text: 'Successfully Saved.',
                icon: 'success',
                allowOutsideClick: false, // Prevent closing by clicking outside
                allowEscapeKey: false // Prevent closing with the escape key
            }).then((result) => {
                if (result.isConfirmed) {
                    location.reload();
                }
            });
        });

        $wire.on('failed', () => {
            Swal.fire({
                title: 'FAILED!',
                text: '',
                icon: 'error',
                allowOutsideClick: false, // Prevent closing by clicking outside
                allowEscapeKey: false // Prevent closing with the escape key
            }).then((result) => {
                if (result.isConfirmed) {
                    location.reload();
                }
            });
        });
        $wire.on('dtrNull', (de) => {
            Swal.fire({
                title: 'FAILED!',
                text: 'Have white space on '+ de,
                icon: 'error',
                allowOutsideClick: false, // Prevent closing by clicking outside
                allowEscapeKey: false // Prevent closing with the escape key
            }).then((result) => {
                if (result.isConfirmed) {
                    location.reload();
                }
            });
        });
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



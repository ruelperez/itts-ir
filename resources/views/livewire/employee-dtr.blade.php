<div>
    @include('modal.click-settings')
    @include('modal.news-update.show-photo')
    @include('modal.dtr.resetDtr')
    @include('modal.dtr.task')
    @include('modal.dtr.setTime')
    <div>
        <h5>DTR</h5>
        @if($position == "Super Admin")
            <div class="row">
                <div class="col-lg-3 col-xl-6">

                </div>
                <div class="col-12 col-sm-4 col-md-4 col-lg-3 col-xl-2">
                    <button type="button" class="btn btn-dark w-100" onclick="location.href = '/dtr-name';"><i class="fa-solid fa-arrows-to-circle" style="margin-right: 8px;"></i>Record</button>
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
        <div wire:loading.flex class="absolute inset-0 bg-gray-200 opacity-75"></div>

        <div class="center-dtr-btn" style="@if($dtr_data == null )  @elseif($dtr_data->in != null and $dtr_data->out != null) display: none @endif">
            <div class="dtr-btn py-5" style="@if($dtr_data == null or $dtr_data->in == null) color: white; cursor: pointer @endif" @if($dtr_data == null or $dtr_data->in == null) wire:click="in" wire:loading.attr="disabled" @endif ><h5>Time In</h5></div>
{{--                    <div style="border-radius: 100px; background-color: #6B8E23; padding: 2%; width: 9%; text-align: center; margin-left: 1%; @if($dtr_data == null or $dtr_data->in == null) color: black; @elseif($dtr_data->in != null) color: white; cursor: pointer @endif" @if($dtr_data == null or $dtr_data->in == null) @elseif($dtr_data->in != null) wire:click="out" @endif ><h5>Time Out</h5></div>--}}
        </div>
        <div class="center-dtr-btn" style="@if($dtr_data == null ) display: none @elseif($dtr_data->in != null and $dtr_data->out != null)  @else display: none @endif">
            <div class="dtr-btn py-5" style="@if($dtr_data == null) display: none @elseif($dtr_data->in != null and $dtr_data->out != null and $dtr_data->in2 != null) color: black; @elseif($dtr_data->in != null and $dtr_data->out != null ) color: white; cursor: pointer @endif" @if($dtr_data == null) @elseif($dtr_data->in != null and $dtr_data->out != null and $dtr_data->in2 != null)  @elseif($dtr_data->in != null and $dtr_data->out != null) wire:click="in2" wire:loading.attr="disabled" @endif><h5>Time In</h5> <p style="font-size: 14px;">(After lunch)</p></div>
{{--                    <div style="border-radius: 100px; background-color: #6B8E23; padding: 2%; width: 9%; text-align: center; margin-left: 1%;  @if($dtr_data == null) display: none @elseif($dtr_data->in != null and $dtr_data->out != null and $dtr_data->in2 != null and $dtr_data->out2 != null) color: black; @elseif($dtr_data->in != null and $dtr_data->out != null and $dtr_data->in2 != null) color: white; cursor: pointer @endif" @if($dtr_data == null) @elseif($dtr_data->in != null and $dtr_data->out != null and $dtr_data->in2 != null and $dtr_data->out2 != null)  @elseif($dtr_data->in != null and $dtr_data->out != null and $dtr_data->in2 != null) wire:click="out2"  @endif><h5>Time Out</h5></div>--}}
        </div>
        <div style="margin-top: 15px" class="d-flex justify-content-center">
            <input class="form-control" placeholder="User id" type="text" style="width: 250px;" wire:model="designated_id">
            @error('designated_id') <span style="color: red; margin-left: 40%;">{{ $message }}</span> @enderror
        </div>
        <div style="margin-top: 15px">
            @if (session('good'))
                <p style="color: blue; text-align: center; font-size: 19px;">{{ session('good') }}</p>
            @elseif(session('bad'))
                <p style="color: red; text-align: center; font-size: 17px;">{{ session('bad') }}</p>
            @endif
        </div>
        <div wire:loading class="spinner-border spin" style="height: 55px; width: 55px; margin-left:47%; margin-top:5%; color: black">
            <span class="visually-hidden" style="color: black">Loading...</span>
        </div>
        <div class="row justify-content-center" style="margin-top: 30px;" wire:loading.remove>
            <div class="col-12 col-xl-8 col-lg-10">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Day</th>
                        <th scope="col">In</th>
                        <th scope="col">Out</th>
                        <th scope="col">In</th>
                        <th scope="col">Out</th>
                        <th scope="col">Total</th>
                        @if($position != "Agent") <th scope="col">Task</th> @endif
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
                            @if($position != "Agent")
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
    </div>
</div>

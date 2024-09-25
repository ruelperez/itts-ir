<div>
    @include('modal.click-settings')
    @include('modal.news-update.show-photo')
    @include('modal.dtr.resetDtr')
    @include('modal.dtr.task')
    @include('modal.dtr.setTime')
    <div class="border border-dark">
        <h6 style="margin-left: 2%; margin-top: 3%;">DTR</h6>
        @if($position == "Super Admin")
            <div class="row">
{{--                <div class="col-lg-">--}}

{{--                </div>--}}
                <div class="col-sm-4">
                    <button type="button" class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-4 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700" onclick="location.href = '/itts/9/dtr-name';"><i class="fa-solid fa-arrows-to-circle" style="margin-right: 8px; font-size: 20px;"></i>View all record</button>
                </div>
                <div class="col-md-4" data-bs-toggle="modal" data-bs-target="#setTime">
                    <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"><i class="fa-regular fa-clock" style="margin-right: 8px; font-size: 20px;"></i>Set time schedule</button>
                </div>
                <div class="col-md-4">
                    <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800" @if(count($dtrAll) != 0) style="cursor: pointer" data-bs-toggle="modal" data-bs-target="#resetDtr" @endif >@if(count($dtrAll) == 0) <i class="fa-solid fa-check" style="color: green;font-size: 20px; margin-left: 3%;"></i>  @else <i class="fa-solid fa-rotate" style="margin-right: 5%; font-size: 20px;" type="button"></i> @endif Reset DTR</button>
                </div>
            </div>
            <hr>
        @endif
        <div wire:loading.flex class="absolute inset-0 bg-gray-200 opacity-75"></div>

        <div style="display: flex; @if($dtr_data == null )  @elseif($dtr_data->in != null and $dtr_data->out != null) display: none @endif">
            <div style="border-radius: 100px; box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.9); background-color: #008000; padding: 2%; width: 9%; text-align: center; margin-left: 44%; @if($dtr_data == null or $dtr_data->in == null) color: white; cursor: pointer @endif" @if($dtr_data == null or $dtr_data->in == null) wire:click="in" wire:loading.attr="disabled" @endif ><h5>Time In</h5></div>
{{--                    <div style="border-radius: 100px; background-color: #6B8E23; padding: 2%; width: 9%; text-align: center; margin-left: 1%; @if($dtr_data == null or $dtr_data->in == null) color: black; @elseif($dtr_data->in != null) color: white; cursor: pointer @endif" @if($dtr_data == null or $dtr_data->in == null) @elseif($dtr_data->in != null) wire:click="out" @endif ><h5>Time Out</h5></div>--}}
        </div>
        <div style="display: flex; @if($dtr_data == null ) display: none @elseif($dtr_data->in != null and $dtr_data->out != null)  @else display: none @endif">
            <div style="border-radius: 100px; box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.9); background-color: #008000; padding: 2%; width: 11%; text-align: center; margin-left: 44%; @if($dtr_data == null) display: none @elseif($dtr_data->in != null and $dtr_data->out != null and $dtr_data->in2 != null) color: black; @elseif($dtr_data->in != null and $dtr_data->out != null ) color: white; cursor: pointer @endif" @if($dtr_data == null) @elseif($dtr_data->in != null and $dtr_data->out != null and $dtr_data->in2 != null)  @elseif($dtr_data->in != null and $dtr_data->out != null) wire:click="in2" wire:loading.attr="disabled" @endif><h5>Time In</h5> <p style="font-size: 14px;">(After lunch)</p></div>
{{--                    <div style="border-radius: 100px; background-color: #6B8E23; padding: 2%; width: 9%; text-align: center; margin-left: 1%;  @if($dtr_data == null) display: none @elseif($dtr_data->in != null and $dtr_data->out != null and $dtr_data->in2 != null and $dtr_data->out2 != null) color: black; @elseif($dtr_data->in != null and $dtr_data->out != null and $dtr_data->in2 != null) color: white; cursor: pointer @endif" @if($dtr_data == null) @elseif($dtr_data->in != null and $dtr_data->out != null and $dtr_data->in2 != null and $dtr_data->out2 != null)  @elseif($dtr_data->in != null and $dtr_data->out != null and $dtr_data->in2 != null) wire:click="out2"  @endif><h5>Time Out</h5></div>--}}
        </div>
        <div style="margin-top: 2%;">
            <input class="form-control" placeholder="User id" type="text" style="width: 20%; margin-left: 40%;" wire:model="designated_id">
            @error('designated_id') <span style="color: red; margin-left: 40%;">{{ $message }}</span> @enderror
            <div style="margin-top: 1%;">
                @if (session('good'))
                    <p style="color: blue; text-align: center; font-size: 19px;">{{ session('good') }}</p>
                @elseif(session('bad'))
                    <p style="color: red; text-align: center; font-size: 17px;">{{ session('bad') }}</p>
                @endif
            </div>
        </div>
        <div wire:loading class="spinner-border spin" style="height: 55px; width: 55px; margin-left:47%; margin-top:5%; color: black">
            <span class="visually-hidden" style="color: black">Loading...</span>
        </div>
        <div style="margin-top: 4%; width: 80%; margin-left: 10%;" wire:loading.remove>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Day</th>
                    <th scope="col">Time in</th>
                    <th scope="col">Time out</th>
                    <th scope="col">Time in</th>
                    <th scope="col">Time out</th>
                    <th scope="col">Total time</th>
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

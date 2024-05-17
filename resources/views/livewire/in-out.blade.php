<div>
    @include('modal.click-settings')
    @include('modal.news-update.show-photo')
    @include('modal.dtr.resetDtr')
    @include('modal.dtr.task')
    @include('modal.dtr.setTime')
    <div style="display: flex; width: 100%; margin-top: 135px;">
        <div style="width: 81%; margin-left: 19%;">
            <div class="container">
                <div>
                    <h5 style="margin-left: 2%; margin-top: 3%;">DTR</h5>
                    @if($position == "Super Admin")
                        <div style="display: flex; padding-right: 3%; padding-left: 3%;">
                            <div style="margin-left: auto; margin-right: 1%;">
                                <button type="button" class="btn btn-dark" onclick="location.href = '/itts/9/dtr-name';"><i class="fa-solid fa-arrows-to-circle" style="margin-right: 8px; font-size: 20px;"></i>View all record</button>
                            </div>
                            <div style="margin-right: 1%;" data-bs-toggle="modal" data-bs-target="#setTime">
                                <button type="button" class="btn btn-primary"><i class="fa-regular fa-clock" style="margin-right: 8px; font-size: 20px;"></i>Set time schedule</button>
                            </div>
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    Select to reset
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
{{--                                    <li @if(count($dtrData) != 0) style="cursor: pointer" wire:click="clickReset" wire:confirm="Are you sure you want to reset DTR button?" @endif><a class="dropdown-item"><p>Reset DTR button @if(count($dtrData) == 0) <i class="fa-solid fa-check" style="color: green;font-size: 20px; margin-left: 3%;"></i>  @else <i class="fa-solid fa-rotate" style="margin-left: 3%; font-size: 20px;" type="button"></i> @endif </p></a></li>--}}
                                    <li @if(count($dtrAll) != 0) style="cursor: pointer" data-bs-toggle="modal" data-bs-target="#resetDtr" @endif><a class="dropdown-item" > @if(count($dtrAll) == 0) <i class="fa-solid fa-check" style="color: green;font-size: 20px; margin-left: 3%;"></i>  @else <i class="fa-solid fa-rotate" style="margin-right: 5%; font-size: 20px;" type="button"></i> @endif Reset DTR </a></li>
                                </ul>
                            </div>
                        </div>
                        <hr>
                    @endif
                </div>
                <div wire:loading.flex class="absolute inset-0 bg-gray-200 opacity-75"></div>

                <div style="display: flex; @if($dtr_data == null )  @elseif($dtr_data->in != null and $dtr_data->out != null) display: none @endif">
                    <div style="border-radius: 100px; background-color: #008000; padding: 2%; width: 9%; text-align: center; margin-left: 44%; @if($dtr_data == null or $dtr_data->in == null) color: white; cursor: pointer @endif" @if($dtr_data == null or $dtr_data->in == null) wire:click="in" wire:loading.attr="disabled" @endif ><h5>Time In</h5></div>
{{--                    <div style="border-radius: 100px; background-color: #6B8E23; padding: 2%; width: 9%; text-align: center; margin-left: 1%; @if($dtr_data == null or $dtr_data->in == null) color: black; @elseif($dtr_data->in != null) color: white; cursor: pointer @endif" @if($dtr_data == null or $dtr_data->in == null) @elseif($dtr_data->in != null) wire:click="out" @endif ><h5>Time Out</h5></div>--}}
                </div>
                <div style="display: flex; @if($dtr_data == null ) display: none @elseif($dtr_data->in != null and $dtr_data->out != null)  @else display: none @endif">
                    <div style="border-radius: 100px; background-color: #008000; padding: 2%; width: 11%; text-align: center; margin-left: 44%; @if($dtr_data == null) display: none @elseif($dtr_data->in != null and $dtr_data->out != null and $dtr_data->in2 != null) color: black; @elseif($dtr_data->in != null and $dtr_data->out != null ) color: white; cursor: pointer @endif" @if($dtr_data == null) @elseif($dtr_data->in != null and $dtr_data->out != null and $dtr_data->in2 != null)  @elseif($dtr_data->in != null and $dtr_data->out != null) wire:click="in2" wire:loading.attr="disabled" @endif><h5>Time In</h5> <p style="font-size: 14px;">(After lunch)</p></div>
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
{{--                <div wire:loading wire:target="target" class="spinner-border" role="status">--}}
{{--                    <span class="visually-hidden">Loading...</span>--}}
{{--                </div>--}}
{{--                <div wire:loading wire:target="target">--}}
{{--                    <!-- Loading spinner or message -->--}}
{{--                    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">--}}
{{--                        <svg class="animate-spin h-8 w-8 text-gray-800" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">--}}
{{--                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>--}}
{{--                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V2.83a1 1 0 00-1.7-.7l-4.6 4.6a1 1 0 00-.3.7V12H4zm2 8a8 8 0 008-8h2.17a1 1 0 00.7-1.7l-4.6-4.6a1 1 0 00-.7-.3H4a8 8 0 000 16zm12-8a8 8 0 01-8 8v2.17a1 1 0 001.7.7l4.6-4.6a1 1 0 00.3-.7V12h2zm-2-8a8 8 0 00-8 8H2.83a1 1 0 00-.7 1.7l4.6 4.6a1 1 0 00.7.3H12a8 8 0 000-16z"></path>--}}
{{--                        </svg>--}}
{{--                    </div>--}}
{{--                </div>--}}
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
        <div style="width: 19%; background-color: #0077b6; position: fixed;top: 125px; left: 0; z-index: 1000; height: 100%;">
            @include('components.layouts.profile')
            @include('components.layouts.navigation')
        </div>
    </div>
    @include('partial.header')
</div>

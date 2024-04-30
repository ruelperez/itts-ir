<div>
    @include('modal.click-settings')
    @include('modal.news-update.show-photo')
    <div style="display: flex; width: 100%; margin-top: 135px;">
        <div style="width: 81%; margin-left: 19%;">
            <div class="container">
                <div>
                    <h5 style="margin-left: 2%; margin-top: 3%;">DTR</h5>
                </div>
                <div style="display: flex; @if($dtr_data == null )  @elseif($dtr_data->in != null and $dtr_data->out != null) display: none @endif">
                    <div style="border-radius: 100px; background-color: #008000; padding: 2%; width: 9%; text-align: center; margin-left: 40%; @if($dtr_data == null or $dtr_data->in == null) color: white; cursor: pointer @endif" @if($dtr_data == null or $dtr_data->in == null) wire:click="in" @endif ><h5>Time In</h5></div>
                    <div style="border-radius: 100px; background-color: #6B8E23; padding: 2%; width: 9%; text-align: center; margin-left: 1%; @if($dtr_data == null or $dtr_data->in == null) color: black; @elseif($dtr_data->in != null) color: white; cursor: pointer @endif" @if($dtr_data == null or $dtr_data->in == null) @elseif($dtr_data->in != null) wire:click="out" @endif ><h5>Time Out</h5></div>
                </div>
                <div style="display: flex; @if($dtr_data == null ) display: none @elseif($dtr_data->in != null and $dtr_data->out != null)  @else display: none @endif">
                    <div style="border-radius: 100px; background-color: #008000; padding: 2%; width: 9%; text-align: center; margin-left: 40%; @if($dtr_data == null) display: none @elseif($dtr_data->in != null and $dtr_data->out != null and $dtr_data->in2 != null) color: black; @elseif($dtr_data->in != null and $dtr_data->out != null ) color: white; cursor: pointer @endif" @if($dtr_data == null) @elseif($dtr_data->in != null and $dtr_data->out != null and $dtr_data->in2 != null)  @elseif($dtr_data->in != null and $dtr_data->out != null) wire:click="in2" @endif><h5>Time In</h5></div>
                    <div style="border-radius: 100px; background-color: #6B8E23; padding: 2%; width: 9%; text-align: center; margin-left: 1%;  @if($dtr_data == null) display: none @elseif($dtr_data->in != null and $dtr_data->out != null and $dtr_data->in2 != null and $dtr_data->out2 != null) color: black; @elseif($dtr_data->in != null and $dtr_data->out != null and $dtr_data->in2 != null) color: white; cursor: pointer @endif" @if($dtr_data == null) @elseif($dtr_data->in != null and $dtr_data->out != null and $dtr_data->in2 != null and $dtr_data->out2 != null)  @elseif($dtr_data->in != null and $dtr_data->out != null and $dtr_data->in2 != null) wire:click="out2"  @endif><h5>Time Out</h5></div>
                </div>
                <div style="margin-top: 2%;">
                    <input class="form-control" placeholder="User id" type="text" style="width: 20%; margin-left: 40%;" wire:model="designated_id">
                    @error('designated_id') <span style="color: red; margin-left: 40%;">{{ $message }}</span> @enderror
                    <div style="margin-top: 1%;">
                        @if (session('good'))
                            <p style="color: blue; text-align: center; font-size: 19px;">{{ session('good') }}</p>
                        @elseif(session('bad'))
                            <p style="color: red; text-align: center; font-size: 19px;">{{ session('bad') }}</p>
                        @endif
                    </div>
                </div>
                <div style="margin-top: 4%; width: 80%; margin-left: 10%;">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">Day</th>
                            <th scope="col">Time in</th>
                            <th scope="col">Time out</th>
                            <th scope="col">Time in</th>
                            <th scope="col">Time out</th>
                            <th scope="col">Total time</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($dtr_permanent_data as $data)
                            <tr>
                                <th scope="row">@if($data->in == null) @else {{Carbon\Carbon::parse($data->in)->format('D') }} @endif</th>
                                <td>@if($data->in == null) @else {{Carbon\Carbon::parse($data->in)->format('h:i A') }} @endif</td>
                                <td>@if($data->out == null) @else {{Carbon\Carbon::parse($data->out)->format('h:i A') }} @endif</td>
                                <td>@if($data->in2 == null) @else {{Carbon\Carbon::parse($data->in2)->format('h:i A') }} @endif</td>
                                <td>@if($data->out2 == null) @else {{Carbon\Carbon::parse($data->out2)->format('h:i A') }} @endif</td>
                                <td>
                                    {{$data->hour}}:{{$data->minute}}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div style="width: 19%; background-color: #0077b6; position: fixed;top: 125px; left: 0; z-index: 1000;">
            @include('components.layouts.profile')
            @include('components.layouts.navigation')
        </div>
    </div>
    @include('partial.header')
</div>

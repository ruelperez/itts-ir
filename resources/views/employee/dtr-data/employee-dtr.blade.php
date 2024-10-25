<div class="row">
    <div id="qr-reader" class="col-sm-4 border border-dark-5" style="width: 350px; height: 350px;"></div>
    <div class="col-sm-12">
        <div class="row mt-4">
            <div class="col-md-4 col-lg-2">
                {{--            <b style="font-size: 15px; ">@if(isset($date)) {{Carbon\Carbon::parse($date->in)->format('m-d-Y')}}@endif</b>--}}
            </div>
            <div class="mt-2 mt-md-0 col-md-4 col-lg-6 col-xl-4">
                <input class="form-control" type="search" placeholder="Search" aria-label="Search">
            </div>
        </div>
        <div class="table-responsive mt-4">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col">Fullname</th>
                    <th scope="col">In</th>
                    <th scope="col">Out</th>
                    <th scope="col">In</th>
                    <th scope="col">Out</th>
                </tr>
                </thead>
                <tbody id="qr-reader-results">
                    @if($dtrData)
                        @foreach($dtrData as $data)
                            <tr>
                                <td>{{ucwords($data->fullname)}}</td>
                                <td>@if($data->in == null) @else {{Carbon\Carbon::parse($data->in)->format('h:i A') }} @endif</td>
                                <td>@if($data->out == null) @else {{Carbon\Carbon::parse($data->out)->format('h:i A') }} @endif</td>
                                <td>@if($data->in2 == null) @else {{Carbon\Carbon::parse($data->in2)->format('h:i A') }} @endif</td>
                                <td>@if($data->out2 == null) @else {{Carbon\Carbon::parse($data->out2)->format('h:i A') }} @endif</td>
                            </tr>
                        @endforeach
                    @else
                        <p>No records found.</p>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

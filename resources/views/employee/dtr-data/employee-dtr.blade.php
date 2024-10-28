<div class="d-xl-flex justify-content-between">
    <div class="d-md-flex d-xl-block">
        <div id="qr-reader" style="width: 300px; height: 300px;"></div>
        <!-- Running U.S. Clock -->
        <div id="philippine-time" class=" mt-3 mt-md-5 ms-md-5 ms-xl-0" style="font-size: 18px; font-weight: bold;"></div>
    </div>
    <div class="col-xl-9 ps-xl-5 mt-4 mt-md-5 mt-xl-0">
        <div class="col-md-8 col-lg-6">
            <input class="form-control" type="search" placeholder="Search" aria-label="Search">
        </div>
        <div class="table-responsive mt-3">
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

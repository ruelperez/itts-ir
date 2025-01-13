<div class="d-xl-flex justify-content-between">
    <div class="d-md-flex d-xl-block">
        <div id="philippine-time" class=" ms-md-5 ms-xl-0" style="font-size: 18px; font-weight: bold;"></div>
        <div class="mt-2 mt-md-4">
            <input id="scannerInput" type="text" placeholder="Employee ID" style="width: 300px; height: 50px; font-size: 24px;" />
        </div>
        <!-- Employee Photo Section -->
        <div class="mt-5">
            <img id="employeePhoto" src="{{ asset('photos/photos/'.$empPhoto) }}" alt="Employee Photo" style="width: 250px; height: 250px; object-fit: cover; border: 2px solid #ccc;" />
        </div>
        <div>
            <p id="employeeFullName" style="font-size: 18px; font-weight: bold; margin-top: 10px;">{{$empFullname}}</p>
        </div>
    </div>

    <div class="col-xl-9 ps-xl-5 mt-4 mt-md-5 mt-xl-0">
        <div class="row">
            <div class="col-md-8 col-lg-6">
                <input class="form-control" id="searchInput" type="search" placeholder="Search" aria-label="Search">
            </div>
            <div class="col-md-4 col-lg-6 mt-4 mt-md-2">
                Total Headcount :  <b id="headCount">{{count($dtrData)}}</b>
            </div>
        </div>

        <div class="table-responsive mt-1">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col">Fullname</th>
                    <th scope="col">In</th>
                    <th scope="col">Out</th>
                    <th scope="col">In 2</th>
                    <th scope="col">Out 2</th>
                </tr>
                </thead>
                <tbody id="qr-reader-results">
                @if($dtrData)
                    @foreach($dtrData as $data)
                        <tr>
                            <td>{{ ucwords($data->fullname) }}</td>
                            <td>@if($data->in) {{ Carbon\Carbon::parse($data->in)->format('h:i A') }} @endif</td>
                            <td>@if($data->out) {{ Carbon\Carbon::parse($data->out)->format('h:i A') }} @endif</td>
                            <td>@if($data->in2) {{ Carbon\Carbon::parse($data->in2)->format('h:i A') }} @endif</td>
                            <td>@if($data->out2) {{ Carbon\Carbon::parse($data->out2)->format('h:i A') }} @endif</td>
                            <td>@if($data->isEarlyOut == 1)<b style="color: white; background-color: red;" class="px-2">Early out</b> @endif @if($data->is_edited == 1)<b style="color: blue" class="fst-italic">(Adjusted)@endif</td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

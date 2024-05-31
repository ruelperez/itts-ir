<div>
    @include('modal.click-settings')
    @include('modal.news-update.show-photo')
    <div style="display: flex; width: 100%; margin-top: 135px; ">
        <div style="width: 19%; background-color: #0077b6; position: fixed; top: 125px; z-index: 1000; height: 100%;">
            @include('components.layouts.profile')
            @include('components.layouts.navigation')
        </div>
        <div style="width: 81%; margin-left: 19%;">
            <div>
                <div>
                    <h5 style="margin-left: 2%; margin-top: 2%;">Employee</h5>
                </div>

                <table class="table" style="margin-left: 10%; width: 30%;">
                    <thead>
                    <tr>
                        <th scope="col">Fullname</th>
                        <th scope="col">ID</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($employeeData as $data)
                        <tr>
                            <td>{{ucwords($data->fullname)}}</td>
                           <td>ITTS-00{{$data->id}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include('partial.header')
</div>

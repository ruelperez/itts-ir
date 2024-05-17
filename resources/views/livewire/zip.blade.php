<div>
    @include('modal.click-settings')
    @include('modal.news-update.show-photo')
    <div style="display: flex; width: 100%; margin-top: 135px;">
        <div style="width: 81%; margin-left: 19%;">
            <div class="container">
                <div>
                    <h4 style="margin-top: 3%;margin-left: 2%;">Zip code checker</h4>
                </div>
                <div style="margin-left: 3%; margin-top: 2%; background-color: #F5F5F5; border-radius: 2%; padding-left: 3%;">
                    <div style="display: flex; margin-top: 3%; padding-top: 2%;">
                        <div style="width: 50%; margin-bottom: 2%;">
                            <input type="text" placeholder="Search zip code" wire:model.live="searchInput" style="width: 100%; padding: 1%; margin-top: 2%;">
                        </div>
                    </div>
                    <table class="table table-hover" style="margin-top: 0.5%; width: 96.5%; margin-bottom: 2%;">
                        <thead>
                        <tr class="inv">
                            <th style="text-align: left">
                                Zip code
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($request_data) == 0)
                            <tr style="text-align: center">
                                <td colspan="7"> No zip code posted</td>
                            </tr>
                        @else
                            @php $q=0; @endphp
                            @foreach($request_data as $data)
                                @if($q < 15)
                                    <tr style="color: black">
                                        <td style="text-align: left">{{$data->zip_code}}</td>
                                    </tr>
                                @endif
                                @php $q++; @endphp
                            @endforeach
                        @endif
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

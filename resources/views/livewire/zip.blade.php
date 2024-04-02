<div>
    @include('modal.click-settings')
    @include('partial.header')
    <div style="display: flex; width: 100%;">
        <div style="width: 19%; background-color: #0077b6">
            <div style="position: relative;">
                <div style="text-align: center; margin-top: 10%; position: absolute; width: 100%;">
                    <div style="display: flex;">
                        <i onclick="clickEllipsis()" class="fa-solid fa-ellipsis-vertical" id="ellip" style="color: white; margin-left: 10%;font-size: 23px; cursor: pointer; margin-right: 22%;"></i>
                        <i class="fa-solid fa-user" style="font-size: 100px; color: #DCDCDC	"></i>
                    </div>
                    <h5 style="color: white; margin-top: 5%;">@if($is_admin == "1") ADMIN @else AGENT @endif</h5>
                    <p style="color: white">{{ucwords($fullname)}}</p>
                </div>
                <div class="div100" style="display: none; width: 70%; padding: 5px 12px; background-color: #0d1321;  border: solid black 3px;border-radius: 12px;  position: relative; margin-left: 10%; top: 52px;
                    z-index: 2; /* Make sure this is lower than the z-index of the covering div */
                  color: white;">
                    @if($is_admin == "1")
                        <div wire:click="clickPortion('logs')" wire:loading.attr="disabled"><i class="fa-solid fa-tent-arrow-left-right"></i> Logs</div>
                        <div style=" margin-top: 5%;" data-bs-toggle="modal" data-bs-target="#changePassModal"><i class="fa-solid fa-pen-nib"></i> Change Password</div>
                        <div wire:click="clickSettings" data-bs-toggle="modal" data-bs-target="#clickSettings" id="settings" style="margin-top: 5%; color: white; background-color: #0d1321">
                            <i class="fa-solid fa-gear" style="margin-right: 7px;"></i>Settings
                        </div>
                    @endif
                    <div style="margin-top: 15%;">
                        <button style="background-color: #0d1321; border: none; width: 100%; text-align: right; color: white " wire:click="logout"><i class="fa-solid fa-right-from-bracket"></i>Log Out</button>
                    </div>

                </div>
            </div>

            <div class="div101" style="width: 80%; height: 1px; background-color: white; margin-left: 10%; margin-top: 75%;"></div>
            <div style="margin-top: 3%;" class="navig">
                <div href="/itts-ir" style="padding-left: 10%;" wire:navigate>
                    I.R
                </div>
                <div href="/itts-age-checker" style="padding-left: 10%;" wire:navigate>
                    AGE CHECKER
                </div>
                <div href="/itts-zip-checker" style="background-color: #023e8a; padding-left: 10%;" wire:navigate>
                    ZIP CODE CHECKER
                </div>
            </div>
        </div>
        <div style="width: 81%; margin-left: 3%; margin-right: 1%;">
            <div class="container">
                <div>
                    <h4 style="margin-top: 3%;">Zip code checker</h4>
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
                                    <tr class="invs">
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

    </div>

</div>

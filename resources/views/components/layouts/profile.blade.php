<div style="position: relative;" wire:ignore>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#show_photo" id="show_photo" hidden>
        Launch demo modal
    </button>
    <div style="text-align: center; margin-top: 10%; position: absolute; width: 100%;">
        <div style="display: flex;">
            @if($position != "Agent")
                <i onclick="clickEllipsis()" class="fa-solid fa-ellipsis-vertical" id="ellip" style="color: white; margin-left: 10%;font-size: 23px; cursor: pointer; margin-right: 11%;"></i>
            @endif
            <div class="profile" style="@if($position == "Agent") margin-left: 22%; @endif">
                <img src="{{asset('photos/photos/'.$photo)}}" alt="Profile Picture">
                <div style="background-color:#C0C0C0; position: absolute; top: 70%; left: 65%; border-radius: 80%; padding: 1%; width: 20%; cursor: pointer" onclick="chooseFile()">
                    <i class="fa-solid fa-camera" style="font-size: 17px;"></i>
                    <input type="file" id="fileInput" accept="image/*" hidden wire:model.live="photo">
                </div>
            </div>
{{--            <i class="fa-solid fa-user" style="font-size: 100px; color: #DCDCDC	"></i>--}}
        </div>
        <h5 style="color: white;">@if($position == "Super Admin") SUPER ADMIN @elseif($position == "Admin") ADMIN @else AGENT @endif</h5>
        <p style="color: white">{{ucwords($fullname)}}<br><small>ITTS-00{{$user_id}}</small></p>
    </div>
    <div class="div100" style="display: none; width: 70%; padding: 5px 12px; background-color: #0d1321;  border: solid black 3px;border-radius: 12px;  position: relative; margin-left: 10%; top: 52px;
                    z-index: 2; /* Make sure this is lower than the z-index of the covering div */
                  color: white;">
        @if($position != "Agent")
            <div href="/itts/7/logs" wire:loading.attr="disabled" wire:navigate target="_blank"><i class="fa-solid fa-tent-arrow-left-right"></i>Activity logs</div>
{{--            <div style=" margin-top: 5%;" data-bs-toggle="modal" data-bs-target="#changePassModal"><i class="fa-solid fa-pen-nib"></i> Change Password</div>--}}
            <div wire:click="clickSettings" data-bs-toggle="modal" data-bs-target="#clickSettings" id="settings" style="margin-top: 5%; color: white; background-color: #0d1321">
                <i class="fa-solid fa-gear" style="margin-right: 7px;"></i>Settings
            </div>
        @endif
        <div style="margin-top: 15%;">
            <button style="background-color: #0d1321; border: none; width: 100%; text-align: right; color: white " wire:click="logout"><i class="fa-solid fa-right-from-bracket"></i>Log Out</button>
        </div>

    </div>
</div>
<div class="div101" style="width: 80%; height: 1px; background-color: white; margin-left: 10%; margin-top: 270px;" wire:ignore></div>

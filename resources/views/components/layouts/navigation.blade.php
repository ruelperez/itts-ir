@include('modal.click-lead')
<div style="width: 220px; background-color: #F5F5F5; height: 100%; margin-top: 75px;" class="position-fixed start-0">
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
            </div>
            <h6 style="color: white;">@if($employeeData == null or $employeeData == "") @else {{$employeeData}} @endif</h6>
            <p class="text-white">{{ucwords($fullname)}}<br><small class="user-select-all">ITTS-00{{$user_id}}</small></p>
        </div>
        <div class="div100" style="display: none; width: 70%; padding: 5px 12px; background-color: #0d1321;  border: solid black 3px;border-radius: 12px;  position: relative; margin-left: 10%; top: 52px;
                        z-index: 2; /* Make sure this is lower than the z-index of the covering div */
                      color: white;">
            @if($position != "Agent")
                <div  href="/itts/7/logs" wire:loading.attr="disabled" wire:navigate target="_blank"><i class="fa-solid fa-tent-arrow-left-right"></i>Activity logs</div>
                {{--            <div style=" margin-top: 5%;" data-bs-toggle="modal" data-bs-target="#changePassModal"><i class="fa-solid fa-pen-nib"></i> Change Password</div>--}}
                <div onclick="location.href = '/itts/18/inventory';"  style="margin-top: 5%; color: white; background-color: #0d1321">
                    <i class="fa-solid fa-store" style="margin-right: 7px;"></i>Inventory
                </div>
                @if($position == "Super Admin")
                    <div style="margin-top: 5%; color: white; background-color: #0d1321" data-bs-toggle="modal" data-bs-target="#lead">
                        <i class="fa-solid fa-check-to-slot" style="margin-right: 7px;"></i>Lead Tracker
                    </div>
                @endif
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









    <div class="navig overflow-auto scrollable-div" wire:ignore style="height: 320px; color: black">
        @if($webName == "employee")
            @if(count($empData) < 1)
                <div style="@if($webName == "dashboard") background-color: #023e8a; @endif  padding-left: 10%; " data-bs-toggle="modal" data-bs-target="#disclick">
                    <i class="fa-solid fa-table-columns"></i>Dashboard
                </div>
                <div style="@if($webName == "dtr") background-color: #023e8a; @endif  padding-left: 10%;" data-bs-toggle="modal" data-bs-target="#disclick">
                    DTR
                </div>
{{--                <div onclick="location.href = '/itts/3/zip-checker';" style="@if($webName == "zip-checker") background-color: #023e8a; @endif  padding-left: 10%;">--}}
{{--                    Zip code Checker--}}
{{--                </div>--}}
                <div style="@if($webName == "news-feed") background-color: #023e8a; @endif  padding-left: 10%;" data-bs-toggle="modal" data-bs-target="#disclick">
                    Mass tort
                </div>
                @if($position != "Agent")
                    <div style="@if($webName == "my-notes") background-color: #023e8a; @endif  padding-left: 10%;" data-bs-toggle="modal" data-bs-target="#disclick">
                        Form link
                    </div>
                @endif
                <div style="@if($webName == "notes") background-color: #023e8a; @endif  padding-left: 10%;" data-bs-toggle="modal" data-bs-target="#disclick">
                    My Notes
                </div>
                <div onclick="location.href = '/itts/15/employee';" style="@if($webName == "employee") background-color: #023e8a; @endif  padding-left: 10%;" >
                    Employee
                </div>
                <div style="@if($webName == "faq") background-color: #023e8a; @endif  padding-left: 10%;" data-bs-toggle="modal" data-bs-target="#disclick">
                    FAQ
                </div>
                <div style="@if($webName == "my-device") background-color: #023e8a; @endif  padding-left: 10%;"  data-bs-toggle="modal" data-bs-target="#disclick">
                    My device
                </div>
                <div onclick="location.href = '/itts/26/my-production-lead';" style="@if($webName == "my-production-lead") background-color: #023e8a; @endif  padding-left: 10%;" >
                    My production lead
                </div>
                @if($position == "Agent")
                    <div style="margin-left: auto; text-align: right; padding-right: 5%;" wire:click="logout">
                        <i class="fa-solid fa-right-from-bracket" style=" color: white; margin-right: 5px; "></i>Log Out
                    </div>
                @endif
            @else
                <div onclick="location.href = '/itts/5/dashboard';"  style="@if($webName == "dashboard") background-color: #023e8a; @endif  padding-left: 10%;">
                    <i class="fa-solid fa-table-columns"></i>Dashboard
                </div>
                <div onclick="location.href = '/itts/8/dtr';" style="@if($webName == "dtr") background-color: #023e8a; @endif  padding-left: 10%;">
                    DTR
                </div>
{{--                <div onclick="location.href = '/itts/3/zip-checker';" style="@if($webName == "zip-checker") background-color: #023e8a; @endif  padding-left: 10%;">--}}
{{--                    Zip code Checker--}}
{{--                </div>--}}
                <div onclick="location.href = '/itts/4/news-feed';" style="@if($webName == "news-feed") background-color: #023e8a; @endif  padding-left: 10%;" >
                    Mass tort
                </div>
                @if($position != "Agent")
                    <div onclick="location.href = '/itts/6/my-notes';" style="@if($webName == "my-notes") background-color: #023e8a; @endif  padding-left: 10%;" >
                        Form link
                    </div>
                @endif
                <div onclick="location.href = '/itts/14/notes';" style="@if($webName == "notes") background-color: #023e8a; @endif  padding-left: 10%;" >
                    My Notes
                </div>
                <div onclick="location.href = '/itts/15/employee';" style="@if($webName == "employee") background-color: #023e8a; @endif  padding-left: 10%;" >
                    Employee
                </div>
                <div onclick="location.href = '/itts/13/faq';" style="@if($webName == "faq") background-color: #023e8a; @endif  padding-left: 10%;" >
                    FAQ
                </div>
                <div onclick="location.href = '/itts/17/my-device';" style="@if($webName == "my-device") background-color: #023e8a; @endif  padding-left: 10%;" >
                    My device
                </div>
                <div onclick="location.href = '/itts/26/my-production-lead';" style="@if($webName == "my-production-lead") background-color: #023e8a; @endif  padding-left: 10%;" >
                    My production lead
                </div>
                @if($position == "Agent")
                    <div style="margin-left: auto; text-align: right; padding-right: 5%;" wire:click="logout">
                        <i class="fa-solid fa-right-from-bracket" style=" color: white; margin-right: 5px; "></i>Log Out
                    </div>
                @endif
            @endif

        @else
            <div onclick="location.href = '/itts/5/dashboard';"  style="@if($webName == "dashboard") background-color: #023e8a; @endif  padding-left: 10%;">
                <i class="fa-solid fa-table-columns dashboard-nav"></i>Dashboard
            </div>
            <div onclick="location.href = '/itts/8/dtr';" style="@if($webName == "dtr") background-color: #023e8a; @endif  padding-left: 10%;">
                DTRs
            </div>
{{--            <div onclick="location.href = '/itts/3/zip-checker';" style="@if($webName == "zip-checker") background-color: #023e8a; @endif  padding-left: 10%;">--}}
{{--                Zip code Checker--}}
{{--            </div>--}}
            <div onclick="location.href = '/itts/4/news-feed';" style="@if($webName == "news-feed") background-color: #023e8a; @endif  padding-left: 10%;" >
                Mass tort
            </div>
            @if($position != "Agent")
                <div onclick="location.href = '/itts/6/form-link';" style="@if($webName == "form-link") background-color: #023e8a; @endif  padding-left: 10%;" >
                    Form link
                </div>
            @endif
            <div onclick="location.href = '/itts/14/notes';" style="@if($webName == "notes") background-color: #023e8a; @endif  padding-left: 10%;" >
                My Notes
            </div>
            <div onclick="location.href = '/itts/15/employee';" style="@if($webName == "employee") background-color: #023e8a; @endif  padding-left: 10%;" >
                Employee
            </div>
            <div onclick="location.href = '/itts/13/faq';" style="@if($webName == "faq") background-color: #023e8a; @endif  padding-left: 10%;" >
                FAQ
            </div>
            <div onclick="location.href = '/itts/17/my-device';" style="@if($webName == "my-device") background-color: #023e8a; @endif  padding-left: 10%;" >
                My device
            </div>
            <div onclick="location.href = '/itts/26/my-production-lead';" style="@if($webName == "my-production-lead") background-color: #023e8a; @endif  padding-left: 10%;" >
                My production lead
            </div>
            @if($position == "Agent")
                <div style="margin-left: auto; text-align: right; padding-right: 5%;" wire:click="logout">
                    <i class="fa-solid fa-right-from-bracket" style=" color: white; margin-right: 5px; "></i>Log Out
                </div>
            @endif
        @endif
    </div>
</div>

    <div class="navig overflow-auto scrollable-div" wire:ignore style="height: 320px;">
        @if($webName == "employee")
            @if(count($empData) < 1)
                <div style="@if($webName == "dashboard") background-color: #023e8a; @endif  padding-left: 10%; " data-bs-toggle="modal" data-bs-target="#disclick">
                    DASHBOARD
                </div>
                <div style="@if($webName == "dtr") background-color: #023e8a; @endif  padding-left: 10%;" data-bs-toggle="modal" data-bs-target="#disclick">
                    DTR
                </div>
                {{--    <div href="/itts/3/zip-checker" style="@if($webName == "zip-checker") background-color: #023e8a; @endif  padding-left: 10%;" wire:navigate>--}}
                {{--        ZIP CODE CHECKER--}}
                {{--    </div>--}}
                <div style="@if($webName == "news-feed") background-color: #023e8a; @endif  padding-left: 10%;" data-bs-toggle="modal" data-bs-target="#disclick">
                    CAMPAIGN
                </div>
                @if($position != "Agent")
                    <div style="@if($webName == "my-notes") background-color: #023e8a; @endif  padding-left: 10%;" data-bs-toggle="modal" data-bs-target="#disclick">
                        FORM LINK
                    </div>
                @endif
                <div style="@if($webName == "notes") background-color: #023e8a; @endif  padding-left: 10%;" data-bs-toggle="modal" data-bs-target="#disclick">
                    MY NOTES
                </div>
                <div onclick="location.href = '/itts/15/employee';" style="@if($webName == "employee") background-color: #023e8a; @endif  padding-left: 10%;" >
                    EMPLOYEE
                </div>
                <div style="@if($webName == "faq") background-color: #023e8a; @endif  padding-left: 10%;" data-bs-toggle="modal" data-bs-target="#disclick">
                    FAQ
                </div>
                <div style="@if($webName == "my-device") background-color: #023e8a; @endif  padding-left: 10%;"  data-bs-toggle="modal" data-bs-target="#disclick">
                    MY DEVICE
                </div>
                <div onclick="location.href = '/itts/26/my-production-lead';" style="@if($webName == "my-production-lead") background-color: #023e8a; @endif  padding-left: 10%;" >
                    MY PRODUCTION LEAD
                </div>
                @if($position == "Agent")
                    <div style="margin-left: auto; text-align: right; padding-right: 5%;" wire:click="logout">
                        <i class="fa-solid fa-right-from-bracket" style=" color: white; margin-right: 5px; "></i>Log Out
                    </div>
                @endif
            @else
                <div onclick="location.href = '/itts/5/dashboard';"  style="@if($webName == "dashboard") background-color: #023e8a; @endif  padding-left: 10%;">
                    DASHBOARD
                </div>
                <div onclick="location.href = '/itts/8/dtr';" style="@if($webName == "dtr") background-color: #023e8a; @endif  padding-left: 10%;">
                    DTR
                </div>
                {{--    <div href="/itts/3/zip-checker" style="@if($webName == "zip-checker") background-color: #023e8a; @endif  padding-left: 10%;" wire:navigate>--}}
                {{--        ZIP CODE CHECKER--}}
                {{--    </div>--}}
                <div onclick="location.href = '/itts/4/news-feed';" style="@if($webName == "news-feed") background-color: #023e8a; @endif  padding-left: 10%;" >
                    CAMPAIGN
                </div>
                @if($position != "Agent")
                    <div onclick="location.href = '/itts/6/my-notes';" style="@if($webName == "my-notes") background-color: #023e8a; @endif  padding-left: 10%;" >
                        FORM LINK
                    </div>
                @endif
                <div onclick="location.href = '/itts/14/notes';" style="@if($webName == "notes") background-color: #023e8a; @endif  padding-left: 10%;" >
                    MY NOTES
                </div>
                <div onclick="location.href = '/itts/15/employee';" style="@if($webName == "employee") background-color: #023e8a; @endif  padding-left: 10%;" >
                    EMPLOYEE
                </div>
                <div onclick="location.href = '/itts/13/faq';" style="@if($webName == "faq") background-color: #023e8a; @endif  padding-left: 10%;" >
                    FAQ
                </div>
                <div onclick="location.href = '/itts/17/my-device';" style="@if($webName == "my-device") background-color: #023e8a; @endif  padding-left: 10%;" >
                    MY DEVICE
                </div>
                <div onclick="location.href = '/itts/26/my-production-lead';" style="@if($webName == "my-production-lead") background-color: #023e8a; @endif  padding-left: 10%;" >
                    MY PRODUCTION LEAD
                </div>
                @if($position == "Agent")
                    <div style="margin-left: auto; text-align: right; padding-right: 5%;" wire:click="logout">
                        <i class="fa-solid fa-right-from-bracket" style=" color: white; margin-right: 5px; "></i>Log Out
                    </div>
                @endif
            @endif

        @else
            <div onclick="location.href = '/itts/5/dashboard';"  style="@if($webName == "dashboard") background-color: #023e8a; @endif  padding-left: 10%;">
                DASHBOARD
            </div>
            <div onclick="location.href = '/itts/8/dtr';" style="@if($webName == "dtr") background-color: #023e8a; @endif  padding-left: 10%;">
                DTR
            </div>
            {{--    <div href="/itts/3/zip-checker" style="@if($webName == "zip-checker") background-color: #023e8a; @endif  padding-left: 10%;" wire:navigate>--}}
            {{--        ZIP CODE CHECKER--}}
            {{--    </div>--}}
            <div onclick="location.href = '/itts/4/news-feed';" style="@if($webName == "news-feed") background-color: #023e8a; @endif  padding-left: 10%;" >
                CAMPAIGN
            </div>
            @if($position != "Agent")
                <div onclick="location.href = '/itts/6/form-link';" style="@if($webName == "form-link") background-color: #023e8a; @endif  padding-left: 10%;" >
                    FORM LINK
                </div>
            @endif
            <div onclick="location.href = '/itts/14/notes';" style="@if($webName == "notes") background-color: #023e8a; @endif  padding-left: 10%;" >
                MY NOTES
            </div>
            <div onclick="location.href = '/itts/15/employee';" style="@if($webName == "employee") background-color: #023e8a; @endif  padding-left: 10%;" >
                EMPLOYEE
            </div>
            <div onclick="location.href = '/itts/13/faq';" style="@if($webName == "faq") background-color: #023e8a; @endif  padding-left: 10%;" >
                FAQ
            </div>
            <div onclick="location.href = '/itts/17/my-device';" style="@if($webName == "my-device") background-color: #023e8a; @endif  padding-left: 10%;" >
                MY DEVICE
            </div>
            <div onclick="location.href = '/itts/26/my-production-lead';" style="@if($webName == "my-production-lead") background-color: #023e8a; @endif  padding-left: 10%;" >
                MY PRODUCTION LEAD
            </div>
            @if($position == "Agent")
                <div style="margin-left: auto; text-align: right; padding-right: 5%;" wire:click="logout">
                    <i class="fa-solid fa-right-from-bracket" style=" color: white; margin-right: 5px; "></i>Log Out
                </div>
            @endif
        @endif
    </div>
</div>

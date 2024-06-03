<div class="navig" wire:ignore>
    <div href="/itts/5/dashboard" style="@if($webName == "dashboard") background-color: #023e8a; @endif  padding-left: 10%;" wire:navigate>
        DASHBOARD
    </div>
    <div href="/itts/8/dtr" style="@if($webName == "dtr") background-color: #023e8a; @endif  padding-left: 10%;" wire:navigate>
        DTR
    </div>
{{--    <div href="/itts/3/zip-checker" style="@if($webName == "zip-checker") background-color: #023e8a; @endif  padding-left: 10%;" wire:navigate>--}}
{{--        ZIP CODE CHECKER--}}
{{--    </div>--}}
    <div href="/itts/4/news-feed" style="@if($webName == "news-feed") background-color: #023e8a; @endif  padding-left: 10%;" wire:navigate>
        CAMPAIGN
    </div>
    @if($position != "Agent")
        <div href="/itts/6/my-notes" style="@if($webName == "my-notes") background-color: #023e8a; @endif  padding-left: 10%;" wire:navigate>
            FORM LINK
        </div>
    @endif
    <div href="/itts/14/notes" style="@if($webName == "notes") background-color: #023e8a; @endif  padding-left: 10%;" wire:navigate>
        MY NOTES
    </div>
    @if($position != "Agent")
        <div href="/itts/15/employee" style="@if($webName == "employee") background-color: #023e8a; @endif  padding-left: 10%;" wire:navigate>
            EMPLOYEE
        </div>
    @endif

    <div href="/itts/13/faq" style="@if($webName == "faq") background-color: #023e8a; @endif  padding-left: 10%;" wire:navigate>
        FAQ
    </div>
    @if($position == "Agent")
        <div style="margin-left: auto; text-align: right; padding-right: 5%;" wire:click="logout">
            <i class="fa-solid fa-right-from-bracket" style=" color: white; margin-right: 5px; "></i>Log Out
        </div>
    @endif
</div>

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
{{--                <div class="row border border-dark">--}}
{{--                    <div class="col">--}}
{{--                        1 of 3--}}
{{--                    </div>--}}
{{--                    <div class="col">--}}
{{--                        2 of 3 (wider)--}}
{{--                    </div>--}}
{{--                    <div class="col">--}}
{{--                        3 of 3--}}
{{--                    </div>--}}
{{--                </div>--}}
            </div>
        </div>
    </div>
    @include('partial.header')
</div>

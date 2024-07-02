<div>
    @include('components.layouts.profile')
    @include('components.layouts.navigation')
    @include('modal.click-settings')
    @include('modal.news-update.show-photo')
    <div style="display: flex; width: 100%; margin-top: 105px;">
        <div style="width: 81%; margin-left: 19%;">
            <div class="container">
                <div>
                    <h6 style="margin-left: 2%; margin-top: 3%;">DEPLOYED DEVICE</h6>
                </div>
                {{--                <button wire:click="boom">clickIT</button>--}}
                {{--                <button wire:click="baam">DO NOT CLICK!!!!!!</button>--}}
            </div>
        </div>
    </div>
    @include('partial.header')
</div>

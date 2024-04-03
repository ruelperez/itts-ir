<div>
    @include('modal.click-settings')
    @include('partial.header')
    <div style="display: flex; width: 100%;">
        <div style="width: 19%; background-color: #0077b6">
            @include('components.layouts.profile')
            <div class="div101" style="width: 80%; height: 1px; background-color: white; margin-left: 10%; margin-top: 75%;"></div>
            @include('components.layouts.navigation')
        </div>
        <div style="width: 81%;">
            <div class="container">
                <div>
                    <h4 style="margin-left: 2%; margin-top: 3%;">My notes</h4>
                </div>
            </div>
        </div>

    </div>

</div>

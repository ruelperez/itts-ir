<div>
    @include('modal.click-settings')
    @include('modal.news-update.show-photo')
    <div style="display: flex; width: 100%; margin-top: 135px;">
        <div style="width: 81%; margin-left: 19%;">
            <div class="container">
                <div>
                    <h5 style="margin-left: 2%; margin-top: 3%;">DTR</h5>
                </div>
                <div style="display: flex;">
                    <div style="border-radius: 100px; background-color: #008000; padding: 2%; width: 9%; color: white; text-align: center; cursor: pointer; margin-left: 40%;"><h5>Time In</h5></div>
                    <div style="border-radius: 100px; background-color: #6B8E23; padding: 2%; width: 9%; color: white; text-align: center; margin-left: 1%; cursor: pointer"><h5>Time Out</h5></div>
                </div>
                <div style="margin-top: 2%;">
                    <input class="form-control" placeholder="User id" type="text" style="width: 20%; margin-left: 40%;">
                </div>
            </div>
        </div>
        <div style="width: 19%; background-color: #0077b6; position: fixed;top: 125px; left: 0; z-index: 1000;">
            @include('components.layouts.profile')
            @include('components.layouts.navigation')
        </div>
    </div>
    @include('partial.header')
</div>

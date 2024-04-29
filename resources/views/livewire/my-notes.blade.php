<div>
    @include('modal.click-settings')
    @include('modal.news-update.show-photo')
    <div style="display: flex; width: 100%; margin-top: 135px;">
        <div style="width: 81%; margin-left: 19%;">
            <div class="container">
                <div>
                    <h4 style="margin-left: 2%; margin-top: 3%;">Employee leave form</h4>
                </div>
                <div style="margin-left: 3%;margin-top: 2%;">
                    Link: <br> <a href="https://docs.google.com/forms/d/e/1FAIpQLScsNvwJyFiQM-hv3tQL198w2O7BAAWZzg7PwxYymgRvtioJ7g/viewform" target="_blank">https://docs.google.com/forms/d/e/1FAIpQLScsNvwJyFiQM-hv3tQL198w2O7BAAWZzg7PwxYymgRvtioJ7g/viewform</a>
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

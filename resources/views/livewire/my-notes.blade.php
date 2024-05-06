<div>
    @include('modal.click-settings')
    @include('modal.news-update.show-photo')
    <div style="display: flex; width: 100%; margin-top: 135px;">
        <div style="width: 81%; margin-left: 19%;">
            <div class="container">
                <div>
                    <h5 style="margin-left: 2%; margin-top: 3%;">Form link</h5>
                </div>
                <div style="margin-left: 3%;margin-top: 2%;">
                    Employee/Agent NTE Form: <br> <a href="https://docs.google.com/forms/d/e/1FAIpQLScJnqXyMW7Vz_DCqlvllgn7B22yuvfNA79693E0IveyAZQbPg/viewform" target="_blank">https://docs.google.com/forms/d/e/1FAIpQLScsNvwJyFiQM-hv3tQL198w2O7BAAWZzg7PwxYymgRvtioJ7g/viewform</a>
                </div>
                <div style="margin-left: 3%;margin-top: 2%;">
                    Employee Info: <br> <a href="https://docs.google.com/forms/d/e/1FAIpQLSdSUf-fS4a9hDnEXgEWamq7s_Zfc_DyAFIQAphYLqce7ePV1g/viewform" target="_blank">https://docs.google.com/forms/d/e/1FAIpQLScsNvwJyFiQM-hv3tQL198w2O7BAAWZzg7PwxYymgRvtioJ7g/viewform</a>
                </div>
                <div style="margin-left: 3%;margin-top: 2%;">
                    Agent Performance MNGT. Form: <br> <a href="https://docs.google.com/forms/d/e/1FAIpQLSedBKV_OXc_Vz1EMx5g8qk-AasDN0-8_n9RvFKW8D0r5iQuvA/viewform" target="_blank">https://docs.google.com/forms/d/e/1FAIpQLScsNvwJyFiQM-hv3tQL198w2O7BAAWZzg7PwxYymgRvtioJ7g/viewform</a>
                </div>
            </div>
        </div>
        <div style="width: 19%; background-color: #0077b6; position: fixed;top: 125px; left: 0; z-index: 1000; height: 100%;">
            @include('components.layouts.profile')
            @include('components.layouts.navigation')
        </div>
    </div>
    @include('partial.header')
</div>

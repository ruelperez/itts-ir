<div>
    @include('modal.click-settings')
    @include('modal.news-update.show-photo')
    <div style="display: flex; width: 100%; margin-top: 135px;">
        <div style="width: 81%; margin-left: 19%;">
            <div class="container">
                <div>
                    <h5 style="margin-left: 2%; margin-top: 3%;">DTR Record</h5>
                </div>
                <div style="margin-left: 5%; margin-top: 2%;">
                    <h6>{{$dtrFullName}}</h6>
                </div>
                <div style="margin-top: 2%; width: 80%; margin-left: 10%; display: flex">
                    <select class="form-select" aria-label="Default select example" wire:model.live="month" style="width: 15%;">
                        <option value="Jan">January</option>
                        <option value="Feb">February</option>
                        <option value="Mar">March</option>
                        <option value="Apr">April</option>
                        <option value="May">May</option>
                        <option value="Jun">June</option>
                        <option value="Jul">July</option>
                        <option value="Aug">August</option>
                        <option value="Sept">September</option>
                        <option value="Oct">October</option>
                        <option value="Nov">November</option>
                        <option value="Dec">December</option>
                    </select>
                    <input type="text" class="form-control" placeholder="Year" wire:model.live="year" style="width: 15%; margin-left: 1%;">
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

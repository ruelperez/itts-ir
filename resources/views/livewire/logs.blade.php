<div>
    @include('partial.header')
    <div style="display: flex; width: 100%;">
        <div style="width: 19%; background-color: #0077b6;">
            @include('components.layouts.profile')
            @include('components.layouts.navigation')
        </div>
        <div style="width: 81%; background-color: #E6E6FA">
            <div class="container">
                <div>
                    <h5 style="margin-left: 2%; margin-top: 3%;">Activity Logs</h5>
                </div>
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" style="width: 30%; margin-left: 10%; margin-bottom: 1%; margin-top: 2%;">
                <div style="width: 80%; margin-left: 10%;">
                    <ul class="list-group">
                        <li class="list-group-item" style="padding: 2%;">An item</li>
                        <li class="list-group-item" style="padding: 2%;">A second item</li>
                        <li class="list-group-item" style="padding: 2%;">A third item</li>
                        <li class="list-group-item" style="padding: 2%;">A fourth item</li>
                        <li class="list-group-item" style="padding: 2%;">And a fifth one</li>
                    </ul>
                </div>
            </div>
        </div>

    </div>

</div>

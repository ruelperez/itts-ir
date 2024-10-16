<div>
    <div>
        <h6>ACTIVITY LOGS</h6>
    </div>
    <div class="px-lg-3 px-xl-5">
        <div class="mt-4 col-md-6 col-xl-4">
            <input class="form-control w-100" id="searchInput" type="search" placeholder="Search" aria-label="Search" wire:model.live="search">
        </div>
        <div class="text-center" id="spinnerContainer" style="display: none; min-height: 50px;">
            <div class="spinner-border mt-5" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
        <div class="mt-4" id="resultContainer">
            <ul class="list-group w-100">
                @foreach($logsData as $data)
                    <li class="list-group-item">
                        <div class="row">
                            <div class=" mt-2 col-md-3 col-xl-2">
                               <b>{{ucwords($data->fullname)}}</b>
                            </div>
                            <div class=" mt-2 col-md-5 col-lg-6 col-xl-7 ">
                                @if($data->note_id == null)
                                    {{ucfirst($data->action)}}
                                @else
                                    {{ucfirst($data->action)}}, post id number <b>{{$data->note_id}}</b>
                                @endif
                            </div>
                            <div class=" mt-2 fw-light col-md-4 text-md-end col-lg-3 ">
                                {{$data->updated_at->format('M-d-Y, H:i A')}}
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="row mt-4">
            <div class="col-12 col-md-6 col-lg-3 col-xl-3">
                <button class="btn btn-success w-100" wire:click="previousPage">Previous</button>
            </div>
            <div class="col-12 col-md-6 col-lg-3 col-xl-3 mt-2 mt-md-0">
                <button class="btn btn-primary w-100" wire:click="nextPage">Next</button>
            </div>
        </div>
    </div>
    <script>
        const searchInput = document.getElementById('searchInput');
        const spinnerContainer = document.getElementById('spinnerContainer');
        const resultContainer = document.getElementById('resultContainer');

        searchInput.addEventListener('input', function () {
            showLoadingSpinner();
            // Simulate an asynchronous action (e.g., fetching data)
            setTimeout(() => {
                hideLoadingSpinner();
                // Here, you would typically fetch and update your results dynamically
            }, 2000); // Simulating a delay of 2 seconds for the search
        });

        function showLoadingSpinner() {
            spinnerContainer.style.display = 'block';
            resultContainer.style.display = 'none';
        }

        function hideLoadingSpinner() {
            spinnerContainer.style.display = 'none';
            resultContainer.style.display = 'block';
        }
    </script>
</div>

<div>
        <div>
            <h6>ZIP CODE CHECKER</h6>
        </div>
        <div style="margin-left: 3%; margin-top: 1%; background-color: #F5F5F5; border-radius: 2%; padding-left: 3%;">
            <div style="display: flex; margin-top: 3%; padding-top: 2%;">
                <div style="width: 50%; margin-bottom: 2%;">
                    <input type="text" placeholder="Search zip code" wire:model.live="searchInput" style="width: 100%; padding: 1%; margin-top: 2%;">
                </div>
            </div>
            <div class="text-center">
                <div class="spinner-border mt-5 mb-5" role="status" wire:loading>
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
            <table class="table table-hover" style="margin-top: 0.5%; width: 96.5%; margin-bottom: 2%;" wire:loading.remove>
                <thead>
                <tr class="inv">
                    <th style="text-align: left">
                        Zip code
                    </th>
                    <th style="text-align: left">
                        City
                    </th>
                    <th style="text-align: left">
                        State
                    </th>
                </tr>
                </thead>
                <tbody>
                @if(count($request_data) == 0)
                    <tr style="text-align: center">
                        <td colspan="7"> No zip code posted</td>
                    </tr>
                @else
                    @foreach($request_data as $data)
                        <tr style="color: black">
                            <td style="text-align: left">{{$data->zip}}</td>
                            <td style="text-align: left">{{$data->city}}</td>
                            <td style="text-align: left">{{$data->state}}</td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    <div>
        <!-- Pagination Links -->
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <!-- Previous Button -->
                <li class="page-item {{ $currentPage == 1 ? 'disabled' : '' }}">
                    <a class="page-link" href="#" wire:click.prevent="previousPage">Previous</a>
                </li>

                {{--                <!-- Page Number Links -->--}}
                {{--                @foreach ($pageRange as $page)--}}
                {{--                    <li class="page-item {{ $currentPage == $page ? 'active' : '' }}">--}}
                {{--                        <a class="page-link" href="#" wire:click.prevent="goToPage({{ $page }})">{{ $page }}</a>--}}
                {{--                    </li>--}}
                {{--                @endforeach--}}

                {{--                <!-- Show + icon if there are more than 10 pages -->--}}
                {{--                @if ($totalPages > 10)--}}
                {{--                    <li class="page-item">--}}
                {{--                        <a class="page-link" href="#" wire:click.prevent="goToPage({{ $pageRange[count($pageRange)-1] + 1 }})">+{{ $totalPages - 10 }}</a>--}}
                {{--                    </li>--}}
                {{--                @endif--}}

                <!-- Next Button -->
                <li class="page-item {{ $currentPage == $totalPages ? 'disabled' : '' }}">
                    <a class="page-link" href="#" wire:click.prevent="nextPage">Next</a>
                </li>
            </ul>
        </nav>
    </div>
</div>

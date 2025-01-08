<div>
    @include('modal.news-update.show-photo')
    @include('modal.dupe-checker.form')
    @include('modal.dupe-checker.saveOrNot')
    @include('modal.timeshare-tracker.viewDetail')
    @include('modal.timeshare-tracker.edit-remarks')
    <div class="mb-4">
        <h6>Timeshare Tracker</h6>
    </div>
    <div class="row">
        <div class="col-md-6 col-lg-5 col-xl-4">
            <input class="form-control" type="search" placeholder="Search" aria-label="Search" wire:model.live="search">
        </div>
        <div class="mt-3 col-6 col-sm-3 col-md-3 col-lg-5 col-xl-6 text-md-center pe-lg-5 text-lg-end">
            @if(count($checkBox) == 1)
                <i class="fa-solid fa-eye" style="cursor: pointer" title="View details" wire:loading.attr="disabled" wire:click="viewDetail" data-bs-toggle="modal" data-bs-target="#viewDetail"></i>
{{--                <i class="fa-solid fa-pen-to-square ms-3" style="cursor: pointer" title="Edit" onclick="location.href = '/edit-leads/masstort-tracker-edit/{{$checkBox[0]}}';" id="dupeEditID" target="_blank"></i>--}}
                <i class="fa-solid fa-pen-to-square ms-3" style="cursor: pointer" title="Edit" wire:click="editRemark({{$checkBox[0]}})" data-bs-toggle="modal" data-bs-target="#editRemark"></i>
                <i class="fa-solid fa-trash ms-3 text-danger" style="cursor: pointer" title="Delete" wire:click="delete" wire:confirm="Are you sure you want to delete?"></i>
            @endif
            @if(count($checkBox) > 1)
                <i class="fa-solid fa-trash ms-3 text-danger" style="cursor: pointer;" title="Delete" wire:click="delete" wire:confirm="Are you sure you want to delete?"></i>
            @endif
        </div>
        @if(count($checkBox) > 0)
            <div class="mt-3 mt-md-0 col-6 col-sm-5 col-md-3 col-lg-2">
                <button type="button" class="btn btn-primary w-100" wire:click="clearCheck"><i class="fa-solid fa-broom me-2"></i>Uncheck</button>
            </div>
        @endif
    </div>
    <hr>
{{--    <div class="text-end">--}}
{{--        <i class="fa-solid fa-circle-down" style="color: green; font-size: 22px; cursor: pointer" wire:click="export"></i>--}}
{{--    </div>--}}
    <div class="text-center">
        <div class="spinner-border mt-5" role="status" wire:loading>
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
    <div style="font-size: 13px;" class="table-responsive " wire:loading.remove>
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col" style="width: 9%;">Tracker ID</th>
                <th scope="col" style="width: 9%;">Date</th>
                <th scope="col" style="width: 9%;">Agent</th>
                <th scope="col" style="width: 9%;">Guest 1</th>
                <th scope="col" style="width: 9%;">Guest 2</th>
                <th scope="col" style="width: 9%;">Phone</th>
                <th scope="col" style="width: 9%;">Alt. Phone</th>
                <th scope="col" style="width: 9%;">Email</th>
                <th scope="col" style="width: 15%;">Remarks</th>
            </tr>
            </thead>
            <tbody>
            @foreach($submissionData as $data)
                <tr onmouseover="hoverDupe({{$data->id}})" onmouseout="hoverOutDupe({{$data->id}})">
                    <td>
                        {{$data->id}}
                    </td>
                    <td>
                        {{$data->date}}
                    </td>
                    <td>
                        {{$data->agent}}
                    </td>
                    <td>
                        {{$data->guest1}}
                    </td>
                    <td>
                        {{$data->guest2}}
                    </td>
                    <td>
                        {{$data->phoneNumber}}
                    </td>
                    <td>
                        {{$data->altPhoneNumber}}
                    </td>
                    <td>
                        {{ucwords($data->email)}}
                    </td>
                    <td>
                        @if($data->reason == "")
                            {{ucwords($data->remarks)}}
                        @else
                            {{ucwords($data->remarks)}} - {{$data->reason}}
                        @endif
                    </td>
                    <td>
                        <input class="form-check-input" type="checkbox" wire:model.live="checkBox" value="{{$data->id}}" id="flexCheckDefault{{$data->id}}" style="font-size: 18px; cursor: pointer" wire:loading.attr="disabled">
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    {{--                <div class="row">--}}
    {{--                    <div class="col-12 col-md-6 col-lg-3 col-xl-3">--}}
    {{--                        <button class="btn btn-success w-100" wire:click="previousPage">Previous</button>--}}
    {{--                    </div>--}}
    {{--                    <div class="col-12 col-md-6 col-lg-3 col-xl-3 mt-2 mt-md-0">--}}
    {{--                        <button class="btn btn-primary w-100" wire:click="nextPage">Next</button>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    <div>
        <!-- Pagination Links -->
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <!-- Previous Button -->
                <li class="page-item {{ $currentPage == 1 ? 'disabled' : '' }}">
                    <a class="page-link" href="#" wire:click.prevent="previousPage">Previous</a>
                </li>

                <!-- Page Number Links -->
                @foreach ($pageRange as $page)
                    <li class="page-item {{ $currentPage == $page ? 'active' : '' }}">
                        <a class="page-link" href="#" wire:click.prevent="goToPage({{ $page }})">{{ $page }}</a>
                    </li>
                @endforeach

                <!-- Show + icon if there are more than 10 pages -->
                @if ($totalPages > 10)
                    <li class="page-item">
                        <a class="page-link" href="#" wire:click.prevent="goToPage({{ $pageRange[count($pageRange)-1] + 1 }})">+{{ $totalPages - 10 }}</a>
                    </li>
                @endif

                <!-- Next Button -->
                <li class="page-item {{ $currentPage == $totalPages ? 'disabled' : '' }}">
                    <a class="page-link" href="#" wire:click.prevent="nextPage">Next</a>
                </li>
            </ul>
        </nav>
    </div>
    @script
    <script>
        // $wire.on('dupeSubmitted', () => {
        //     $('#formClose').click();
        //     $('#btn123456').click();
        // });
        // $wire.on('exportError', () => {
        //     Swal.fire({
        //         title: 'Please search keyword',
        //         icon: 'error',
        //         confirmButtonText: 'OK',
        //         allowOutsideClick: false, // Prevent closing by clicking outside
        //         allowEscapeKey: false,   // Prevent closing with the Escape key
        //     }).then((result) => {
        //         if (result.isConfirmed) {
        //             // Optional: Add any logic here if needed after clicking "OK"
        //         }
        //     });
        // });

        $wire.on('goodEditRemark', () => {
            Swal.fire({
                title: 'Successfully Saved!',
                icon: 'success',
                confirmButtonText: 'OK',
                allowOutsideClick: false, // Prevent closing by clicking outside
                allowEscapeKey: false,   // Prevent closing with the Escape key
            }).then((result) => {
                if (result.isConfirmed) {
                    location.reload(); // Reload the page when "OK" is clicked
                }
            });
        });

        $wire.on('badEditRemark', () => {
            Swal.fire({
                title: 'Failed to save!',
                icon: 'error',
                confirmButtonText: 'OK',
                allowOutsideClick: false, // Prevent closing by clicking outside
                allowEscapeKey: false,   // Prevent closing with the Escape key
            }).then((result) => {
                if (result.isConfirmed) {
                    // Optional: Add any logic here if needed after clicking "OK"
                }
            });
        });
    </script>
    @endscript

</div>

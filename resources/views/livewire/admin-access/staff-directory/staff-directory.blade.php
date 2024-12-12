<div>
    @include('modal.news-update.show-photo')
    @include('modal.staff-directory.viewDetail')
    <div>
        <div class="row">
            <div class="col-lg-3 col-xl-2 pt-lg-2">
                <h6>STAFF DIRECTORY</h6>
            </div>
            <div class="col-sm-8 col-lg-6 mt-1 mt-lg-0 col-xl-5">
                <input class="form-control" type="search" placeholder="Search" aria-label="Search" wire:model.live="search">
            </div>
            <div class="col-12 col-sm-4 col-lg-3 col-xl-3 mt-2 mt-sm-1 mt-lg-0">
                <select class="form-select" aria-label="Default select example" wire:model.live="empStat" id="staffStat">
                    <option value="all">All</option>
                    <option value=1>Active</option>
                    <option value=0>Inactive</option>
                </select>
            </div>
        </div>
        <div class="mt-3 mt-sm-5 mt-md-4 mt-lg-5 text-end">
            @if(count($checkBox) == 1)
                <i class="fa-solid fa-eye text-primary" style="cursor: pointer" wire:click="clickView"
                   data-bs-toggle="modal" data-bs-target="#viewDetail"></i>
{{--                <i class="fa-solid fa-pen-to-square ms-3" style="cursor: pointer"></i>--}}
{{--                <i class="fa-solid fa-trash ms-3 text-danger" style="cursor: pointer;" title="Delete" onclick="delStaffBtn()"></i>--}}
            @elseif(count($checkBox) > 1)
{{--                <i class="fa-solid fa-trash ms-3 text-danger" style="cursor: pointer" title="Delete" onclick="delStaffBtn()"></i>--}}
            @endif
        </div>
        <div class="table-responsive" style="font-size: 14px">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Fullname</th>
                    <th scope="col">Work email</th>
                    <th scope="col">Phone</th>
                    <th scope="col">DOB</th>
                    <th scope="col">Position</th>
                    <th scope="col">Depart.</th>
{{--                    <th scope="col">Branch</th>--}}
                    <th scope="col">Act/Inact</th>
                    <th scope="col">QR</th>
                </tr>
                </thead>
                <tbody>
                @php $i=0; @endphp
                @foreach($staffData as $data)
                    <tr x-data
                        @dblclick="$dispatch('openDetailsStaff', { id: {{ $data->id }} })"  onmouseover="hoverStaff({{$data->id}})" onmouseout="hoverOutStaff({{$data->id}})" class="ngh">
                        <td>
                            {{$data->id_user}}
                        </td>
{{--                        <td class="text-end pe-4">--}}
{{--                            <div class="profile-picture-staff">--}}
{{--                                <img src="{{asset('photos/photos/'.$data->photo)}}" alt="Profile Picture">--}}
{{--                                @if($data->status == 1) <span class="status-indicator"></span> @endif--}}
{{--                            </div>--}}
{{--                        </td>--}}
                        <td>
                            {{ucwords($data->fname.' '.$data->mi.' '.$data->lname)}}
                        </td>
                        <td>
                            {{$data->current_working_email}}
                        </td>
                        <td>
                            {{$data->phone_number}}
                        </td>
                        <td>
                            {{$data->dob}}
                        </td>
                        <td>
                            {{ucwords($data->designation)}}
                        </td>
                        <td>
                            {{$data->department}}
                        </td>
{{--                        <td>--}}
{{--                            {{ucwords($data->branch)}}--}}
{{--                        </td>--}}
                        <td>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked{{$i}}"
                                   data-index="{{$i}}" data-id="{{$data->id}}" value="{{$stat[$i]}}"
                                   wire:model="stat.{{$i}}"
                                   onchange="handleStatusChange(this)"
                                >
                            </div>
                        </td>
                        <td>
                            <i class="fa-solid fa-qrcode" onclick="window.open('/qr-code/create/{{$data->id_user}}', '_blank');" style="cursor: pointer"></i>
                        </td>
{{--                        <td>--}}
{{--                            <input class="form-check-input" type="checkbox" wire:model.live="checkBox"--}}
{{--                                   value="{{$data->id}}" id="flexCheckDefault{{$data->id}}"--}}
{{--                                   style="font-size: 18px; cursor: pointer">--}}
{{--                        </td>--}}
                    </tr>
                    @php $i++; @endphp
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-6 col-lg-3 col-xl-3">
            <button class="btn btn-success w-100" id="staff-prev-btn">Previous</button>
        </div>
        <div class="col-12 col-md-6 col-lg-3 col-xl-3 mt-2 mt-md-0">
            <button class="btn btn-primary w-100" id="staff-next-btn">Next</button>
        </div>
    </div>
    @script
    <script>
        $wire.on('save', () => {
            Swal.fire({
                title: 'SUCCESS!',
                text: 'Successfully Saved.',
                icon: 'success',
                allowOutsideClick: false, // Prevent closing by clicking outside
                allowEscapeKey: false // Prevent closing with the escape key
            }).then((result) => {
                if (result.isConfirmed) {
                    location.reload();
                }
            });
        });

        $wire.on('failed', () => {
            Swal.fire({
                title: 'FAILED!',
                text: '',
                icon: 'error',
                allowOutsideClick: false, // Prevent closing by clicking outside
                allowEscapeKey: false // Prevent closing with the escape key
            }).then((result) => {
                if (result.isConfirmed) {
                    location.reload();
                }
            });
        });
        $wire.on('remove-loading', (event) => {
            setTimeout(() => {
                JsLoadingOverlay.hide();
            }, 1000); // Delay of 2 seconds (2000 milliseconds)
        });
        $wire.on('success', (event) => {
            Swal.fire({
                title: 'Success!',
                text: 'Successfully deleted', // Message from the Livewire component
                icon: 'success',
                confirmButtonText: 'OK'
            });
        });
        $wire.on('error', (event) => {
            Swal.fire({
                title: 'Failed!',
                text: 'Failed to delete', // Message from the Livewire component
                icon: 'error',
                confirmButtonText: 'OK'
            });
        });
    </script>
    @endscript
</div>
@push('js')
    <script>
        document.addEventListener('show-detail-staff', function () {
            const positionModal = new bootstrap.Modal(document.getElementById('viewDetail'));
            positionModal.show();
        });

        function delStaffBtn(){
            Swal.fire({
                title: 'Are you sure?',
                text: "This action will permanently delete all data associated with this account and cannot be reversed. Do you wish to continue?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.dispatch('delete')
                }
            })
        }

        $(document).ready(function() {
            $('#staffStat').on('change', function() {
                JsLoadingOverlay.show({
                    overlayBackgroundColor: '#666666',
                    overlayOpacity: 0.6,
                    spinnerIcon: 'ball-pulse',  // Choose your spinner icon
                    spinnerColor: '#ffffff',
                    spinnerSize: '2x'
                });

            });
        });
        function handleStatusChange(element) {
            JsLoadingOverlay.show({
                overlayBackgroundColor: '#666666',
                overlayOpacity: 0.6,
                spinnerIcon: 'ball-pulse',  // Choose your spinner icon
                spinnerColor: '#ffffff',
                spinnerSize: '2x'
            });
            // Retrieve the index and data ID from data attributes
            const index = element.getAttribute('data-index');
            const dataId = element.getAttribute('data-id');
            Livewire.dispatch('status',{
                data: {
                    index: index,
                    dataId: dataId
                }
            });
            // Example: Make an AJAX request or trigger other actions
            // You can pass 'index' and 'dataId' to your backend or handle as needed
        }
        document.getElementById('staff-prev-btn').addEventListener('click', function () {
            // Show loading overlay
            JsLoadingOverlay.show({
                overlayBackgroundColor: '#666666',
                overlayOpacity: 0.6,
                spinnerIcon: 'ball-pulse',  // Choose your spinner icon
                spinnerColor: '#ffffff',
                spinnerSize: '2x'
            });
            Livewire.dispatch('previousPage')
        });
        document.getElementById('staff-next-btn').addEventListener('click', function () {
            // Show loading overlay
            JsLoadingOverlay.show({
                overlayBackgroundColor: '#666666',
                overlayOpacity: 0.6,
                spinnerIcon: 'ball-pulse',  // Choose your spinner icon
                spinnerColor: '#ffffff',
                spinnerSize: '2x'
            });
            Livewire.dispatch('nextPage')
        });
    </script>
@endpush

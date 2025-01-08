{{--<div>--}}
{{--    @include('modal.timeshare-callback.viewDetail')--}}
{{--    @include('modal.timeshare-callback.add')--}}
{{--    <div>--}}
{{--        <i class="fa-solid fa-arrow-left" onclick="location.href = '/production-lead-mass-tort';" style="cursor: pointer"></i>--}}
{{--        <h6>MY CALLBACK (Timeshare)</h6>--}}
{{--    </div>--}}
{{--    <div class="row  mt-3 mt-md-4">--}}
{{--        <div class="col-sm-5 col-lg-3 col-xl-2">--}}
{{--            <button class="btn btn-secondary dropdown-toggle w-100" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">--}}
{{--                MASS TORT--}}
{{--            </button>--}}
{{--            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">--}}
{{--                <li><a class="dropdown-item" href="/my-callback/timeshare">Timeshare</a></li>--}}
{{--                <li><a class="dropdown-item" href="/my-callback/masstort">Mass Tort</a></li>--}}
{{--                --}}{{--                <li><a class="dropdown-item" href="/my-callback/homesec">Home Sec</a></li>--}}
{{--            </ul>--}}
{{--        </div>--}}
{{--        <div class="col-sm-7 col-lg-5 col-xl-5 mt-2 mt-sm-0">--}}
{{--            <input class="form-control w-100" type="search" placeholder="Search" aria-label="Search" wire:model.live="search">--}}
{{--        </div>--}}
{{--        <div class="col-sm-3 col-lg-5 col-xl-5 mt-2 ">--}}
{{--            <i class="fa-solid fa-circle-plus" style="font-size: 18px; cursor: pointer" data-bs-toggle="modal" data-bs-target="#add"></i>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="text-center">--}}
{{--        <div class="spinner-border mt-5" role="status" wire:loading>--}}
{{--            <span class="visually-hidden">Loading...</span>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div><p style="color: red; margin-top: 10px;">Double click row data to view full details</p></div>--}}
{{--    <hr>--}}
{{--    <div style="font-size: 13px;" class="table-responsive" wire:loading.remove>--}}
{{--        <table class="table table-striped">--}}
{{--            <thead>--}}
{{--            <tr>--}}
{{--                <th scope="col" style="width: 9%;">Tracker ID</th>--}}
{{--                <th scope="col" style="width: 9%;">Date</th>--}}
{{--                <th scope="col" style="width: 9%;">Agent</th>--}}
{{--                <th scope="col" style="width: 9%;">Guest 1</th>--}}
{{--                <th scope="col" style="width: 9%;">Guest 2</th>--}}
{{--                <th scope="col" style="width: 9%;">Phone</th>--}}
{{--                <th scope="col" style="width: 9%;">Alt. Phone</th>--}}
{{--                <th scope="col" style="width: 9%;">Email</th>--}}
{{--                <th scope="col" style="width: 15%;">Remarks</th>--}}
{{--            </tr>--}}
{{--            </thead>--}}
{{--            <tbody>--}}
{{--            @foreach($submissionData as $data)--}}
{{--                <tr @if($data->is_expired == "1") style=" background-color: #FF2828; color: white" @endif x-data--}}
{{--                    @dblclick="$dispatch('viewDetail', { id: {{ $data->id }} })" >--}}
{{--                    --}}{{--                <tr wire:click="viewDetail({{$data->id}})" data-bs-toggle="modal" data-bs-target="#viewDetail" style="cursor: pointer">--}}
{{--                    <td>--}}
{{--                        {{$data->id}}--}}
{{--                    </td>--}}
{{--                    <td>--}}
{{--                        {{$data->date}}--}}
{{--                    </td>--}}
{{--                    <td>--}}
{{--                        {{$data->agent}}--}}
{{--                    </td>--}}
{{--                    <td>--}}
{{--                        {{$data->guest1}}--}}
{{--                    </td>--}}
{{--                    <td>--}}
{{--                        {{$data->guest2}}--}}
{{--                    </td>--}}
{{--                    <td>--}}
{{--                        {{$data->phoneNumber}}--}}
{{--                    </td>--}}
{{--                    <td>--}}
{{--                        {{$data->altPhoneNumber}}--}}
{{--                    </td>--}}
{{--                    <td>--}}
{{--                        {{ucwords($data->email)}}--}}
{{--                    </td>--}}
{{--                    <td>--}}
{{--                        @if($data->reason == "")--}}
{{--                            {{ucwords($data->remarks)}}--}}
{{--                        @else--}}
{{--                            {{ucwords($data->remarks)}} - {{$data->reason}}--}}
{{--                        @endif--}}
{{--                    </td>--}}
{{--                    <td>--}}
{{--                        {{$data->timeRemaining }} hrs.--}}
{{--                    </td>--}}
{{--                </tr>--}}
{{--            @endforeach--}}
{{--            </tbody>--}}
{{--        </table>--}}
{{--        <div class="row">--}}
{{--            <div class="col-12 col-md-6 col-lg-3 col-xl-2">--}}
{{--                <button class="btn btn-success w-100" wire:click="previousPage">Previous</button>--}}
{{--            </div>--}}
{{--            <div class="col-12 col-md-6 col-lg-3 col-xl-2 mt-2 mt-md-0">--}}
{{--                <button class="btn btn-primary w-100" wire:click="nextPage">Next</button>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    @script--}}
{{--    <script>--}}
{{--        $wire.on('success', () => {--}}
{{--            Swal.fire(--}}
{{--                'SUCCESS!',--}}
{{--                'Successfully Updated .',--}}
{{--                'success'--}}
{{--            ).then((result) => {--}}
{{--                if (result.isConfirmed) {--}}
{{--                    location.reload();--}}
{{--                }--}}
{{--            });--}}
{{--        });--}}
{{--        $wire.on('failed', () => {--}}
{{--            Swal.fire(--}}
{{--                'FAILED!',--}}
{{--                '',--}}
{{--                'error'--}}
{{--            )--}}
{{--        });--}}
{{--        $wire.on('show-detailss-modal', () => {--}}
{{--            const positionModal = new bootstrap.Modal(document.getElementById('viewDetail'));--}}
{{--            positionModal.show();--}}
{{--        });--}}
{{--    </script>--}}
{{--    @endscript--}}
{{--</div>--}}
<div><h1>TINATAPOS PA PO!!!</h1></div>

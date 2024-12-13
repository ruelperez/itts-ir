<div>
    @include('modal.slip.deduct')
    @include('modal.slip.view-more')
{{--    @include('modal.news-update.show-photo')--}}
{{--    @include('modal.dtr_record.dtrRecord')--}}
    <div class="mb-4">
        <h6>Daily Shift</h6>
    </div>
    <div class="row">
        <div class="col-12 col-sm-6 col-lg-3 col-xl-3">
            <input type="text" class="form-control" placeholder="Year" wire:model="year">
        </div>
        <div class="col-12 col-sm-6 col-lg-3 col-xl-3 mt-2 mt-sm-0">
            <select class="form-select" aria-label="Default select example" wire:model="month">
                <option value="01">January</option>
                <option value="02">February</option>
                <option value="03">March</option>
                <option value="04">April</option>
                <option value="05">May</option>
                <option value="06">June</option>
                <option value="07">July</option>
                <option value="08">August</option>
                <option value="09">September</option>
                <option value="10">October</option>
                <option value="11">November</option>
                <option value="12">December</option>
            </select>
        </div>
        <div class="col-12 col-sm-6 col-lg-3 col-xl-3 mt-2 mt-lg-0">
            <select class="form-select" aria-label="Default select example" wire:model="day">
                @for($n=1; $n<=31; $n++)
                    <option value={{$n}}>{{$n}}</option>
                @endfor
            </select>
        </div>
{{--        <div class="col-12 col-sm-6 col-lg-3 col-xl-3 mt-2 mt-lg-0">--}}
{{--            <select class="form-select" aria-label="Default select example" wire:model="role">--}}
{{--                <option value="all">All</option>--}}
{{--                <option value="Agent">Agent</option>--}}
{{--                <option value="Admin">Admin</option>--}}
{{--                <option value="task executor">Task Executor</option>--}}
{{--            </select>--}}
{{--        </div>--}}
        <div class="text-start mt-4 mt-lg-2 col-sm-4 col-lg-3">
            <i class="fa-solid fa-rotate" style="font-size: 20px; cursor: pointer" id="generateButton"></i>
        </div>
    </div>
    <div class="row mt-4 mt-xl-5">
        <div class="col-6">
            <b style="font-size: 15px; ">{{$month}}-{{$day}}-{{$year}}</b>
        </div>
    </div>
    <div class="table-responsive" style="font-size: 13px;">
        <table class="table table-hover" >
            <thead>
            <tr>
                <th scope="col" class="bg-success text-white">Name</th>
                <th scope="col" class="bg-success text-white">In</th>
                <th scope="col" class="bg-success text-white">Out</th>
                <th scope="col" class="bg-success text-white">In</th>
                <th scope="col" class="bg-success text-white">Out</th>
                <th scope="col" class="bg-warning text-dark">Late in</th>
                <th scope="col" class="bg-warning text-dark">Early out</th>
                <th scope="col" class="bg-warning text-dark">Late in</th>
                <th scope="col" class="bg-warning text-dark">Early out</th>
                <th scope="col" class="bg-warning text-dark">Total (Late/early) </th>
                <th scope="col" class="bg-primary text-white">Rate</th>
                <th scope="col" class="bg-danger text-white">Total deduct.</th>
                <th scope="col" class="bg-info text-dark">Total Pay</th>
{{--                <th scope="col">Sched in</th>--}}
{{--                <th scope="col">Sched in</th>--}}
{{--                <th scope="col">Sched out</th>--}}
{{--                <th scope="col">Sched in</th>--}}
{{--                <th scope="col">Sched out</th>--}}

            </tr>
            </thead>
            <tbody>
            @foreach($dtrData as $datass)
                <tr>
                    <td class="p-3">
                        {{ $datass->fullname}}
                    </td>
                    <td class="p-3">
                        {{ \Carbon\Carbon::parse($datass->in)->format('h:i A') }}
                    </td>
                    <td class="p-3">
                        {{ \Carbon\Carbon::parse($datass->out)->format('h:i A') }}
                    </td>
                    <td class="p-3">
                        {{ \Carbon\Carbon::parse($datass->in2)->format('h:i A') }}
                    </td>
                    <td class="p-3">
                        {{ \Carbon\Carbon::parse($datass->out2)->format('h:i A') }}
                        @if($datass->isEarlyOut == 1) <b style="color: white; background-color: red" class="px-2">Early out</b> @endif
                    </td>
                    <td class="p-3">
                        {{$datass->lateIn}}
                    </td>
                    <td class="p-3">
                        {{$datass->lateIn2}}
                    </td>
                    <td class="p-3">
                        {{$datass->lateOut}}
                    </td>
                    <td class="p-3">
                        {{$datass->lateOut2}}
                    </td>
                    <td class="p-3">
                        {{$datass->totalLate}}
                    </td>
                    <td class="p-3">
                        {{$datass->salary_summary['salary_total'] ?? 0 }}
                    </td>
{{--                    <td class="p-3">--}}
{{--                        {{$datass->schedIn}}--}}
{{--                    </td>--}}
{{--                    <td class="p-3">--}}
{{--                        {{$datass->schedOut}}--}}
{{--                    </td>--}}
{{--                    <td class="p-3">--}}
{{--                        {{$datass->schedIn2}}--}}
{{--                    </td>--}}
{{--                    <td class="p-3">--}}
{{--                        {{$datass->schedOut2}}--}}
{{--                    </td>--}}
                    <td class="p-3">
                        {{$datass->salary_summary['total_deduction'] ?? 0 }}
                    </td>
                    <td class="p-3">
                        @php $ff = $datass->salary_summary['salary_total'] - $datass->salary_summary['total_deduction'] @endphp
{{$ff}}
                    </td>
                    <td class="d-flex">
                        <i class="fa-solid fa-square-minus" style="cursor: pointer; font-size: 15px;" data-bs-toggle="modal" data-bs-target="#deduct" wire:click="deduct({{$datass->id}})"></i>
                        <i class="fa-solid fa-eye ms-3 text-primary" style="cursor: pointer; font-size: 15px;" data-bs-toggle="modal" data-bs-target="#view_more" wire:click="view_more({{$datass->id}})"></i>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    @script
    <script>
        $wire.on('loadingsss', (event) => {
            JsLoadingOverlay.hide();
        });
    </script>
    @endscript
</div>
@push('js')
    <script>
        document.getElementById('generateButton').addEventListener('click', function () {
            // Show loading overlay
            JsLoadingOverlay.show({
                overlayBackgroundColor: '#666666',
                overlayOpacity: 0.6,
                spinnerIcon: 'ball-pulse',  // Choose your spinner icon
                spinnerColor: '#ffffff',
                spinnerSize: '2x'
            });

            Livewire.dispatch('gen')
        });
    </script>
@endpush



<div>
    @include('modal.callback-tracker.viewDetail')
    @include('modal.callback-tracker.add')
    <div class="row  mt-3 mt-md-4">
        <div class="col-sm-7 col-lg-5 col-xl-5 mt-2 mt-sm-0">
            <input class="form-control w-100" type="search" placeholder="Search" aria-label="Search" wire:model.live="search">
        </div>
{{--        <div class="col-sm-3 col-lg-5 col-xl-5 mt-2 ">--}}
{{--            <i class="fa-solid fa-circle-plus" style="font-size: 18px; cursor: pointer" data-bs-toggle="modal" data-bs-target="#add"></i>--}}
{{--        </div>--}}
    </div>
{{--    <div class="text-center">--}}
{{--        <div class="spinner-border mt-5" role="status" wire:loading>--}}
{{--            <span class="visually-hidden">Loading...</span>--}}
{{--        </div>--}}
{{--    </div>--}}
    <hr>
    <div style="font-size: 13px;" class="table-responsive border">
        <table class="table table-striped w-100">
            <thead>
            <tr>
                <th scope="col" >Date</th>
                <th scope="col" >Agent</th>
                <th scope="col" >Campaign</th>
                <th scope="col" >Guest 1</th>
                <th scope="col" >Guest 2</th>
                <th scope="col" >Phone#</th>
                <th scope="col" >Email</th>
                <th scope="col" >Email</th>
                <th scope="col">Reason</th>
                <th scope="col">Time left</th>
            </tr>
            </thead>
            <tbody>
            @foreach($submissionData as $data)
                <tr @if($data->is_expired == "1") style=" background-color: #FF2828; color: white" @endif x-data
                    @dblclick="$dispatch('openDetailsModal', { id: {{ $data->id }} })" >
                    {{--                <tr wire:click="viewDetail({{$data->id}})" data-bs-toggle="modal" data-bs-target="#viewDetail" style="cursor: pointer">--}}
                    <td>
                        {{ $data->created_at->format('m/d/Y h:i A') }}
                    </td>
                    <td>
                        {{$data->user->fullname ?? 'N/A'}}
                    </td>
                    <td>
                        {{$data->campaign}}
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
                        {{$data->email}}
                    </td>
                    <td>
                        {{$data->reason}}
                    </td>
                    <td>
                        {{$data->timeRemaining }} hrs.
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="row">
            <div class="col-12 col-md-6 col-lg-3 col-xl-2">
                <button class="btn btn-success w-100" wire:click="previousPage">Previous</button>
            </div>
            <div class="col-12 col-md-6 col-lg-3 col-xl-2 mt-2 mt-md-0">
                <button class="btn btn-primary w-100" wire:click="nextPage">Next</button>
            </div>
        </div>
    </div>
    @script
        <script>
            $wire.on('success', () => {
                $('#btnclose122').click();
                Swal.fire({
                    title: 'Updated!',
                    text: 'Successfully Updated.',
                    icon: 'success',
                    confirmButtonText: 'OK',
                    allowOutsideClick: false, // Prevent closing by clicking outside
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.dispatch('enablePolling');
                        window.location.reload(); // Reload the page
                    }
                });
            });
            $wire.on('error', () => {
                $('#btnclose122').click();
                Swal.fire(
                    'Updated!',
                    'Failed to Update.',
                    'error'
                );
            });
        </script>
    @endscript
</div>
<script>
    document.addEventListener('show-remark-modal', function () {
        const positionModal = new bootstrap.Modal(document.getElementById('remarkModal'));
        positionModal.show();
    });
    document.addEventListener('show-detail-modal', function () {
        const positionModal = new bootstrap.Modal(document.getElementById('viewDetailModal'));
        positionModal.show();
    });

</script>

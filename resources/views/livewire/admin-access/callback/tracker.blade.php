<div>
    @include('modal.callback.viewDetail')
    @include('modal.callback.add')
    <div class="modal fade" id="remarkModal" tabindex="-1" aria-labelledby="positionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="positionModalLabel">Update Callback Remark</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="submitEditRemark">
                    <div class="modal-body">
                        <select id="positionSelect" class="form-select" wire:model="remark" required>
                            <option value="">Select remark</option>
                            <option value="Qualified">Qualified</option>
                            <option value="Disqualified">Disqualified</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                    <button type="button" class="btn-close d-none" data-bs-dismiss="modal" id="btnclose122" aria-label="Close"></button>
                </form>
            </div>
        </div>
    </div>
    <div>
        <i class="fa-solid fa-arrow-left" onclick="location.href = '/production-lead-mass-tort';" style="cursor: pointer"></i>
        <h6>CALLBACK TRACKER</h6>
    </div>
    <div class="row  mt-3 mt-md-4">
        <div class="col-sm-7 col-lg-5 col-xl-5 mt-2 mt-sm-0">
            <input class="form-control w-100" type="search" placeholder="Search" aria-label="Search" wire:model.live="search">
        </div>
{{--        <div class="col-sm-3 col-lg-5 col-xl-5 mt-2 ">--}}
{{--            <i class="fa-solid fa-circle-plus" style="font-size: 18px; cursor: pointer" data-bs-toggle="modal" data-bs-target="#add"></i>--}}
{{--        </div>--}}
    </div>
    <div class="mt-3"><button type="button" class="btn btn-danger">Unremarked <b>({{$countUnmarked}})</b> </button></div>
    <div class="text-center">
        <div class="spinner-border mt-5" role="status" wire:loading>
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
    <hr>
    <div style="font-size: 14px;" class="table-responsive border" wire:loading.remove>
        <table class="table table-striped w-100">
            <thead>
            <tr>
                <th scope="col" >Date</th>
                <th scope="col" >Agent</th>
                <th scope="col" >Campaign</th>
                <th scope="col" >Claimant</th>
                <th scope="col" >Injured party</th>
                <th scope="col" >Phone #</th>
                {{--                <th scope="col" style="width: 9%;">Alt Phone #</th>--}}
                <th scope="col" >Email</th>
                {{--                <th scope="col" style="width: 9%;">DOB</th>--}}
                {{--                <th scope="col" style="width: 9%;">Address</th>--}}
                {{--                <th scope="col" style="width: 9%;">Callback time</th>--}}
                <th scope="col">Reason</th>
                <th scope="col">Time left</th>
                <th scope="col" >Is expired</th>
                <th scope="col" >Remarks</th>
                <th scope="col" >Marked by:</th>
            </tr>
            </thead>
            <tbody>
            @foreach($submissionData as $data)
                <tr @if($data->is_expired == "1") style=" background-color: #FF2828; color: white" @endif>
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
                        {{$data->claimant}}
                    </td>
                    <td>
                        {{$data->injuredParty}}
                    </td>
                    <td>
                        {{$data->phoneNumber}}
                    </td>
                    {{--                    <td>--}}
                    {{--                        {{$data->altPhoneNumber}}--}}
                    {{--                    </td>--}}
                    <td>
                        {{$data->email}}
                    </td>
                    {{--                    <td>--}}
                    {{--                        {{$data->dob}}--}}
                    {{--                    </td>--}}
                    {{--                    <td>--}}
                    {{--                        {{$data->address}}--}}
                    {{--                    </td>--}}
                    {{--                    <td>--}}
                    {{--                        {{$data->callbackTime}}--}}
                    {{--                    </td>--}}
                    <td>
                        {{$data->reason}}
                    </td>
                    <td>
                        {{$data->timeRemaining }} hrs.
                    </td>
                    <td style="padding: 0; width: 1%; text-align: center;">
                        <p style="margin: 0; padding: 0;">{{$data->is_expired ? 'Yes' : 'No' }}</p>
                    </td>
                    <td x-data
                        @dblclick="$dispatch('openRemarksModal', { id: {{ $data->id }} })" >
                        <p style="cursor: pointer">@if($data->remark == null)  @elseif($data->remark == "Qualified") <i class="fa-solid fa-circle-check" style="color: green; font-size: 20px"></i>@elseif($data->remark == "Disqualified") <i class="fa-solid fa-circle-xmark" style="color: red; font-size: 20px"></i> @endif</p>
                    </td>
                    <td>
                        {{$data->markBy}}
                    </td>
{{--                    <td>--}}
{{--                        {{$data->remark}}--}}
{{--                    </td>--}}
                    <td class="eye-icon" style="padding: 0; width: 1%; text-align: center;">
                        <i class="fa-regular fa-eye" style="margin: 0; padding: 0; cursor: pointer" wire:click="viewDetail({{$data->id}})" data-bs-toggle="modal" data-bs-target="#viewDetail"></i>
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
            $wire.on('success', () => {btnclose122
                $('#btnclose122').click();
                Swal.fire(
                    'Updated!',
                    'Successfully Updated .',
                    'success'
                );
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

</script>

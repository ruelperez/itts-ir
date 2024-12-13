<div>
    @include('modal.slip.add-rate')
    <div class="row mb-3">
        <div class="col-sm-6 col-md-4 col-lg-4 col-xl-3">
           Employee Salary Rate (Per Day)
        </div>
    </div>
    <div class="d-flex">
        <p>({{$name}})</p>
        <i class="fa-solid fa-circle-plus ms-5 mt-1" style="color: green; font-size: 18px; cursor: pointer" data-bs-toggle="modal" data-bs-target="#rate"></i>
    </div>
    <hr>
    <div class="table-responsive mt-lg-4" style="font-size: 13px;">
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">Created</th>
                <th scope="col">Basic Pay</th>
                <th scope="col">Night Diff</th>
                <th scope="col">Allowance</th>
                <th scope="col">Holiday</th>
                <th scope="col">Overtime</th>
                <th scope="col">Other</th>
                <th scope="col">Total</th>
            </tr>
            </thead>
            <tbody>
            @php $n=0; @endphp
            @foreach($data as $datas)
                @php $b=0; @endphp
                <tr @if($n >= 1) class="text-muted" @else class="fw-bold" @endif >
                    <td>
                        {{$datas->updated_at->format('m-d-Y (h:i A)')}}
                    </td>
                    <td>
                        {{$datas->basic}}
                    </td>
                    <td>
                        {{$datas->nightDiff}}
                    </td>
                    <td>
                        {{$datas->allowance}}
                    </td>
                    <td>
                        {{$datas->holiday}}
                    </td>
                    <td>
                        {{$datas->ot}}
                    </td>
                    <td>
                        {{$datas->other}}
                    </td>
                    <td>
                        {{$datas->total}}
                    </td>
                    @if($n >= 1)

                    @else
                        <td>
                            <b style="background-color: green; color: white;" class="px-2">Active</b>
                        </td>
                    @endif
                </tr>
                @php $n++; @endphp
            @endforeach
            </tbody>
        </table>
    </div>
    @script
    <script>
        $wire.on('success', () => {
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
    </script>
    @endscript
</div>

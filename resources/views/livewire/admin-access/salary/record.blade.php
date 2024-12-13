<div>
    <div class="row">
        <div class="col-lg-3 col-xl-2 pt-lg-2">
            <h6>Salary Record</h6>
        </div>
        <div class="col-sm-8 col-lg-6 mt-1 mt-lg-0 col-xl-5">
            <input class="form-control" type="search" placeholder="Search date" aria-label="Search"
                   wire:model.live="search">
        </div>
        {{--        <div class="col-12 col-sm-4 col-lg-3 col-xl-3 mt-2 mt-sm-1 mt-lg-0 pt-2">--}}
        {{--            <button type="button " class="btn btn-warning w-100" data-bs-toggle="modal" data-bs-target="#addStatement"><i class="fa-solid fa-list me-2"></i>Salary statement</button>--}}
        {{--            <i class="fa-solid fa-circle-plus" style="font-size: 22px; cursor: pointer" data-bs-toggle="modal" data-bs-target="#addStatement"></i>--}}
        {{--        </div>--}}
    </div>
    <hr>
    <div class="row mt-4 mt-lg-5">
        <div class="col-md-8 order-lg-2 col-lg-5">
            <div style="background-color: #F5F5F5; box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.5);" class="px-3 py-3">
                <form wire:submit.prevent="submit">
                    <div class="mb-3">
                        <b>Add New Record</b>
                    </div>
                    <div>
                        <label class="form-label">Start Date</label>
                        <input type="text" id="datepicker" class="form-control" wire:model="start" required>
                    </div>
                    <div>
                        <label class="form-label mt-4">End Date</label>
                        <input type="text" id="datepicker" class="form-control" wire:model="end" required>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-warning w-100 mt-4">SUBMIT</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="mt-4 mt-sm-5 order-lg-1 col-lg-7 mt-lg-0">
            <ul class="list-group list-group-flush">
                @foreach($data as $datas)
{{--                    <li class="list-group-item">--}}
{{--                        <p class="hover-text"--}}
{{--                           onclick="location.href = '/admin-access/salary/agent-salary-statement/{{$datas->id}}';">{{$datas->start}}--}}
{{--                            - {{$datas->end}}</p>--}}
{{--                    </li>--}}
                    <li class="list-group-item">
                        <p>{{$datas->start}}
                            - {{$datas->end}}</p>
                    </li>
                @endforeach
            </ul>
        </div>
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

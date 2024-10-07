<div>
    <div>
        <button class="btn btn-primary dropdown-toggle w-100" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
            {{$campaignName}}
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
            <li><a class="dropdown-item" href="/eod/masstort-tracker">Mass Tort</a></li>
{{--            <li><a class="dropdown-item" href="/eod/dtv-tracker">Direct TV</a></li>--}}
        </ul>
    </div>
    <div class="row">
        <div class="border px-2 py-2 mt-3" style="background-color: #696969; color: white;">
            <div class="text-center">Sales Report</div>
            <div class="row">
                <div class="mt-3">
                    <label class="form-label">From</label>
                    <input type="text" id="datepicker" class="form-control" wire:model="start" required>
                    @error('start') <span style="color: #8B0000">{{ $message }}</span> @enderror
                </div>
                <div class="mt-3">
                    <label class="form-label">To</label>
                    <input type="text" id="datepicker" class="form-control" wire:model="end" required>
                    @error('end') <span style="color: #8B0000">{{ $message }}</span> @enderror
                </div>
                <div class="mt-3 text-center">
                    <i class="fa-solid fa-rotate" style="font-size: 27px; cursor: pointer" wire:click="generate" wire:loading.remove></i>
                </div>
            </div>
            <div class="text-center">
                <div class="spinner-border mt-5" role="status" wire:loading>
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
            <div style="font-size: 13px;" class="table-responsive mt-3" wire:loading.remove>
                <table class="table text-white">
                    <thead>
                    <tr>
                        <th scope="col">Campaign</th>
                        <th scope="col">Counts</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($salesData as $data)
                        <tr>
                            <td>
                                {{$data->campaign}}
                            </td>
                            <td>
                                {{$data->count}}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="border px-2 py-2 mt-3" style="background-color: #696969; color: white;">
            <div class="text-center">Submission Report</div>
            <div class="row">
                <div class="mt-3">
                    <label class="form-label">From</label>
                    <input type="text" id="datepicker" class="form-control" wire:model="start" required>
                    @error('start') <span style="color: #8B0000">{{ $message }}</span> @enderror
                </div>
                <div class="mt-3">
                    <label class="form-label">To</label>
                    <input type="text" id="datepicker" class="form-control" wire:model="end" required>
                    @error('end') <span style="color: #8B0000">{{ $message }}</span> @enderror
                </div>
                <div class="mt-3 text-center">
                    <i class="fa-solid fa-rotate" style="font-size: 27px; cursor: pointer" wire:click="generate" wire:loading.remove></i>
                </div>
            </div>
            <div class="text-center">
                <div class="spinner-border mt-5" role="status" wire:loading>
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
            <div style="font-size: 13px;" class="table-responsive mt-3" wire:loading.remove>
                <table class="table text-white">
                    <thead>
                    <tr>
                        <th scope="col">Campaign</th>
                        <th scope="col">Counts</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($salesData as $data)
                        <tr>
                            <td>
                                {{$data->campaign}}
                            </td>
                            <td>
                                {{$data->count}}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="border px-2 py-2 mt-3" style="background-color: #696969; color: white;">
            <div class="text-center">Employee Sales Report</div>
            <div class="row">
                <div class="mt-3">
                    <label class="form-label">From</label>
                    <input type="text" id="datepicker" class="form-control" wire:model="start" required>
                    @error('start') <span style="color: #8B0000">{{ $message }}</span> @enderror
                </div>
                <div class="mt-3">
                    <label class="form-label">To</label>
                    <input type="text" id="datepicker" class="form-control" wire:model="end" required>
                    @error('end') <span style="color: #8B0000">{{ $message }}</span> @enderror
                </div>
                <div class="mt-3 text-center">
                    <i class="fa-solid fa-rotate" style="font-size: 27px; cursor: pointer" wire:click="generate" wire:loading.remove></i>
                </div>
            </div>
            <div class="text-center">
                <div class="spinner-border mt-5" role="status" wire:loading>
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
            <div style="font-size: 13px;" class="table-responsive mt-3" wire:loading.remove>
                <table class="table text-white">
                    <thead>
                    <tr>
                        <th scope="col">Campaign</th>
                        <th scope="col">Counts</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($salesData as $data)
                        <tr>
                            <td>
                                {{$data->campaign}}
                            </td>
                            <td>
                                {{$data->count}}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @script
    <script>
        $wire.on('error', () => {
            Swal.fire({
                title: 'Failed',
                text: 'End date must be greater than or equal to start date',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        });
    </script>
    @endscript
</div>

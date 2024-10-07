<div >
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
                <th scope="col">No.</th>
                <th scope="col">Agent</th>
                <th scope="col">Campaign</th>
                <th scope="col">Counts</th>
            </tr>
            </thead>
            <tbody>
            @php $n=1; @endphp
            @foreach($salesData as $data)
                <tr>
                    <td>
                        {{$n}}
                    </td>
                    <td>
                        {{$data->agent}}
                    </td>
                    <td>
                        {{$data->campaign}}
                    </td>
                    <td>
                        {{$data->count}}
                    </td>
                </tr>
                @php $n++; @endphp
            @endforeach
            </tbody>
        </table>
    </div>
</div>

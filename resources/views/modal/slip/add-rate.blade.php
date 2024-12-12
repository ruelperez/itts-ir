<div wire:ignore.self class="modal fade" id="rate" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content" style="height: 550px;">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create daily rate</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent="submit">
                    <div class="row  mt-3">
                        <div class="col-auto">
                            <label class="col-form-label">Basic</label>
                        </div>
                        <div class="col-auto">
                            <input type="text" class="form-control" wire:model="basic" required>
                            @error('basic') <span style="color: #8B0000">{{ $message }}</span> @enderror
                        </div>
                    </div><div class="row mt-3">
                        <div class="col-auto">
                            <label class="col-form-label">Night Diff</label>
                        </div>
                        <div class="col-auto">
                            <input type="text" class="form-control" wire:model="nightDiff" required>
                            @error('nightDiff') <span style="color: #8B0000">{{ $message }}</span> @enderror
                        </div>
                    </div><div class="row mt-3">
                        <div class="col-auto">
                            <label class="col-form-label">Allowance</label>
                        </div>
                        <div class="col-auto">
                            <input type="text" class="form-control" wire:model="allowance" required>
                            @error('allowance') <span style="color: #8B0000">{{ $message }}</span> @enderror
                        </div>
                    </div><div class="row mt-3">
                        <div class="col-auto">
                            <label class="col-form-label">Holiday</label>
                        </div>
                        <div class="col-auto">
                            <input type="text" class="form-control" wire:model="holiday" required>
                            @error('holiday') <span style="color: #8B0000">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-auto">
                            <label class="col-form-label">Overtime</label>
                        </div>
                        <div class="col-auto">
                            <input type="text" class="form-control" wire:model="ot" required>
                            @error('ot') <span style="color: #8B0000">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-auto">
                            <label class="col-form-label">Other</label>
                        </div>
                        <div class="col-auto">
                            <input type="text" class="form-control" wire:model="other"  required>
                            @error('other') <span style="color: #8B0000">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <hr>
                    <div>
                        <button type="submit" class="btn btn-warning w-100">SUBMIT</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

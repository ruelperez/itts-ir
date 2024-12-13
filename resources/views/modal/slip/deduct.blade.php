<div wire:ignore.self class="modal fade" id="deduct" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content" style="height: 550px;">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{$content_name}} (Salary Deduction)</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent="submit">
                    <div class="row  mt-3">
                        <div class="col-auto">
                            <label class="col-form-label">Late/Early Deduction</label>
                        </div>
                        <div class="col-auto">
                            <input type="text" class="form-control" wire:model.lazy="lateDeduction" required>
                            @error('lateDeduction') <span style="color: #8B0000">{{ $message }}</span> @enderror
                        </div>
                    </div><div class="row mt-3">
                        <div class="col-auto">
                            <label class="col-form-label">SSS</label>
                        </div>
                        <div class="col-auto">
                            <input type="text" class="form-control" wire:model.lazy="sss" required>
                            @error('sss') <span style="color: #8B0000">{{ $message }}</span> @enderror
                        </div>
                    </div><div class="row mt-3">
                        <div class="col-auto">
                            <label class="col-form-label">Philhealth</label>
                        </div>
                        <div class="col-auto">
                            <input type="text" class="form-control" wire:model.lazy="ph" required>
                            @error('ph') <span style="color: #8B0000">{{ $message }}</span> @enderror
                        </div>
                    </div><div class="row mt-3">
                        <div class="col-auto">
                            <label class="col-form-label">Cash Advance</label>
                        </div>
                        <div class="col-auto">
                            <input type="text" class="form-control" wire:model.lazy="ca" required>
                            @error('ca') <span style="color: #8B0000">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-auto">
                            <label class="col-form-label">Other</label>
                        </div>
                        <div class="col-auto">
                            <input type="text" class="form-control" wire:model.lazy="other"  required>
                            @error('other') <span style="color: #8B0000">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-auto">
                            <label class="col-form-label">Total Deduction</label>
                        </div>
                        <div class="col-auto">
                            <input type="text" class="form-control" wire:model="totalDeduction" disabled required>
                            @error('totalDeduction') <span style="color: #8B0000">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <hr>
                    <div>
                        <button type="submit" class="btn btn-warning w-100">SUBMIT</button>
                    </div>
                    @if (session('success'))
                        <div class="alert alert-success mt-3 mb-5" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('failed'))
                        <div class="alert alert-danger mt-3 mb-5" role="alert">
                            {{ session('failed') }}
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>

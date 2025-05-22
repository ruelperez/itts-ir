<div wire:ignore.self class="modal fade" id="add" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="height: 800px;">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Callback</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent="submit">
                    <div class="mb-4">
                        <label class="form-label">Campaign</label>
                        <input type="text" class="form-control" wire:model="campaign" disabled required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Guest 1</label>
                        <input type="text" class="form-control" wire:model="guest1" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Guest 2</label>
                        <input type="text" class="form-control" wire:model="guest2" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Guest 1 (Age)</label>
                        <input type="text" class="form-control" wire:model="age1" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Guest 2 (Age)</label>
                        <input type="text" class="form-control" wire:model="age2" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Phone</label>
                        <input type="text" class="form-control" wire:model="phoneNumber" required>
                        @error('phoneNumber') <span style="color: #8B0000">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Alt Phone</label>
                        <input type="text" class="form-control" wire:model="altPhoneNumber" required>
                        @error('altPhoneNumber') <span style="color: #8B0000">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" wire:model="email" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Address</label>
                        <input type="text" class="form-control" wire:model="address" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Destination</label>
                        <input type="text" class="form-control" wire:model="destination" required>
                    </div>
                    <div class="row mt-3 px-3">
                        <textarea class="form-control" rows="3" id="reason" wire:model="reason"  placeholder="Callback Reason:" required></textarea>
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

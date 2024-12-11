<!-- Modal -->
<div wire:ignore.self class="modal fade" id="setTime" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="submitTimeSet">
                <div class="modal-body">
                    <div class="form-outline mb-2">
                        <div>
                            <label class="form-label" for="form3Example3cg" >In </label>
                            <input type="text"  class="form-control" wire:model="timeSetIn" required>
                            @error('timeSetIn') <span style="color: #8B0000">{{ $message }}</span> @enderror
                        </div>
                        <div class="mt-4">
                            <label class="form-label" for="form3Example3cg">Out </label>
                            <input type="text"  class="form-control" wire:model="timeSetOut" required>
                            @error('timeSetOut') <span style="color: #8B0000">{{ $message }}</span> @enderror
                        </div>
                        <div class="mt-4">
                            <label class="form-label" for="form3Example3cg" >In (After lunch) </label>
                            <input type="text" class="form-control" wire:model="timeSetIn2" required>
                            @error('timeSetIn2') <span style="color: #8B0000">{{ $message }}</span> @enderror
                        </div>
                        <div class="mt-4">
                            <label class="form-label" for="form3Example3cg">Out </label>
                            <input type="text"  class="form-control" wire:model="timeSetOut2" required>
                            @error('timeSetOut2') <span style="color: #8B0000">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

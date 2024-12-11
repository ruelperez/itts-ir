<!-- Modal -->
<div wire:ignore.self class="modal fade" id="setTime" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Shift Schedule</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div x-data="{ editing: false }">
                <form wire:submit.prevent="submitTimeSet">
                    <div class="modal-body">
                        <div class="form-outline mb-2">
                            <div class="text-end">
                                <!-- Edit icon to toggle editing state -->
                                <i class="fa-solid fa-pen-to-square" style="cursor: pointer" @click="editing = !editing"></i>
                            </div>

                            <div>
                                <label class="form-label" for="form3Example3cg">In </label>
                                <!-- Enable input fields when editing is true -->
                                <input type="text" class="form-control" wire:model="timeSetIn" :disabled="!editing">
                                @error('timeSetIn') <span style="color: #8B0000">{{ $message }}</span> @enderror
                            </div>
                            <div class="mt-4">
                                <label class="form-label" for="form3Example3cg">Out </label>
                                <!-- Enable input fields when editing is true -->
                                <input type="text" class="form-control" wire:model="timeSetOut" :disabled="!editing">
                                @error('timeSetOut') <span style="color: #8B0000">{{ $message }}</span> @enderror
                            </div>
                            <div class="mt-4">
                                <label class="form-label" for="form3Example3cg">In (After lunch) </label>
                                <!-- Enable input fields when editing is true -->
                                <input type="text" class="form-control" wire:model="timeSetIn2" :disabled="!editing">
                                @error('timeSetIn2') <span style="color: #8B0000">{{ $message }}</span> @enderror
                            </div>
                            <div class="mt-4">
                                <label class="form-label" for="form3Example3cg">Out </label>
                                <!-- Enable input fields when editing is true -->
                                <input type="text" class="form-control" wire:model="timeSetOut2" :disabled="!editing">
                                @error('timeSetOut2') <span style="color: #8B0000">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <!-- Enable submit button when editing is true -->
                        <button type="submit" class="btn btn-primary" :disabled="!editing">Save changes</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

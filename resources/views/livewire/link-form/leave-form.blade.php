<div>
    <div>
        <h5>Leave Form</h5>
    </div>
    <div style="background-color: #696969; color: white;border-radius: 2%;" class="px-2 py-2">
        <form wire:submit.prevent="submit">
            <div class="mt-3 row">
                <div class="col-md-6">
                    <label class="form-label">Start Date*</label>
                    <input type="text" class="form-control" id="datepickerDob"  wire:model="start" required>
                    @error('start') <span style="color: #8B0000">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-6 mt-4 mt-md-0">
                    <label  class="form-label">End Date*</label>
                    <input type="text" class="form-control" id="datepickerDob" wire:model="end" required>
                    @error('end') <span style="color: #8B0000">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-6 mt-4 ">
                    <label  class="form-label">Number Of Days*</label>
                    <input type="text" class="form-control" wire:model="dob" required>
                    @error('dob') <span style="color: #8B0000">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-6 mt-4">
                    <div>
                        <label class="form-label">Leave Type*</label>
                    </div>
                    <div>
                        <select class="form-select" aria-label="Default select example" wire:model.live="leaveType">
                            <option value="">Select</option>
                            <option value="LEAVE WITHOUT PAY (LWOP)">LEAVE WITHOUT PAY (LWOP)</option>
                            <option value="LEAVE WITH PAY (LWP)">LEAVE WITH PAY (LWP)</option>
                        </select>
                        @error('leaveType') <span style="color: #8B0000">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="col-md-6 mt-4">
                    <label class="form-label">Reason*</label>
                    <textarea class="form-control" rows="2" wire:model="reason"  style="border: none;" placeholder="Reason:"></textarea>
                    @error('reason') <span style="color: #8B0000">{{ $message }}</span> @enderror
                </div>
            </div>
            <hr>
            <div>
                <button type="submit" class="btn btn-warning col-12 col-md-7">Submit</button>
                <button type="button" class="btn btn-primary mt-2 mt-md-0 col-12 col-md-4" wire:click="clear">Clear</button>
            </div>
        </form>
        <button id="btn123" data-bs-toggle="modal" data-bs-target="#loading" style="display: none"></button>
    </div>
    @script
    <script>
        $wire.on('subSubmitted', () => {
            $('#btn123').click();
        });
    </script>
    @endscript
</div>

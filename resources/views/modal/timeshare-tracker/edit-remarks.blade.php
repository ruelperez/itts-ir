<!-- Modal -->
<div wire:ignore.self class="modal fade" id="editRemark" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Remarks</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="submitEditRemark">
            <div class="modal-body">
                <p class="text-end">Tracker ID - <b>{{$editID}}</b></p>
                <div class="mt-5">
                    <div>
                        <label class="form-label">Remark*</label>
                    </div>
                    <div>
                        <select class="form-select" aria-label="Default select example" wire:model="remarks" required>
                            <option value="">Select remark</option>
                            <option value="Verified - Billable">Verified - Billable</option>
                            <option value="Verified - Pending Result">Verified - Pending Result</option>
                            <option value="Verified - Callback">Verified - Callback</option>
                            <option value="Verified - Reschedule/Rework">Verified - Reschedule/Rework</option>
                            <option value="DQ by Manager">DQ by Manager</option>
                            <option value="DQ by QA">DQ by QA</option>
                            <option value="DQ Criteria">DQ Criteria</option>
                            <option value="TO - Declined Offer">TO - Declined Offer</option>
                            <option value="Verified - Declined Offer">Verified - Declined Offer</option>
                            <option value="Turnover - For Callback">Turnover - For Callback</option>
                            <option value="DNC">DNC</option>
                            <option value="Blacklist">Blacklist</option>
                        </select>
                        @error('remarks') <span style="color: #8B0000">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="mt-4">
                    <label  class="form-label">Reason*</label>
                    <textarea type="text" class="form-control" wire:model="reason"> </textarea>
                    @error('reason') <span style="color: #8B0000">{{ $message }}</span> @enderror
                </div>
                <div class="mt-4">
                    <input type="text" class="form-control" placeholder="Select a date" wire:model="editDate"><p class="mt-2">(mm/dd/yyyy)</p>
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

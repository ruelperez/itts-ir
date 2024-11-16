<div class="modal fade" id="clickUpdated">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Select Date</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="submitEdit">
                <div class="modal-body">
                    <div class="row">
                        <div>
                            <label class="form-label">Date*</label>
                            <input type="text" class="form-control" value="{{$date}}" disabled>
                        </div>
                        <div class="mt-4">
                            <label class="form-label">Updated Date*</label>
                            <input type="text" id="datepickerDupe" class="form-control" wire:model="date2" required>
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

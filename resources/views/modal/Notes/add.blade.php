<div wire:ignore.self class="modal fade" id="addNotes" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add Notes</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click="closeBtn"></button>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent="submit">
                    <textarea class="form-control" rows="1" wire:model.live="addInputTitle" style="border: none;" placeholder="Add title if necessary" required></textarea>
                    <hr>
                    <textarea class="form-control" rows="20" wire:model.live="addInputNotes" style="border: none;" placeholder="Add text here" required></textarea>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" wire:click="closeBtn">Close</button>
            </div>
        </div>
    </div>
</div>

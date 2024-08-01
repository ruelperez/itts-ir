<div wire:ignore.self class="modal fade" id="clickData" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="height: 500px;">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Announcement</h5>
                <button id="resClose" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-floating mb-2">
                    <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 50px;" wire:model="title"></textarea>
                </div>
                <div class="form-floating">
                    <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 300px;" wire:model="announce"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <div>
                    <button type="button" class="btn btn-danger" wire:click="delete" wire:confirm="Are you sure you want to delete?">Remove</button>
                    <button type="button" class="btn btn-primary" wire:click="updateText">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>

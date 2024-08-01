<div wire:ignore.self class="modal fade" id="add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form wire:submit.prevent="submitAdd">
            <div class="modal-content" style="height: 500px;">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create Announcement</h5>
                    <button id="addClose" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-floating mb-2">
                        <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 50px" wire:model="title" required></textarea>
                        <label for="floatingTextarea2">Title</label>
                    </div>
                    <div class="form-floating">
                        <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 300px" wire:model="announce" required></textarea>
                        <label for="floatingTextarea2">Content</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <div>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

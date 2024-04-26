<div wire:ignore.self class="modal" tabindex="-1" id="edit_comment">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: #DCDCDC">
            <div class="modal-header">
                <h5 class="modal-title">Update Comment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <textarea class="form-control" rows="15" wire:model="editTextComment"></textarea>
            </div>
            <div style="padding-bottom: 2%; padding-right: 3%; display: flex;">
                <div style="margin-left: 3%; width: 50%;">
                    @if(session()->has('good'))
                        <div class="alert" style="width: 100%; background-color: #2F4F4F; color: white " wire:ignore>
                            {{ session('good') }}
                        </div>
                    @elseif(session()->has('bad'))
                        <div class="alert" style="width: 100%; " wire:ignore>
                            {{ session('bad') }}
                        </div>
                    @endif
                </div>
                <div style="margin-left: auto">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" wire:click="submitCommentEdit">UPDATE</button>
                </div>
            </div>
        </div>
    </div>
</div>

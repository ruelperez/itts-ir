<div wire:ignore.self class="modal" tabindex="-1" id="edit_tags">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update tags</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="submit_edit_tags">
                <div class="modal-body">
                    @if(session()->has('good'))
                        <div class="alert alert-success" style="width: 60%; ">
                            {{ session('good') }}
                        </div>
                    @elseif(session()->has('bad'))
                        <div class="alert alert-danger" style="width: 60%; ">
                            {{ session('bad') }}
                        </div>
                    @endif
                    <div class="form-group">
                        <input type="text" style="margin-bottom: 2%; width: 50%;" class="form-control" wire:model="tags" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

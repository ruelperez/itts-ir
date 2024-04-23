<div wire:ignore.self class="modal" tabindex="-1" id="edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create notes</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="submit_edit">
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
                        <div class="row g-3 align-items-center mb-2">
                            <div class="col-auto">
                                <label class="col-form-label">Title:</label>
                            </div>
                            <div class="col-auto">
                                <input type="text" wire:model="title" class="form-control">
                            </div>
                        </div>
                        <div class="row g-3 align-items-center mb-2">
                            <div class="col-auto">
                                <label class="col-form-label">Campaign:</label>
                            </div>
                            <div class="col-auto">
                                <input type="text" class="form-control" wire:model="campaign_name">
                            </div>
                        </div>
                        <div class="row g-3 align-items-center mb-2">
                            <div class="col-auto">
                                <label class="col-form-label">Client:</label>
                            </div>
                            <div class="col-auto">
                                <input type="text" class="form-control" wire:model="client">
                            </div>
                        </div>
                        <div class="row g-3 align-items-center mb-2">
                            <div class="col-auto">
                                <label class="col-form-label">Law firm:</label>
                            </div>
                            <div class="col-auto">
                                <input type="text" class="form-control" wire:model="lawfirm">
                            </div>
                        </div>
                        <div class="row g-3 align-items-center mb-2">
                            <div class="col-auto">
                                <label class="col-form-label">Method:</label>
                            </div>
                            <div class="col-auto">
                                <input type="text" class="form-control" wire:model="method">
                            </div>
                        </div>
                        <div class="row g-3 align-items-center mb-2">
                            <div class="col-auto">
                                <label class="col-form-label">Tags #:</label>
                            </div>
                            <div class="col-auto">
                                <input type="text" class="form-control" wire:model="tags">
                            </div>
                        </div>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" wire:model="text" required></textarea>
                        <img src="{{asset('storage/'.$image)}}" style="max-width: 60%; max-height: 60%; margin-top: 2%;" id="imgs">
                        <div wire:ignore>
                            <img id="preview" src="#" alt="Image Preview" style="display: none; max-width: 150px; max-height: 150px;">
                            <input type="file" id="image" wire:model="image" accept="image/*" onchange="previewImageEdit(event)" style="margin-top: 1%;">
                        </div>
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

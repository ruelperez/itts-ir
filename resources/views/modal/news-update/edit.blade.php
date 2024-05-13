<div wire:ignore.self class="modal" tabindex="-1" id="edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create notes</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="submit_edit" wire:ignore>
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
                                <input type="text" class="form-control" wire:model="campaign_name" disabled>
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
                                <label class="col-form-label">Link</label>
                                <i class="fa-solid fa-circle-plus"  wire:click="addInputField" style="color: blue; margin-left: 10px; cursor: pointer; font-size: 18px;"></i>
                            </div>
                            <div style="margin-left: 12%;">
                                @foreach ($link as $index => $input)
                                    <textarea type="text" class="form-control" wire:model="link.{{ $index }}" style="width: 70%; margin-bottom: 1%; " rows="2"></textarea>
                                @endforeach
                            </div>
                            <!-- Button to save data -->
                            {{--                            <div class="col-auto">--}}
                            {{--                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="2" wire:model="link" required></textarea>--}}
                            {{--                            </div>--}}
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
                            <img id="preview_edit" src="#" alt="Image Preview" style="display: none; max-width: 60%; max-height: 60%;">
                            <input type="file" id="image" wire:model.live="image" accept="image/*" onchange="previewImageEdit(event)" style="margin-top: 1%;">
                        </div>
                    </div>
                </div>
                <hr>
                <div style="padding-bottom: 2%; padding-right: 3%; display: flex;">
                    <div style="margin-left: 3%; width: 50%;">
                        @if(session()->has('good'))
                            <div class="alert alert-success" style="width: 100%; ">
                                {{ session('good') }}
                            </div>
                        @elseif(session()->has('bad'))
                            <div class="alert alert-danger" style="width: 100%; ">
                                {{ session('bad') }}
                            </div>
                        @endif
                    </div>
                    <div style="margin-left: auto">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

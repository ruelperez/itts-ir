<div wire:ignore.self class="modal" tabindex="-1" id="add">
    <div class="modal-dialog modal-xl">
        <div class="modal-content" >
            <div class="modal-header">
                <h5 class="modal-title">Create</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="submit">
                <div class="modal-body">
                    <div class="form-group">
                        <div style="display: flex; padding-left: 2%; padding-right: 2%;">
                            <div style="width: 60%;">
                                <div class="row g-3 align-items-center mb-2">
                                    <div class="col-auto">
                                        <label class="col-form-label">Title:</label>
                                    </div>
                                    <div class="col-auto">
                                        <input type="text" wire:model="title" class="form-control" required>
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
                                        <input type="text" class="form-control" wire:model="client" required>
                                    </div>
                                </div>
                                <div class="row g-3 align-items-center mb-2">
                                    <div class="col-auto">
                                        <label class="col-form-label">Law firm:</label>
                                    </div>
                                    <div class="col-auto">
                                        <input type="text" class="form-control" wire:model="lawfirm" required>
                                    </div>
                                </div>
                                <div class="row g-3 align-items-center mb-2">
                                    <div class="col-auto">
                                        <label class="col-form-label">Method</label>
                                    </div>
                                    <div class="col-auto">
                                        <input type="text" class="form-control" wire:model="method" required>
                                    </div>
                                    <div class="col-auto">
                                        <label class="col-form-label">DID</label>
                                    </div>
                                    <div class="col-auto">
                                        <input type="text" class="form-control" wire:model="did" required>
                                    </div>
                                </div>
                                <div class="row g-3 align-items-center mb-2">
                                    <div class="col-auto">
                                        <label class="col-form-label">Schedule:</label>
                                    </div>
                                    <div class="col-auto">
                                        <input type="text" class="form-control" wire:model="schedule" required>
                                    </div>
                                </div>
                                <div class="row g-3 align-items-center mb-2">
                                    <div class="col-auto">
                                        <label class="col-form-label">GEO:</label>
                                    </div>
                                    <div class="col-auto">
                                        <input type="text" class="form-control" wire:model="geo" required>
                                    </div>
                                </div>
                                <div class="row g-3 align-items-center mb-2">
                                    <div class="col-auto">
                                        <label class="col-form-label">Restriction:</label>
                                    </div>
                                    <div class="col-auto">
                                        <input type="text" class="form-control" wire:model="restriction" required>
                                    </div>
                                </div>
                                <div class="row g-3 align-items-center mb-2">
                                    <div class="col-auto">
                                        <label class="col-form-label">Tags #:</label>
                                    </div>
                                    <div class="col-auto">
                                        <input type="text" class="form-control" wire:model="tags" required>
                                    </div>
                                </div>
                            </div>
                            <div style="width: 40%;">
                                <div>
                                    <small>Campaign Stat: </small>
                                    <select class="form-select" aria-label="Default select example" wire:model="campaign_stat">
                                        <option value="active">Active</option>
                                        <option value="pause">Pause</option>
                                        <option value="dormant">Dormant</option>
                                    </select>
                                </div>
                                <div style="margin-top: 10%">
                                    <div class="list-group">
                                        <label class="list-group-item">
                                            <input class="form-check-input me-1" type="checkbox" wire:model="tcpa" value="{{$tcpa}}">
                                            TCPA/ LITIGATOR CHECK
                                        </label>
                                        <label class="list-group-item">
                                            <input class="form-check-input me-1" type="checkbox" wire:model="tf" value="{{$tf}}">
                                            TF
                                        </label>
                                        <label class="list-group-item">
                                            <input class="form-check-input me-1" type="checkbox" wire:model="blacklist" value="{{$blacklist}}">
                                            BLACKLIST
                                        </label>
                                        <label class="list-group-item">
                                            <input class="form-check-input me-1" type="checkbox" wire:model="thatsthem" value="{{$thatsthem}}">
                                            SMARTBACKGROUND - THATSTHEM
                                        </label>
                                        <label class="list-group-item">
                                            <input class="form-check-input me-1" type="checkbox" wire:model="dupe" value="{{$dupe}}">
                                            DUPE CHECK
                                        </label>
                                        <label class="list-group-item">
                                            <input class="form-check-input me-1" type="checkbox" wire:model="email" value="{{$email}}">
                                            EMAIL REQUIRED
                                        </label>
                                        <label class="list-group-item">
                                            <input class="form-check-input me-1" type="checkbox" wire:model="email" value="{{$email}}">
                                            EMAIL REQUIRED
                                        </label>
                                        <label class="list-group-item">
                                            <input class="form-check-input me-1" type="checkbox" wire:model="govt" value="{{$govt}}">
                                            GOVT. ISSUED ID
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row g-3 align-items-center mb-2" style="padding-left: 2%; padding-right: 2%;">
                            <div class="col-auto">
                                <label class="col-form-label">Link</label>
                                <i class="fa-solid fa-circle-plus"  wire:click="addUser" style="color: blue; margin-left: 10px; cursor: pointer; font-size: 18px;"></i>
                            </div>
                            <div style="margin-left: 8%;">
                                @foreach($link as $index => $user)
                                    <div class="user-form mb-2" style="display: flex">
                                        <input class="form-control" type="text" placeholder="Enter title" wire:model="link.{{ $index }}.title" style="width: 20%;">
                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="1" placeholder="Enter link"  wire:model="link.{{ $index }}.textLink" style="width: 50%; margin-left: 1%"></textarea>
                                        <button type="button" class="btn btn-danger" wire:click="removeUser({{ $index }})" style="margin-left: 1%;">Remove</button>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <hr>
                        <div wire:ignore style="padding-left: 2%; padding-right: 2%;" class="mt-4">
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" wire:model="text" required></textarea>
                            <img id="preview" src="#" alt="Image Preview" style="display: none; max-width: 60%; max-height: 60%; margin-top: 3%;">
                            <input type="file" id="image" wire:model="image" accept="image/*" onchange="previewImage(event)" style="margin-top: 3%;">
                        </div>
                    </div>
                </div>
                <hr>
                <div style="padding-bottom: 2%; padding-right: 3%; display: flex;">
                    <div style="margin-left: 3%; width: 50%;">
                        @if(session()->has('good'))
                            <div class="alert alert-success" style="width: 100%; " >
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

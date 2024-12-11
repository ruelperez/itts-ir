<div wire:ignore.self class="modal fade" id="current" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="height: 400px;">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit DTR</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-outline mb-4">
                    <div style="margin-bottom: 5%;">
                        <h6>{{$dtrName}}</h6>
                    </div>
                    <div>
                        <label class="form-label" for="form3Example3cg" style="margin-right: 1%;">Time in -</label>
                        <input type="text" wire:model="timeIn1" @if(session()->has('goodSched')) disabled @endif>
                    </div>
                    @error('timeIn1') <span style="color: #8B0000">{{ $message }}</span> @enderror@error('timeIn1') <span style="color: #8B0000">{{ $message }}</span> @enderror
                    <div class="mt-4">
                        <label class="form-label" for="form3Example3cg" style="margin-right: 1%;">Time out -</label>
                        <input type="text" wire:model="timeOut1" @if(session()->has('goodSched')) disabled @endif>
                        @error('timeOut1') <span style="color: #8B0000">{{ $message }}</span> @enderror
                    </div>
                    <div class="mt-4">
                        <label class="form-label" for="form3Example3cg" style="margin-right: 1%;">Time in (after lunch) -</label>
                        <input type="text" wire:model="timeIn2" @if(session()->has('goodSched')) disabled @endif>
                        @error('timeIn2') <span style="color: #8B0000">{{ $message }}</span> @enderror
                    </div>
                    <div class="mt-4">
                        <label class="form-label" for="form3Example3cg" style="margin-right: 1%;">Time out -</label>
                        <input type="text" wire:model="timeOut2" @if(session()->has('goodSched')) disabled @endif>
                        @error('timeOut2') <span style="color: #8B0000">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                @if(session()->has('goodSched'))
                    <div class="alert alert-success" style="width: 100%; " wire:ignore>
                        {{ session('goodSched') }}
                    </div>
                @elseif(session()->has('badSched'))
                    <div class="alert alert-danger" style="width: 100%; " wire:ignore>
                        {{ session('badSched') }}
                    </div>
                @endif
                @if(session()->has('goodSched'))
                    <div style="display: none">
                        <button type="button" class="btn btn-danger" wire:click="remove" wire:confirm="Click (OK) to remove" data-bs-dismiss="modal">Remove</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" wire:click="submitEdit">Submit</button>
                    </div>
                @else
                    <div>
                        <button type="button" class="btn btn-danger" wire:click="remove" wire:confirm="Click (OK) to remove" data-bs-dismiss="modal">Remove</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" wire:click="submitEdit" wire:confirm="To proceed, click submit">Submit</button>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

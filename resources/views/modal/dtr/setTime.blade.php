<div wire:ignore.self class="modal fade" id="setTime" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="height: 300px;">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Select week number</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-outline mb-4">
                    <label class="form-label" for="form3Example3cg">Username</label>
                    <input type="text" id="form3Example3cg" class="form-control form-control-md" wire:model="username"/>
                    @error('username') <span style="color: red">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="modal-footer">
                @if(session()->has('goodWeek'))
                    <div class="alert alert-success" style="width: 100%; " wire:ignore>
                        {{ session('goodWeek') }}
                    </div>
                @elseif(session()->has('badWeek'))
                    <div class="alert alert-danger" style="width: 100%; " wire:ignore>
                        {{ session('badWeek') }}
                    </div>
                @endif
                @if(session()->has('goodWeek'))
                    <div style="display: none">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" wire:click="submitWeek">Submit</button>
                    </div>
                @else
                    <div>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" wire:click="submitWeek" wire:confirm="Are you sure you want to reset weekly DTR?">Submit</button>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

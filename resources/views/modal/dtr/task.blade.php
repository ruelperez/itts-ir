<div wire:ignore.self class="modal fade" id="task" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="height: 300px;">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Task Assignment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <textarea class="form-control" rows="5" wire:model="task" required></textarea>
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
                        <button type="button" class="btn btn-primary" wire:click="submitTask" wire:confirm="Are you sure you want to submit">Submit</button>
                    </div>
                @else
                    <div>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" wire:click="submitTask" wire:confirm="Are you sure you want to submit">Submit</button>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

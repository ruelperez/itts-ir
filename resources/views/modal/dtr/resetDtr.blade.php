<div wire:ignore.self class="modal fade" id="resetDtr" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="height: 300px;">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Select week number</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <select class="form-select" aria-label="Default select example" wire:model="weekNumber">
                    <option value="Week 1">Week 1</option>
                    <option value="Week 2">Week 2</option>
                    <option value="Week 3">Week 3</option>
                    <option value="Week 4">Week 4</option>
                </select>
            </div>
            <div class="modal-footer">
                @if(session()->has('good'))
                    <div class="alert alert-success" style="width: 100%; " wire:ignore>
                        {{ session('good') }}
                    </div>
                @elseif(session()->has('bad'))
                    <div class="alert alert-danger" style="width: 100%; " wire:ignore>
                        {{ session('bad') }}
                    </div>
                @endif
                @if(session()->has('good'))
                    <div style="display: none">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" wire:click="submitWeek">Submit</button>
                    </div>
                @else
                        <div>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" wire:click="submitWeek">Submit</button>
                        </div>
                @endif
            </div>
        </div>
    </div>
</div>

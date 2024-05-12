<div wire:ignore.self class="modal fade" id="taskRecord" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="height: 500px;">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Task Assignment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p style="white-space: pre-line;">{{$task}}</p>
            </div>
            <div class="modal-footer">
                    <div>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
            </div>
        </div>
    </div>
</div>

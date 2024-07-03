<div wire:ignore.self class="modal fade" id="hasAct" style="top: 25%;">
    <div class="modal-dialog modal-sm">
        <div class="modal-content" style="height: 200px;">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" ></button>
            </div>
            <div class="modal-body" style="text-align: center">
                There are devices that are active. Would you like to proceed?
            </div>
            <div class="modal-footer">
                <button class="btn btn-outline-dark" data-bs-dismiss="modal" aria-label="Close">CANCEL</button>
                <button class="btn btn-warning" onclick="location.href = '/itts/22/device-clearance/{{$deviceUserID}}';">YES</button>
            </div>
        </div>
    </div>
</div>

<div wire:ignore.self class="modal" tabindex="-1" role="dialog" id="clickSettings">
    <div class="modal-dialog" role="document" >
        <div class="modal-content" style="height: 400px;">
            <div class="modal-header">
                <h5 class="modal-title" id="insertModalLabel">Settings</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" wire:model.live="registrationSwitch" value="{{$registrationSwitch}}">
                        <label class="form-check-label" for="flexSwitchCheckChecked">Registration</label>
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" wire:model.live="adminSwitch" value="{{$adminSwitch}}">
                        <label class="form-check-label" for="flexSwitchCheckChecked">Admin registration</label>
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" wire:model.live="superAdminSwitch" value="{{$adminSwitch}}">
                        <label class="form-check-label" for="flexSwitchCheckChecked">Super admin registration</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

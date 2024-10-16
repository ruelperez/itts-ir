<div>
    <h5>Settings</h5>
    <div>
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" wire:model.live="registrationSwitch" value="{{$registrationSwitch}}">
            <label class="form-check-label" for="flexSwitchCheckChecked">Agent registration</label>
        </div>
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" wire:model.live="adminSwitch" value="{{$adminSwitch}}">
            <label class="form-check-label" for="flexSwitchCheckChecked">Admin registration</label>
        </div>
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" wire:model.live="superAdminSwitch" value="{{$superAdminSwitch}}">
            <label class="form-check-label" for="flexSwitchCheckChecked">Super admin registration</label>
        </div>
    </div>
</div>

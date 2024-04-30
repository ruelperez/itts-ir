<div wire:ignore.self class="modal" tabindex="-1" role="dialog" id="clickSettings">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
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
                        <label class="form-check-label" for="flexSwitchCheckChecked">Admin option registration</label>
                    </div>
                    <div>
                        <p>Reset DTR button @if(count($dtrData) == 0) <i class="fa-solid fa-check" style="color: green;font-size: 20px; margin-left: 3%;"></i>  @else <i class="fa-solid fa-rotate" style="margin-left: 3%; font-size: 20px; cursor: pointer" type="button"
                                                                                                                                                                         wire:click="clickReset"
                                                                                                                                                                         wire:confirm="Are you sure you want to reset DTR button?"></i> @endif </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

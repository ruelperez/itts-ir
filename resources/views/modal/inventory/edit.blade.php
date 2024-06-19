<div wire:ignore.self class="modal fade" id="edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" >
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent="submitEdit">
                    <div class="mb-4">
                        <label for="exampleInputEmail1" class="form-label">Select device</label>
                        <select class="form-select" aria-label="Default select example" wire:model="device_name">
                            <option value="laptop">Laptop</option>
                            <option value="desktop">Desktop</option>
                            <option value="monitor">Monitor</option>
                            <option value="charger">Charger</option>
                            <option value="keyboard">Keyboard</option>
                            <option value="mouse">Mouse</option>
                            <option value="headset">Headset</option>
                            <option value="usb adapter">Usb adapter</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Brand name</label>
                        <input type="text" class="form-control" wire:model="brand_name" required>
                    </div>
                    <div class="mb-4">
                        <label for="exampleInputPassword1" class="form-label">Serial number</label>
                        <input type="text" class="form-control" wire:model="serial" required>
                    </div>
                    <div class="mb-4">
                        <label for="exampleInputPassword1" class="form-label">Quantity</label>
                        <input type="text" class="form-control" wire:model="quantity" required>
                    </div>
                    <button type="submit" class="btn btn-primary mb-3">Submit</button>
                    @if(session()->has('goodEdit'))
                        <div class="alert alert-success" style="width: 100%; " wire:ignore>
                            {{ session('goodEdit') }}
                        </div>
                    @elseif(session()->has('badEdit'))
                        <div class="alert alert-danger" style="width: 100%; " wire:ignore>
                            {{ session('badEdit') }}
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>

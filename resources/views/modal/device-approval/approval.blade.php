<div wire:ignore.self class="modal fade" id="clickRow" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" >
        <div class="modal-content" style="height: 200px;">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if(session()->has('good'))
                    <div style="text-align: center">
                        <i class="fa fa-check-circle" style="color: green; font-size: 35px"></i>
                        <p class="mt-3">{{ session('good') }}</p>
                    </div>
                @elseif(session()->has('bad'))
                    <div style="text-align: center">
                        <i class="fa-solid fa-circle-exclamation" style="color: red; font-size: 35px"></i>
                        <p class="mt-3">{{ session('bad') }}</p>
                    </div>
                @else
                    <div><button class="btn btn-primary" style="width: 76%; margin-left: 12%; margin-bottom: 3%;" wire:click="approve" wire:confirm="Are you sure you want to approve this device?">APPROVE</button></div>
                    <div><button class="btn btn-danger" style="width: 76%; margin-left: 12%;" wire:click="decline" wire:confirm="Are you sure you want to decline this device?">DECLINE</button></div>
                @endif
            </div>
        </div>
    </div>
</div>

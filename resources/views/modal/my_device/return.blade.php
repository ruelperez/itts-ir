<div wire:ignore.self class="modal fade" id="return" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" >
        <div class="modal-content" style="height: 200px;">
            <div class="modal-header">
                <h6 class="modal-title" id="staticBackdropLabel">Serial - {{$srl}}</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if(session()->has('goodReturn'))
                    <div style="text-align: center">
                        <i class="fa fa-check-circle" style="color: green; font-size: 40px; margin-top: 2%;"></i>
                        <p class="mt-3">{{ session('goodReturn') }}</p>
                    </div>
                @elseif(session()->has('badReturn'))
                    <div style="text-align: center">
                        <i class="fa-solid fa-circle-exclamation" style="color: red; font-size: 35px; margin-top: 2%;"></i>
                        <p class="mt-3">{{ session('badReturn') }}</p>
                    </div>
                @else
                    <div><button class="btn btn-danger" style="width: 76%; margin-left: 12%; margin-top: 5%;" wire:click="returnItem" wire:confirm="Are you sure you want to return this device?">RETURN DEVICE</button></div>
                @endif
            </div>
        </div>
    </div>
</div>

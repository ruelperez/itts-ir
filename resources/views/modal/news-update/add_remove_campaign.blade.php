<div wire:ignore.self class="modal" tabindex="-1" id="arc">
    <div class="modal-dialog modal-sm">
        <div class="modal-content" >
            <div class="modal-header">
                <h6 class="modal-title">Add / Remove Campaign</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="submit">
                <div class="modal-body">

                </div>
                <hr>
                <div style="display: flex;">
                    <div style="margin-left: 3%; width: 50%;">
                        @if(session()->has('good'))
                            <div class="alert alert-success" style="width: 100%; " >
                                {{ session('good') }}
                            </div>
                        @elseif(session()->has('bad'))
                            <div class="alert alert-danger" style="width: 100%; ">
                                {{ session('bad') }}
                            </div>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

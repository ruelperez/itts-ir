<div wire:ignore.self class="modal" tabindex="-1" id="reactor">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">React <i class="fa-solid fa-heart" style="font-size: 20px; color: red; cursor: pointer"></i></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="submit">
                <div class="modal-body">
                    @foreach($reactors as $act)
                    <div class="fw-light" style="display: flex; margin-bottom: 1%;">
                        <div class="profile-picture-reactor">
                            <img src="{{asset('storage/'.$act->photo)}}" alt="Profile Picture">
                        </div>
                        <div style="margin-right: 5%;">
                            <b>{{ucwords($act->fullname)}}</b>
                        </div>
                        <div style="margin-left: auto">
                            <i class="fa-solid fa-heart" style="font-size: 16px; color: red; cursor: pointer"></i>
                        </div>
                    </div>
                    @endforeach
                </div>
            </form>
        </div>
    </div>
</div>

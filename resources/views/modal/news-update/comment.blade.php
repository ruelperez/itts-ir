<div wire:ignore.self class="modal" tabindex="-1" id="comment">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Comment <i class="fa-regular fa-comment" style="font-size: 22px;"></i></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="submit">
                <div class="modal-body">
                    <div style="white-space: pre-line;">
                        @if($selectedNotes == null or $selectedNotes == "")
                        @else
                            {{$selectedNotes->text}}
                        @endif
                    </div>
                    @foreach($comment as $act)
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
                        <div>

                        </div>
                    @endforeach
                </div>
                <div style="background-color: #D3D3D3; padding-top: 1%; padding-bottom: 1%;">
                    <div class="fw-light" style="display: flex; margin-bottom: 1%; padding-left: 2%; padding-right: 2%;">
                        <div class="profile-picture-comment">
                            <img src="{{asset('storage/'.$photo)}}" alt="Profile Picture">
                        </div>
                        <div style="margin-right: 5%; background-color: white; width: 90%; border-radius: 10px;">
                            <textarea class="form-control" rows="2" wire:model="text" style="border: none;" required wire:model="text_comment"></textarea>
                            <div style="margin-left: 95%; padding: 1%;">
                                <i class="fa-solid fa-paper-plane" style="color: blue; cursor: pointer" wire:click="send"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

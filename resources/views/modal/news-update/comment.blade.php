<div wire:ignore.self class="modal" tabindex="-1" id="comment">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Comment <i class="fa-regular fa-comment" style="font-size: 22px;"></i></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="submit">
                <div class="modal-body">
                    @foreach($selectedNotes as $data)
                        <div style="box-sizing: content-box; background-color: white; margin-left: 1%; margin-bottom: 1%; word-wrap: break-word;">
                            <div class="fw-light" style="display: flex;">
                                <div class="profile-picture">
                                    <img src="{{asset('storage/'.$data->photo)}}" alt="Profile Picture">
                                </div>
                                <div style="margin-right: 5%;">
                                    <b>{{ucwords($data->user_fullname)}}</b>
                                    <p>{{$data->updated_at->format('M d, Y h:i')}}</p>
                                </div>
                                <div style="margin-right: 6%;">
                                    ID: {{$data->id}}
                                </div>
                                <div style="margin-right: 6%;">
                                    {{$data->tags}}
                                </div>
                            </div>
                            <hr style="margin-bottom: 1px;">
                            <div style="white-space: pre-line;">
                                {{$data->text}}
                            </div>
                            @php $h=0;
                                foreach ($heart as $fg){
                                   if ($fg->note_id == $data->id){
                                       $h++;
                                   }
                                }
                                $totalHeart = $h;
                            @endphp
                            <div style="margin-top: 2%; display: flex">
                                <i class="fa-solid fa-heart" style="font-size: 20px; margin-right: 0.5%; color: red; cursor: pointer" data-bs-toggle="modal" data-bs-target="#reactor" wire:click="reactor({{$data->id}})"></i> {{$totalHeart}}
                                <u style="margin-left: 4%; cursor: pointer">{{count($comment)}} Comment</u>
                                {{--                                comment--}}
                            </div>
                            <hr>
                            <div style="display: flex">
                                <div style="width: 50%; text-align: center">
                                    @if(count($heart) < 1)
                                        <i class="fa-regular fa-heart" style="font-size: 22px; cursor: pointer;" wire:click="clickHeart({{$data->id}})"></i>
                                    @else
                                        @php $n=0; @endphp
                                        @foreach($heart as $hearts)
                                            @if($hearts->user_id == $user_id and $hearts->note_id == $data->id)
                                                <i class="fa-solid fa-heart" style="font-size: 22px; cursor: pointer; color: red" wire:click="clickHeart({{$data->id}})"></i>
                                                @php $n++; @endphp
                                            @else

                                            @endif
                                        @endforeach
                                        @if($n == 0)
                                            <i class="fa-regular fa-heart" style="font-size: 22px; cursor: pointer;" wire:click="clickHeart({{$data->id}})"></i>
                                        @endif
                                    @endif

                                </div>
                                <div style="width: 50%; text-align: center">
                                    <i class="fa-regular fa-comment" style="font-size: 22px; cursor: pointer;"></i> Comment
                                </div>
                            </div>
                            <hr>
                            @foreach($comment as $coms)
                                <div id="comments">
                                    <div style="display: flex; margin-bottom: 5%;">
                                        <div class="profile-picture-comment">
                                            <img src="{{asset('storage/'.$coms->photo)}}" alt="Profile Picture">
                                        </div>
                                        <div style="margin-right: 5%; background-color: #2F4F4F; color: white; padding: 1%; border-radius: 20px; font-size: 14px">
                                            <div>
                                                <div style="margin-right: 15px;">
                                                    <b>{{ucwords($coms->fullname)}}</b>
                                                </div>
                                            </div>
                                            <div>
                                                {{$coms->text}}
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            @endforeach
                        </div>
                    @endforeach
                </div>
                <div style="background-color: #D3D3D3; padding-top: 1%; padding-bottom: 1%;">
                    <div class="fw-light" style="display: flex; margin-bottom: 1%; padding-left: 2%; padding-right: 2%;">
                        <div class="profile-picture-comment">
                            <img src="{{asset('storage/'.$photo)}}" alt="Profile Picture">
                        </div>
                        <div style="margin-right: 5%; background-color: white; width: 90%; border-radius: 10px;">
                            <textarea class="form-control" rows="2" wire:model="text_comment" style="border: none;" required></textarea>
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

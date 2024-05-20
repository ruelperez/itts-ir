<div>
    @include('modal.click-settings')
    @include('modal.news-update.show-photo')
    @include('modal.news-update.add')
    @include('modal.news-update.edit_tags')
    @include('modal.news-update.edit')
    @include('modal.news-update.reactor')
    @include('modal.news-update.comment')
    @include('modal.news-update.comment_reactor')
    @include('modal.news-update.edit_comment')
    <div style="display: flex; width: 100%; margin-top: 135px;">
{{--        <div wire:poll>--}}
{{--            Current time: {{ now() }}--}}
{{--        </div>--}}
        <div style="width: 81%; margin-left: 19%;">
            <div class="container" wire:poll.keep-alive>
                <div style="position: fixed;top: 17%; left: 17%; width: 85%; z-index: 1000; background-color: #41464b; padding-left: 3%; padding-bottom: 1%;">
                    <div style="display: flex; margin-top: 2%;">
                        <div>
                            <h5 style="color: white">{{strtoupper($campaign_name)}}</h5>
                        </div>
                        @if($position != "Agent")
                            <div style="margin-left: 5%;  margin-right: 1%;">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add">Create <i class="fa-solid fa-plus"></i></button>
                            </div>
                        @endif
                        <div style="width: 20%; @if($position == "Agent") margin-left: 10%; @endif ">
                            <input type="text" placeholder="Search" wire:model.live="searchInput" style="padding: 1%;  width: 100%;">
                        </div>
                        @if($campaign_name == "Camp lejeune")
                            <div style=" margin-left: 18px; margin-top: 4px;">
                                <a href="/itts/2/age-checker" wire:navigate style="color: white;">Age checker</a>
                            </div>
                        @endif
                        <div style="margin-left: auto; margin-right: 5%;">
                            <select class="form-select" aria-label="Default select example" wire:model.live="campaign_name">
                                <option value="Camp lejeune">CL</option>
                                <option value="AFFF">AFFF</option>
                                <option value="Paraquat">Paraquat</option>
                                <option value="Round  Up">Round up</option>
                                <option value="CGX">CGX</option>
                                <option value="ACA">ACA</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="content">
                    @foreach($notes_all as $data)
                        <div style="width: 100%; background-color: white; padding-left: 3%; padding-right: 3%; padding-top: 1.5%; padding-bottom: 2%;">
                            <div class="fw-light" style="display: flex;">
                                <div class="profile-picture">
                                    <img src="{{asset('storage/'.$data->photo)}}" alt="Profile Picture">
                                </div>
                                <div style="margin-right: 5%;">
                                    <b>{{ucwords($data->user_fullname)}}</b><br>
                                    <small wire:ignore>{{ \Carbon\Carbon::parse($data->created_at)->diffForHumans() }}</small>
                                </div>
{{--                                <div style="margin-left: auto; @if($is_admin == "1") margin-right: 6%; @endif ">--}}
{{--                                    --}}
{{--                                </div>--}}
                                <div style="margin-right: 6%;">
                                    ID: {{$data->id}}
                                </div>
                                <div style="margin-right: 6%;">
                                    {{$data->tags}} @if($position != "Agent" and $data->user_id == $user_id) <i class="fa-solid fa-pen" style="font-size: 14px; margin-left: 5px; cursor: pointer" data-bs-toggle="modal" data-bs-target="#edit_tags" wire:click="edit_tags({{$data->id}})"></i> @endif
                                </div>
                                @if($position != "Agent" and $data->user_id == $user_id)
                                    <div style="margin-left: auto; margin-right: 1.5%;">
                                        <i class="fa-solid fa-pen-to-square" style="cursor: pointer" title="edit" data-bs-toggle="modal" data-bs-target="#edit" wire:click="edit({{$data->id}})"></i>
                                    </div>
                                    <div>
                                        <i class="fa-solid fa-trash" style="color: red; cursor: pointer" title="delete" type="button"
                                           wire:click="delete({{$data->id}})"
                                           wire:confirm="Are you sure you want to delete this post?"></i>
                                    </div>
                                @endif
                            </div>
                            <hr>
                            <div>
                                Title:  <b>{{ucwords($data->title)}}</b><br>
                                Campaign: <b>{{strtoupper($data->campaign)}}</b><br>
                                Client: <b>{{ucwords($data->client)}}</b><br>
                                Law firm: <b>{{ucwords($data->lawfirm)}}</b><br>
                                Method: <b>{{ucwords($data->method)}}</b><br>
                                Link:
                                <div style="word-wrap: break-word">
                                    @foreach($linkData as $linked)
                                        @if($data->id == $linked->note_id)
                                            <a href="{{$linked->link}}" target="_blank" style="margin-left: 5%;">{{$linked->link}}</a><br><br>
                                        @endif
                                    @endforeach
                                </div>


                                <p style="margin-top: 3%; white-space: pre-line;">{{$data->text}}</p>
                                <img src="{{asset('storage/'.$data->image)}}" style="max-width: 90%; max-height: 90%; margin-left: 5%;">
                            </div>
                            @php $h=0; $g=0;
                                foreach ($heart as $fg){
                                   if ($fg->note_id == $data->id){
                                       $h++;
                                   }
                                }

                                foreach ($all_comment as $com){
                                    if ($com->note_id == $data->id){
                                        $g++;
                                    }
                                }
                                $totalHeart = $h;
                                $totalComment = $g;
                            @endphp
                            <div style="margin-top: 2%; display: flex">
                               <i class="fa-solid fa-heart" style="font-size: 20px; margin-right: 0.5%; color: red; cursor: pointer" data-bs-toggle="modal" data-bs-target="#reactor" wire:click="reactor({{$data->id}})"></i> {{$totalHeart}}
                                <u style="margin-left: 4%; cursor: pointer" data-bs-toggle="modal" data-bs-target="#comment" wire:click="commented({{$data->id}})">{{$totalComment}} Comment</u>
                            </div>
                            <hr>
                            <div style="display: flex">
                                <div style="width: 50%; text-align: center">
                                    @if(count($heart) < 1)
                                        <i class="fa-regular fa-heart" style="font-size: 25px; cursor: pointer;" wire:click="clickHeart({{$data->id}})"></i>
                                    @else
                                        @php $n=0; @endphp
                                        @foreach($heart as $hearts)
                                            @if($hearts->user_id == $user_id and $hearts->note_id == $data->id)
                                                <i class="fa-solid fa-heart" style="font-size: 25px; cursor: pointer; color: red" wire:click="clickHeart({{$data->id}})"></i>
                                                @php $n++; @endphp
                                            @else

                                            @endif
                                        @endforeach
                                        @if($n == 0)
                                            <i class="fa-regular fa-heart" style="font-size: 25px; cursor: pointer;" wire:click="clickHeart({{$data->id}})"></i>
                                        @endif
                                    @endif

                                </div>
                                <div style="width: 50%; display: flex;">
                                    <i class="fa-regular fa-comment" style="margin-left: 35%; font-size: 22px; cursor: pointer;" data-bs-toggle="modal" data-bs-target="#comment" wire:click="commented({{$data->id}})"></i>
                                    <p style="margin-left: 2%; cursor: pointer" data-bs-toggle="modal" data-bs-target="#comment" wire:click="commented({{$data->id}})">Comment</p>
                                </div>
                            </div>
                            <hr>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
        <div style="width: 19%; background-color: #0077b6; position: fixed;top: 125px; left: 0; z-index: 1000; height: 100%;">
            @include('components.layouts.profile')
            @include('components.layouts.navigation')
        </div>
    </div>
    @include('partial.header')
</div>

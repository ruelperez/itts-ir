<div>
    @include('modal.click-settings')
    @include('partial.header')
    @include('modal.news-update.add')
    @include('modal.news-update.edit_tags')
    @include('modal.news-update.edit')
    @include('modal.news-update.reactor')
    <div style="display: flex; width: 100%;">
        <div style="width: 19%; background-color: #0077b6">
            @include('components.layouts.profile')
            @include('components.layouts.navigation')
        </div>
        <div style="width: 81%; background-color: #E6E6FA">
            <div class="container">
                <div style="display: flex; margin-top: 2%; margin-left: 1%;">
                    <div>
                        <h4>{{strtoupper($campaign_name)}}</h4>
                    </div>
                    <div style="margin-left: auto; margin-right: 5%;">
                        <select class="form-select" aria-label="Default select example" wire:model.live="campaign_name">
                            <option value="cl">CL</option>
                            <option value="afff">AFFF</option>
                            <option value="paraquat">Paraquat</option>
                            <option value="round_up">Round up</option>
                        </select>
                    </div>
                </div>
                <div style="display: flex;">
                    @if($is_admin == "1")
                        <div style="margin-left: 12%;">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add">Create <i class="fa-solid fa-plus"></i></button>
                        </div>
                    @endif
                    <div style="width: 20%; @if($is_admin != "1") margin-left: 12%; @endif ">
                        <input type="text" placeholder="Search" wire:model.live="searchInput" style="padding: 1%;  width: 100%;">
                    </div>
                </div>
                <div class="content">
                    @foreach($notes_all as $data)
                        <div style="box-sizing: content-box; width: 76%; background-color: white; margin-left: 12%; padding-left: 3%; padding-right: 3%; padding-top: 1.5%; padding-bottom: 2%; margin-top: 2%; margin-bottom: 2%; word-wrap: break-word;">
                            <div class="fw-light" style="display: flex;">
                                <div class="profile-picture">
                                    <img src="{{asset('storage/'.$photo)}}" alt="Profile Picture">
                                </div>
                                <div style="margin-right: 5%;">
                                    <b>{{ucwords($fullname)}}</b>
                                    <p>{{$data->updated_at->format('M d, Y h:i')}}</p>
                                </div>
{{--                                <div style="margin-left: auto; @if($is_admin == "1") margin-right: 6%; @endif ">--}}
{{--                                    --}}
{{--                                </div>--}}
                                <div style="margin-right: 6%;">
                                    ID: {{$data->id}}
                                </div>
                                <div style="margin-right: 6%;">
                                    {{$data->tags}} @if($is_admin == "1") <i class="fa-solid fa-pen" style="font-size: 14px; margin-left: 5px; cursor: pointer" data-bs-toggle="modal" data-bs-target="#edit_tags" wire:click="edit_tags({{$data->id}})"></i> @endif
                                </div>
                                @if($is_admin == "1")
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
                            <div style="margin-top: 2%;">
                               <i class="fa-solid fa-heart" style="font-size: 20px; color: red; cursor: pointer" data-bs-toggle="modal" data-bs-target="#reactor" wire:click="reactor({{$data->id}})"></i> {{$totalHeart}}
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
                        </div>
                    @endforeach
                </div>

            </div>
        </div>

    </div>

</div>

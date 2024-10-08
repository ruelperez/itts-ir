<div>
    @include('modal.news-update.show-photo')
    @include('modal.news-update.add')
    @include('modal.news-update.edit_tags')
    @include('modal.news-update.edit')
    @include('modal.news-update.reactor')
    @include('modal.news-update.comment')
    @include('modal.news-update.comment_reactor')
    @include('modal.news-update.edit_comment')
    @include('modal.news-update.add_remove_campaign')
        <div class="px-2 py-2 px-lg-3 py-lg-3" style="background-color: #41464b;">
            <div class="row text-center">
                <div class="col-12 text-md-start">
                    <h6 style="color: white">( {{strtoupper($client_name)}}  @if($campaign_name != "all") <i class="fa-solid fa-arrow-right" style="color: #FFFF00"></i> {{strtoupper($campaign_name)}} @endif)</h6>
                </div>
                <div class="col-12  col-lg-4 col-md-6 col-xl-4 mt-2">
                    <input type="search" class="form-control w-100" placeholder="Search" wire:model.live="searchInput">
                </div>
{{--                        @if($campaign_name == "Camp lejeune" or $campaign_name == "clj")--}}
{{--                            <div class="col-4">--}}
{{--                                <a href="/itts/2/age-checker" wire:navigate style="color: white;">Age checker</a>--}}
{{--                            </div>--}}
{{--                        @endif--}}
                @if($position != "Agent")
                    <div class="col-12 col-lg-4 col-md-6 col-xl-2 mt-2 text-center">
                        <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#arc"><i class="fa-solid fa-gear"></i> Camp/Client</button>
                    </div>
                @endif
                <div class="col-12 col-md-6 col-lg-4 col-xl-2 mt-2">
                    <select class="form-select" aria-label="Default select example" wire:model.live="client_name">
                        @foreach($client_list as $list)
                            <option value="{{$list->client}}">{{strtoupper($list->client)}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 col-md-6 col-lg-4 col-xl-2 mt-2">
                    <select class="form-select" aria-label="Default select example" wire:model.live="campaign_name">
                        <option value="all">All</option>
                        @foreach($campaignList as $list)
                            <option value="{{$list->campaign}}">{{strtoupper($list->campaign)}}</option>
                        @endforeach
                    </select>
                </div>
                @if($position != "Agent")
                    <div class="col-12 col-lg-4 col-xl-2 text-md-start mt-2">
                        <i class="fa-solid fa-circle-plus" data-bs-toggle="modal" data-bs-target="#add" style="color: #00FF00; font-size: 20px; cursor: pointer"></i>
                    </div>
                @endif
            </div>
        </div>
        <div style="margin-top: 20px ;">
            @foreach($notes_all as $data)
                <div style="box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.9); background-color: white; padding-left: 3%; padding-right: 3%; padding-top: 1.5%; padding-bottom: 2%; margin-bottom: 3%;">
                    <div class="fw-light" style="display: flex;">
                        <div class="profile-picture">
                            <img src="{{asset('photos/photos/'.$data->photo)}}" alt="Profile Picture">
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
                    <div style="font-size: 15px;" >
                        <div style="display: flex">
                            <div style="width: 60%;">
                                Title:  <b>{{strtoupper($data->title)}}</b><br>
                                Campaign: <b>{{strtoupper($data->campaign)}}</b><br>
                                Client: <b>{{strtoupper($data->client)}}</b><br>
                                Law firm: <b>{{strtoupper($data->lawfirm)}}</b><br>
                                Method: <b style="margin-right: 20px;">{{ucwords($data->method)}}</b> DID: <b>{{$data->did}}</b><br>
                                Schedule: <b>{{strtoupper($data->schedule)}}</b> </b><br>
                                GEO: <b>{{strtoupper($data->geo)}}</b> </b><br>
                                Restriction: <b>{{strtoupper($data->restriction)}}</b> </b><br>
                            </div>
                            <div style="width: 40%;">
                                <div>
                                    @if($data->campaign_stat == "active")
                                        <div style="color: green; display: flex; margin-left: auto;">
                                            <i class="fa-solid fa-circle" style="margin-right: 5px; margin-left: auto"></i> <h5>ACTIVE</h5>
                                        </div>
                                    @elseif($data->campaign_stat == "pause")
                                        <div style="color: red; display: flex; margin-left: auto;">
                                            <i class="fa-solid fa-circle" style="margin-right: 5px; margin-left: auto"></i> <h5>PAUSE</h5>
                                        </div>
                                    @elseif($data->campaign_stat == "dormant")
                                        <div style="color: brown; display: flex; margin-left: auto;">
                                            <i class="fa-solid fa-circle" style="margin-right: 5px; margin-left: auto"></i> <h5>DORMANT</h5>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        Link:
                        <div style="word-wrap: break-word">
                            @foreach($linkData as $linked)
                                @if($data->id == $linked->note_id)
                                    <div style="display: flex; margin-left: 5%;">
                                        <p style="margin-right: 2%;">{{ucfirst($linked->title)}}</p>
                                        <a href="{{$linked->link}}" target="_blank" >{{$linked->link}}</a><br><br>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        <hr>
                        <p style="white-space: pre-line;">{{$data->text}}</p>
                        <hr>
                        <b>LEAD COMPLIANCE</b>
                        <div style="margin-top: 1%; margin-bottom: 2%;">
                            <div class="list-group">
                                @if($data->tcpa == 1)
                                    <label class="list-group-item">
                                        <input class="form-check-input me-1" type="checkbox" disabled {{ $data->tcpa ? 'checked' : '' }}>
                                        TCPA/ LITIGATOR CHECK
                                    </label>
                                @endif
                                @if($data->tf == 1)
                                    <label class="list-group-item">
                                        <input class="form-check-input me-1" type="checkbox"  {{ $data->tf ? 'checked' : '' }} disabled>
                                        TF
                                    </label>
                                @endif
                                @if($data->blacklist == 1)
                                    <label class="list-group-item">
                                        <input class="form-check-input me-1" type="checkbox"  {{ $data->blacklist ? 'checked' : '' }} disabled>
                                        BLACKLIST
                                    </label>
                                @endif
                                @if($data->thatsthem == 1)
                                    <label class="list-group-item">
                                        <input class="form-check-input me-1" type="checkbox" {{ $data->thatsthem ? 'checked' : '' }} disabled>
                                        SMARTBACKGROUND - THATSTHEM
                                    </label>
                                @endif
                                @if($data->dupe == 1)
                                    <label class="list-group-item">
                                        <input class="form-check-input me-1" type="checkbox" {{ $data->dupe ? 'checked' : '' }} disabled>
                                        DUPE CHECK
                                    </label>
                                @endif
                                @if($data->email == 1)
                                    <label class="list-group-item">
                                        <input class="form-check-input me-1" type="checkbox"  {{ $data->email ? 'checked' : '' }} disabled>
                                        EMAIL REQUIRED
                                    </label>
                                @endif
                                @if($data->felony == 1)
                                    <label class="list-group-item">
                                        <input class="form-check-input me-1" type="checkbox"  {{ $data->felony ? 'checked' : '' }} disabled>
                                        FELONY
                                    </label>
                                @endif
                                @if($data->govt == 1)
                                    <label class="list-group-item">
                                        <input class="form-check-input me-1" type="checkbox" {{ $data->govt ? 'checked' : '' }} disabled>
                                        GOVT. ISSUED ID
                                    </label>
                                @endif
                            </div>
                        </div>
                        <img src="{{asset('photos/photos/'.$data->image)}}" style="max-width: 60%; max-height: 65%;">
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
{{--    @script--}}
{{--    <script>--}}
{{--        $wire.on('post-created', () => {--}}
{{--            $('#image').val('');--}}
{{--        });--}}
{{--    </script>--}}
{{--    @endscript--}}
</div>

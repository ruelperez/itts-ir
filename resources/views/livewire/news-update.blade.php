<div>
    @include('modal.click-settings')
    @include('partial.header')
    @include('modal.news-update.add')
    @include('modal.news-update.edit_tags')
    @include('modal.news-update.edit')
    <div style="display: flex; width: 100%;">
        <div style="width: 19%; background-color: #0077b6">
            @include('components.layouts.profile')
            <div class="div101" style="width: 80%; height: 1px; background-color: white; margin-left: 10%; margin-top: 75%;"></div>
            @include('components.layouts.navigation')
        </div>
        <div style="width: 81%; background-color: #E6E6FA">
            <div class="container">
                <div>
                    <h4 style="margin-top: 3%; margin-left: 2%;">News feed</h4>
                </div>
                <div style="display: flex; padding-top: 2%;">
                    @if($is_admin == "1")
                        <div style="margin-left: 12%;">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add">Create <i class="fa-solid fa-plus"></i></button>
                        </div>
                    @endif
                    <div style="width: 20%; margin-left: 3%;">
                        <input type="text" placeholder="Search" wire:model.live="searchInput" style="padding: 1%;  width: 100%;">
                    </div>
                </div>
                <div style="overflow: hidden; position: relative;">
                    @foreach($notes_all as $data)
                        <div style=" overflow-y: auto; box-sizing: content-box; width: 76%; background-color: white; margin-left: 12%; padding-left: 3%; padding-right: 3%; padding-top: 1.5%; padding-bottom: 2%; margin-top: 2%; margin-bottom: 2%; word-wrap: break-word;">
                            <div class="fw-light" style="display: flex;">
                                <div class="profile-picture">
                                    <img src="{{asset('photo/images.jpg')}}" alt="Profile Picture">
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
                        </div>
                    @endforeach
                </div>

            </div>
        </div>

    </div>

</div>

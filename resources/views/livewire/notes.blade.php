<div>
    @include('modal.click-settings')
    @include('modal.news-update.show-photo')
    @include('modal.Notes.add')
    @include('modal.Notes.edit')
    <div style="display: flex; width: 100%; margin-top: 135px;">
        <div style="width: 81%; margin-left: 19%;">
            <div class="container">
                <div>
                    <h5 style="margin-left: 2%; margin-top: 3%;">My Notes</h5>
                </div>
                <div style="display: flex; margin-top: 2%; width: 80%; margin-left: 10%; margin-bottom: 2%;">
                    <div>
                        <i class="fa-solid fa-circle-plus" style="font-size: 35px;cursor: pointer" data-bs-toggle="modal" data-bs-target="#addNotes"></i>
                    </div>
                    <div style="margin-left: 3%; width: 30%;">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" wire:model.live="search">
                    </div>
                </div>

{{--                color: white; background-color: #696969;--}}
                @foreach($myNotesData as $data)
                        <div style="display: flex; margin-left: 15%;width: 70%; border: solid black 1px; border-left: none; cursor: pointer; border-right: none; border-bottom: none; padding-right: 1%; ">
                            <div id="rag{{$data->id}}" onmouseover="hoverNotes({{$data->id}})" onmouseout="hoverOutNotes({{$data->id}})" style="width: 85%; padding-top: 1%; padding-bottom: 1%; padding-left: 2%;" wire:click="edit({{$data->id}})" data-bs-toggle="modal" data-bs-target="#editNotes">@if($data->title != null or $data->title != "") {{ \Illuminate\Support\Str::limit(ucfirst($data->title), 90) }} @else {{ \Illuminate\Support\Str::limit(ucfirst($data->text), 90) }} @endif</div>
                            <div onmouseover="hoverNotes({{$data->id}})" onmouseout="hoverOutNotes({{$data->id}})" wire:click="delete({{$data->id}})" wire:confirm="Are you sure you want to delete? if yes click (OK)" style="padding-top: 5px; width: 5%;  text-align: center; margin-left: auto" ><i class="fa-solid fa-trash" style="color: red; display: none; font-size: 18px;" id="myNotes{{$data->id}}"></i></div>
                            <div class="fw-light" style="margin-left: auto;  width: 10%;">{{$data->updated_at->format('m-d-Y')}}</div>
                        </div>
                @endforeach
            </div>
        </div>
        <div style="width: 19%; background-color: #0077b6; position: fixed;top: 125px; left: 0; z-index: 1000; height: 100%;">
            @include('components.layouts.profile')
            @include('components.layouts.navigation')
        </div>
    </div>
    @include('partial.header')
</div>

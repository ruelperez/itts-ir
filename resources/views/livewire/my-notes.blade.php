<div>
    @include('components.layouts.profile')
    @include('components.layouts.navigation')
    @include('modal.click-settings')
    @include('modal.news-update.show-photo')
    @include('modal.form_link.add')
    @include('modal.form_link.edit')
    <div style="display: flex; width: 100%; margin-top: 105px;">
        <div style="width: 81%; margin-left: 19%;">
            <div class="container">
                <div>
                    <h6 style="margin-left: 2%; margin-top: 3%;">FORM LINK</h6>
                </div>
                <hr>
                @if($position != "Agent")
                <div style="margin-left: 3%; margin-top: 1%; margin-bottom: 3%;">
                    <i class="fa-solid fa-circle-plus" style="font-size: 30px;cursor: pointer" data-bs-toggle="modal" data-bs-target="#addForm"></i>
                </div>
                    <a style="margin-left: 3%; " href="/itts/24/mass-tort-form">Submission Tracker</a>
                @endif
                @if($position == "Agent")
                    @foreach($dataLink as $daty)
                        @if($daty->title == "PTO - Leave Form" or $daty->title == "COC")
                            <div style="margin-left: 3%;margin-top: 2%;" onmouseover="hoverLink({{$daty->id}})" onmouseout="hoverOutLink({{$daty->id}})">
                                {{ucfirst($daty->title)}} <br> <a href="{{$daty->textLink}}" target="_blank">{{$daty->textLink}}</a>
                                <i class="fa-solid fa-pen-to-square" style="display: none; font-size: 17px; margin-left: 20px; cursor: pointer" id="myLink{{$daty->id}}" data-bs-toggle="modal" data-bs-target="#editForm" wire:click="edit({{$daty->id}})"></i>
                                <i class="fa-solid fa-trash" style="display: none; color: red; font-size: 17px; margin-left: 10px; cursor: pointer" id="myLinks{{$daty->id}}" wire:click="delete({{$daty->id}})" wire:confirm="Are you sure you want to delete? if yes click (OK)"></i>
                            </div>
                        @endif
                    @endforeach
                @else
                    @foreach($dataLink as $daty)
                        <div style="margin-left: 3%;margin-top: 2%;" onmouseover="hoverLink({{$daty->id}})" onmouseout="hoverOutLink({{$daty->id}})">
                            {{ucfirst($daty->title)}} <br> <a href="{{$daty->textLink}}" target="_blank">{{$daty->textLink}}</a>
                            <i class="fa-solid fa-pen-to-square" style="display: none; font-size: 17px; margin-left: 20px; cursor: pointer" id="myLink{{$daty->id}}" data-bs-toggle="modal" data-bs-target="#editForm" wire:click="edit({{$daty->id}})"></i>
                            <i class="fa-solid fa-trash" style="display: none; color: red; font-size: 17px; margin-left: 10px; cursor: pointer" id="myLinks{{$daty->id}}" wire:click="delete({{$daty->id}})" wire:confirm="Are you sure you want to delete? if yes click (OK)"></i>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>

    </div>
</div>

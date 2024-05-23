<div>
    @include('modal.click-settings')
    @include('modal.news-update.show-photo')
    @include('modal.faq.add')
    @include('modal.faq.edit')
    <div style="display: flex; width: 100%; margin-top: 135px;">
        <div style="width: 81%; margin-left: 19%;">
            <div class="container">
                <div>
                    <h5 style="margin-left: 2%; margin-top: 3%;">FAQ</h5>
                </div>
                <div style="display: flex; margin-top: 1%; width: 80%; margin-left: 8%; margin-bottom: 2%;">
                    <div style="margin-right: 2%; width: 15%;">
                        <select class="form-select" aria-label="Default select example" wire:model.live="campaign_name">
                            <option value="Camp lejeune">CL</option>
                            <option value="AFFF">AFFF</option>
                            <option value="Paraquat">Paraquat</option>
                            <option value="Round  Up">Round up</option>
                            <option value="CGX">CGX</option>
                            <option value="ACA">ACA</option>
                        </select>
                    </div>
                    <div style="margin-left: 1%; width: 30%;">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" wire:model.live="search">
                    </div>
                    @if($position == "Super Admin")
                        <div style="padding-top: 7px; margin-left: 2%">
                            <i class="fa-solid fa-circle-plus" style="font-size: 25px;cursor: pointer" data-bs-toggle="modal" data-bs-target="#addFaq"></i>
                        </div>
                    @endif
                </div>
                <hr>
                @foreach($faqData as $data)
                    <div style="margin-bottom: 2%; background-color: white; margin-left: 8%; margin-right: 8%; margin-top: 1%; padding: 20px; border-radius: 15px;">
                        <div style="display: flex;">
                            <div>
                                <b style="white-space: pre-line;">{{ucfirst($data->question)}} ?</b>
                            </div>
                            <div style="margin-left: auto">
                                <div class="dropdown">
{{--                                    <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">--}}
{{--                                        Dropdown link--}}
{{--                                    </a>--}}
                                    <i class="fa-solid fa-ellipsis-vertical" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false" style="font-size: 20px;"></i>

                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <li data-bs-toggle="modal" data-bs-target="#editFaq" style="cursor: pointer" wire:click="clickEdit({{$data->id}})"><a class="dropdown-item"><i class="fa-solid fa-pen" style="margin-right: 8%;"></i>Update</a></li>
                                        <li wire:click="delete({{$data->id}})" wire:confirm="Are you sure you want to delete? if yes click (OK)" style="cursor: pointer"><a class="dropdown-item"><i class="fa-solid fa-trash" style="margin-right: 8%; color: red"></i>Delete</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div style="white-space: pre-line; margin-left: 5%;">
                            {{ucfirst($data->answer)}}
                        </div>
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

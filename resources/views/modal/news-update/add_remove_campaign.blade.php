<div wire:ignore.self class="modal" tabindex="-1" id="arc">
    <div class="modal-dialog modal-sm">
        <div class="modal-content" >
            <div class="modal-header">
                <h6 class="modal-title">Add / Remove Client</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                <div class="modal-body">
                    <div class="row text-center">
                        <div class="col-6 border border-dark" style="cursor: pointer; background-color: #008000; color: white" onclick="clickCamp()" id="cmp">Campaign</div>
                        <div class="col-6 border border-dark" style="cursor: pointer" onclick="clickClient()" id="cnt">Client</div>
                    </div>
                    <hr>
                    @if($authorizer)
                        <div id="campForm">
                            <form wire:submit.prevent="submit_campaign" class="mt-3">
                                <div style="margin-left: 2%; display: flex;">
                                    <input class="form-control" type="text" placeholder="Enter Campaign" wire:model="campName" required>
                                    <button type="submit" class="btn btn-primary" style="margin-left: 2%;">Submit</button>
                                </div>
                            </form>
                            <hr>
                            <div wire:loading class="spinner-border spin" style="height: 40px; width: 40px; margin-left:43%; margin-top:10%; color: black">
                                <span class="visually-hidden" style="color: black">Loading...</span>
                            </div>
                            <div wire:loading.remove>
                                @foreach($campList as $data)
                                    <div class="row px-2 py-2" id="camp{{$data->id}}" onmouseover="campHover({{$data->id}})" onmouseout="campHoverOut({{$data->id}})">
                                        <div class="col-10">
                                            {{ucwords($data->name)}}
                                        </div>
                                        <div class="col-2 text-end">
                                            <i class="fa-solid fa-xmark text-danger" style="cursor: pointer" wire:click="campRemove({{$data->id}},'{{$data->name}}')" wire:confirm="Are you sure you want to delete {{$data->name}}?"></i>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    @if($authorizer)
                        <div style="display: none" id="clientForm">
                            <form wire:submit.prevent="submit_client" class="mt-3">
                                <div style="margin-left: 2%; display: flex;">
                                    <input class="form-control" type="text" placeholder="Enter Client" wire:model="cntName" required>
                                    <button type="submit" class="btn btn-primary" style="margin-left: 2%;">Submit</button>
                                </div>
                            </form>
                            <hr>
                            <div wire:loading class="spinner-border spin" style="height: 40px; width: 40px; margin-left:43%; margin-top:10%; color: black">
                                <span class="visually-hidden" style="color: black">Loading...</span>
                            </div>
                            <div wire:loading.remove>
                                @foreach($clientList as $data)
                                    <div class="row px-2 py-2" id="camp{{$data->id}}" onmouseover="campHover({{$data->id}})" onmouseout="campHoverOut({{$data->id}})">
                                        <div class="col-10">
                                            {{ucwords($data->name)}}
                                        </div>
                                        <div class="col-2 text-end">
                                            <i class="fa-solid fa-xmark text-danger" style="cursor: pointer" wire:click="clientRemove({{$data->id}},'{{$data->name}}')" wire:confirm="Are you sure you want to delete {{$data->name}}?"></i>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
                <hr>
                <div style="display: flex;">
                    <div style="margin-left: 3%;">
                        @if(session()->has('goodClient'))
                            <div class="alert alert-success" style="width: 100%; " >
                                {{ session('goodClient') }}
                            </div>
                        @elseif(session()->has('badClient'))
                            <div class="alert alert-danger" style="width: 100%; ">
                                {{ session('badClient') }}
                            </div>
                        @endif
                    </div>
                </div>
        </div>
    </div>
</div>

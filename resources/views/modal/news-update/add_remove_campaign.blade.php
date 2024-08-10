<div wire:ignore.self class="modal" tabindex="-1" id="arc">
    <div class="modal-dialog modal-sm">
        <div class="modal-content" >
            <div class="modal-header">
                <h6 class="modal-title">Add / Remove Client</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                <div class="modal-body">
                    @if($position != "Agent")
                        <form wire:submit.prevent="submit_client">
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
                    @endif
                </div>
                <hr>
                <div style="display: flex;">
                    <div style="margin-left: 3%;">
                        @if(session()->has('good'))
                            <div class="alert alert-success" style="width: 100%; " >
                                {{ session('good') }}
                            </div>
                        @elseif(session()->has('bad'))
                            <div class="alert alert-danger" style="width: 100%; ">
                                {{ session('bad') }}
                            </div>
                        @endif
                    </div>
                </div>
        </div>
    </div>
</div>

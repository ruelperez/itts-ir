<div wire:ignore.self class="modal fade" id="add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="height: 550px;">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent="submitAdd">
                    <div class="mb-4">
                        <label for="exampleInputPassword1" class="form-label">Serial number</label>
                        <input type="text" class="form-control" wire:model.live="serial" required>
                        <div style="position: absolute; width: 93%; box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.9);">
                            <ul class="list-group">
                                @php $h=0; @endphp
                                @foreach($results as $data)
                                    @if($h < 6)
                                        <li class="list-group-item btn" style="text-align: left; background-color: #E0FFFF" wire:click="click_items({{$data->id}})">
                                            {{$data->serial}}
                                        </li>
                                    @endif
                                    @php $h++; @endphp
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Device type</label>
                        <input type="text" class="form-control" wire:model="device_name" required disabled>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Brand name</label>
                        <input type="text" class="form-control" wire:model="brand_name" required disabled>
                    </div>
                    <div class="mb-4">
                        <label for="exampleInputPassword1" class="form-label">Quantity</label>
                        <input type="text" class="form-control" wire:model="quantity" required disabled>
                    </div>
                    <button type="submit" class="btn btn-primary mb-3">Submit</button>
                    @if(session()->has('good'))
                        <div class="alert alert-success" style="width: 100%; " wire:ignore>
                            {{ session('good') }}
                        </div>
                    @elseif(session()->has('bad'))
                        <div class="alert alert-danger" style="width: 100%; " wire:ignore>
                            {{ session('bad') }}
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>

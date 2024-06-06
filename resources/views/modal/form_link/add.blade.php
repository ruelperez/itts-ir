<div wire:ignore.self class="modal fade" id="addForm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
    <div class="modal-dialog modal-lg" >
        <div class="modal-content" style="height: 220px">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add link</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form wire:submit.prevent="submit">
                    <div class="user-form mb-2" style="display: flex">
                        <input class="form-control" type="text" placeholder="Enter title" wire:model="title" style="width: 25%;">
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="1" placeholder="Enter link"  wire:model="textlink" style="width: 60%; margin-left: 1%"></textarea>
                    </div>
                    <div class="modal-footer mt-4">
                        <div style="width: 50%;">
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
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

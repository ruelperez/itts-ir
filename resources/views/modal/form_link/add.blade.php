<div wire:ignore.self class="modal fade" id="addForm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
    <div class="modal-dialog modal-lg" >
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add link</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent="submit">
                    <div class="row mt-2">
                        <div class="col-lg-6">
                            <input class="form-control" type="text" placeholder="Enter title" wire:model="title" style="width: 100%;">
                        </div>
                        <div class="mt-2  col-lg-12  mt-lg-0 order-lg-3 mt-lg-3">
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="1" placeholder="Enter link"  wire:model="textlink" style="width: 100%;"></textarea>
                        </div>
                        <div class="mt-2 col-lg-4 mt-lg-0 order-lg-2">
                            <select class="form-select" aria-label="Default select example" wire:model="serveFor" required>
                                <option value="">Select Source</option>
                                <option value="Admin">Admin</option>
                                <option value="Agent">Agent</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-lg-6">
                            <button type="submit" class="btn btn-primary w-100">Submit</button>
                        </div>
                        <div class="mt-2 col-lg-4 mt-lg-0">
                            <button type="button" class="btn btn-secondary w-100" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

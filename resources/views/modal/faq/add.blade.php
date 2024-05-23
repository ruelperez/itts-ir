<div wire:ignore.self class="modal fade" id="addFaq" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Enter FAQ</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
             <form wire:submit.prevent="submit">
                 <div class="modal-body">
                     <textarea class="form-control" rows="1" wire:model="question" style="border: none;" placeholder="Enter question here" required></textarea>
                     <hr>
                     <textarea class="form-control" rows="10" wire:model="answer" style="border: none;" placeholder="Enter answer here" required></textarea>
                 </div>
                 <div class="modal-footer">
                     @if(session()->has('good'))
                         <div class="alert alert-success" style="width: 50%; ">
                             {{ session('good') }}
                         </div>
                     @elseif(session()->has('bad'))
                         <div class="alert alert-danger" style="width: 50%; ">
                             {{ session('bad') }}
                         </div>
                     @endif
                     <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                     <button type="submit" class="btn btn-warning">Submit</button>
                 </div>
             </form>
        </div>
    </div>
</div>

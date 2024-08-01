<div wire:ignore.self class="modal fade" id="removedOrUpdate" style="top: 25%;">
    <div class="modal-dialog modal-sm">
        <div class="modal-content" style="height: 200px;">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" ></button>
            </div>
            <div class="modal-body" style="text-align: center">
                @if($hin == "removed")
                    @if($is_success == true)
                        <i class="fa fa-check-circle" style="color: green; font-size: 35px"></i>
                        <p class="mt-3">Successfully Removed!</p>
                    @else
                        <i class="fa-solid fa-circle-exclamation" style="color: red; font-size: 35px"></i>
                        <p class="mt-3">Failed to Remove!</p>
                    @endif
                @else
                    @if($is_success == true)
                        <i class="fa fa-check-circle" style="color: green; font-size: 35px"></i>
                        <p class="mt-3">Successfully Saved!</p>
                    @else
                        <i class="fa-solid fa-circle-exclamation" style="color: red; font-size: 35px"></i>
                        <p class="mt-3">Failed to Save!</p>
                    @endif
                @endif

            </div>
        </div>
    </div>
</div>

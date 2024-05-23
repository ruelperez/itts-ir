<div>
    @include('modal.click-settings')
    @include('modal.news-update.show-photo')
    @include('modal.faq.add')
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
                    <div style="padding-top: 7px; margin-left: 2%">
                        <i class="fa-solid fa-circle-plus" style="font-size: 25px;cursor: pointer" data-bs-toggle="modal" data-bs-target="#addFaq"></i>
                    </div>
                </div>
                <hr>
            </div>
        </div>
        <div style="width: 19%; background-color: #0077b6; position: fixed;top: 125px; left: 0; z-index: 1000; height: 100%;">
            @include('components.layouts.profile')
            @include('components.layouts.navigation')
        </div>
    </div>
    @include('partial.header')
</div>

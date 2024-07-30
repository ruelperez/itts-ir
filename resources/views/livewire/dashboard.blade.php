<div>
    @include('components.layouts.profile')
    @include('components.layouts.navigation')
    @include('modal.click-settings')
    @include('modal.news-update.show-photo')
    @include('modal.dashboard.anounce')
    <div style="display: flex; width: 100%; margin-top: 105px;">
        <div style="width: 81%; margin-left: 19%;">
            <div class="container">
                <div class="row">
                    <div class="col-4" style="border: solid black 1px">
                        <div class="oval-container">
                            <img src="{{asset('photo/announcement.jpg')}}" alt="Description of image" class="oval-image">
                        </div>
                        <i class="fa-solid fa-circle-plus" style="font-size: 20px; margin-left: 45%; cursor: pointer" data-bs-toggle="modal" data-bs-target="#add"></i>
                        <div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('partial.header')
</div>

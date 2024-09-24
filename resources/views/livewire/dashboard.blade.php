<div>
    @include('modal.click-settings')
    @include('modal.news-update.show-photo')
    @include('modal.dashboard.anounce')
    @include('modal.dashboard.saveOrNot')
    @include('modal.dashboard.click-data')
    @include('modal.dashboard.removedOrUpdate')
    <div class="container">
        <div class="row">
            <div class="col-4 pb-3" style="background-color: #2F4F4F">
                <div style="width: 200px; /* Set the desired width of the container */
                                    height: 150px; /* Set the desired height of the container */
                                    overflow: hidden;
                                    display: flex;
                                    align-items: center;
                                    justify-content: center;
                                    margin-top: 20px;
                                    margin-left: 2%;">
                    <img src="{{asset('photo/announcement.jpg')}}" alt="Description of image" style="width: 100%;height: 100%;object-fit: cover;border-radius: 50%; /* Makes the image oval */">
                </div>
                @if($position != "Agent")
                    <i class="fa-solid fa-circle-plus" style="font-size: 20px; cursor: pointer; color: white;" data-bs-toggle="modal" data-bs-target="#add"></i>
                @endif
                <hr style="color: white">
                @foreach($announceData as $data)
                    <div style="color: white; @if($position != "Agent") cursor: pointer @endif" class="px-2 rounded" @if($position != "Agent") data-bs-toggle="modal" data-bs-target="#clickData" wire:click="clickData({{$data->id}})" @endif>
                        <div class="fw-light text-end mb-1"><small>{{$data->updated_at->format('M-d-Y')}}</small></div>
                        <h5>{{ucwords($data->title)}}</h5>
                        <p style="white-space: pre-line;" class="text-break">{{ucfirst($data->text)}}</p>
                    </div>
                    <hr style="color: white">
                @endforeach
            </div>
        </div>
    </div>
    <button id="btn123" data-bs-toggle="modal" data-bs-target="#loading" style="display: none"></button>
    <button id="btn456" data-bs-toggle="modal" data-bs-target="#removedOrUpdate" style="display: none"></button>
    @script
    <script>
        $wire.on('subSubmitted', () => {
            $('#addClose').click();
            $('#btn123').click();
        });
        $wire.on('remOrUp', () => {
            $('#resClose').click();
            $('#btn456').click();
        });
    </script>
    @endscript
</div>

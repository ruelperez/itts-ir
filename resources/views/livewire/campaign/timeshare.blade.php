<div>
    @include('modal.news-update.add')
    @include('modal.news-update.edit_tags')
    @include('modal.news-update.edit')
    @include('modal.news-update.reactor')
    @include('modal.news-update.comment')
    @include('modal.news-update.comment_reactor')
    @include('modal.news-update.edit_comment')
    @include('modal.news-update.add_remove_campaign')
    <div class="px-2 py-2 px-lg-3 py-lg-3" style="background-color: #41464b;">
        <div class="row text-center">
            <div class="col-12 text-md-start">
                <h6 style="color: white">( {{strtoupper($client_name)}}  @if($campaign_name != "all") <i class="fa-solid fa-arrow-right" style="color: #FFFF00"></i> {{strtoupper($campaign_name)}} @endif)</h6>
            </div>
            <div class="col-12  col-lg-4 col-md-6 col-xl-4 mt-2">
                <input type="search" class="form-control w-100" placeholder="Search" wire:model.live="searchInput">
            </div>
            {{--                        @if($campaign_name == "Camp lejeune" or $campaign_name == "clj")--}}
            {{--                            <div class="col-4">--}}
            {{--                                <a href="/itts/2/age-checker" wire:navigate style="color: white;">Age checker</a>--}}
            {{--                            </div>--}}
            {{--                        @endif--}}
            @if($authorizer)
                <div class="col-12 col-lg-4 col-md-6 col-xl-2 mt-2 text-center">
                    <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#arc"><i class="fa-solid fa-gear"></i> Camp/Client</button>
                </div>
            @endif
            <div class="col-12 col-md-6 col-lg-4 col-xl-2 mt-2">
                <select class="form-select" aria-label="Default select example" wire:model.live="client_name">
                    @foreach($client_list as $list)
                        <option value="{{$list->client}}">{{strtoupper($list->client)}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-12 col-md-6 col-lg-4 col-xl-2 mt-2">
                <select class="form-select" aria-label="Default select example" wire:model.live="campaign_name">
                    <option value="all">All</option>
                    @foreach($campaignList as $list)
                        <option value="{{$list->campaign}}">{{strtoupper($list->campaign)}}</option>
                    @endforeach
                </select>
            </div>
            @if($authorizer)
                <div class="col-12 col-lg-4 col-xl-2 text-md-start mt-2">
                    <i class="fa-solid fa-circle-plus" data-bs-toggle="modal" data-bs-target="#add" style="color: #00FF00; font-size: 20px; cursor: pointer"></i>
                </div>
            @endif
        </div>
    </div>
    {{--    <div class="mt-2"><a href="/campaign/mass-tort/calculator"><i class="fa-solid fa-calculator me-2"></i>Depo Calculator</a> </div>--}}
    <div style="margin-top: 20px;">
        @foreach($notes_all as $data)
            <div style="box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.9); background-color: white; padding-left: 3%; padding-right: 3%; padding-top: 1.5%; padding-bottom: 2%; margin-bottom: 3%;">
                <div class="fw-light" style="display: flex;">
                    <div class="profile-picture">
                        <img src="{{asset('photos/photos/'.$data->photo)}}" alt="Profile Picture">
                    </div>
                    <div style="margin-right: 5%;">
                        <b>{{ucwords($data->user_fullname)}}</b><br>
                        <small wire:ignore class="text-muted">{{ \Carbon\Carbon::parse($data->created_at)->diffForHumans() }}</small>
                    </div>
                    {{--                                <div style="margin-left: auto; @if($is_admin == "1") margin-right: 6%; @endif ">--}}
                    {{--                                    --}}
                    {{--                                </div>--}}
{{--                    <div style="margin-right: 6%;">--}}
{{--                        ID: {{$data->id}}--}}
{{--                    </div>--}}
                    <div style="margin-right: 6%;">
                        {{$data->tags}} @if($authorizer and $data->user_id == $user_id) <i class="fa-solid fa-pen" style="font-size: 14px; margin-left: 5px; cursor: pointer" data-bs-toggle="modal" data-bs-target="#edit_tags" wire:click="edit_tags({{$data->id}})"></i> @endif
                    </div>
                    @if($authorizer and $data->user_id == $user_id)
                        <div style="margin-left: auto; margin-right: 1.5%;">
                            <i class="fa-solid fa-pen-to-square" style="cursor: pointer" title="edit" data-bs-toggle="modal" data-bs-target="#edit" wire:click="edit({{$data->id}})"></i>
                        </div>
                        <div>
                            <i class="fa-solid fa-trash" style="color: red; cursor: pointer" title="delete" type="button"
                               wire:click="delete({{$data->id}})"
                               wire:confirm="Are you sure you want to delete this post?"></i>
                        </div>
                    @endif
                </div>
                <hr>
                <div class="mt-4" style="font-size: 15px;">
                    {{-- Campaign Status at Top Right --}}
                    <div class="d-flex justify-content-end mb-3">
                        @php
                            $color = match($data->campaign_stat) {
                                'active' => 'text-success',
                                'pause' => 'text-danger',
                                'dormant' => 'text-warning',
                                default => 'text-muted'
                            };
                        @endphp
                        <span class="fw-bold {{ $color }}">
                            <i class="fa-solid fa-circle me-1"></i> {{ strtoupper($data->campaign_stat) }}
                        </span>
                    </div>

                    {{-- Content + Lead Compliance side-by-side --}}
                    <div class="row g-4">
                        {{-- Left Column: Main Details --}}
                        <div class="col-md-8">
                            <div class="bg-light rounded shadow-sm p-4 h-100">
                                <p class="mb-2"><strong>Title :</strong> {{ strtoupper($data->title) }}</p>
                                <p class="mb-2"><strong>Campaign :</strong> {{ strtoupper($data->campaign) }}</p>
                                <p class="mb-2"><strong>Client :</strong> {{ strtoupper($data->client) }}</p>

                                {{-- Link Section --}}
                                @foreach($linkData as $linked)
                                    @if($data->id == $linked->note_id)
                                        <p class="mb-2"><strong>Link :</strong></p>
                                        <div class="ms-3 mb-2">
                                            <span class="me-1">{{ ucfirst($linked->title) }}:</span>
                                            <a href="{{ $linked->link }}" target="_blank" class="text-primary text-break">{{ $linked->link }}</a>
                                        </div>
                                    @endif
                                @endforeach

                                {{-- Note --}}
                                <p class="mt-3 mb-0" style="white-space: pre-line;">
                                    <i>Note :</i> {{ $data->text }}
                                </p>
                            </div>
                        </div>

                        {{-- Right Column: Lead Compliance --}}
                        <div class="col-md-4">
                            <div class="bg-light rounded shadow-sm p-4 h-100">
                                <h6 class="fw-bold mb-3">LEAD COMPLIANCE</h6>
                                <div class="list-group">
                                    @foreach([
                                        'tcpa' => 'TCPA/ LITIGATOR CHECK',
                                        'tf' => 'TF',
                                        'blacklist' => 'BLACKLIST',
                                        'thatsthem' => 'SMARTBACKGROUND – THATSTHEM',
                                        'dupe' => 'DUPE CHECK',
                                        'email' => 'EMAIL REQUIRED',
                                        'felony' => 'FELONY',
                                        'govt' => 'GOVT. ISSUED ID'
                                    ] as $key => $label)
                                        @if($data->$key)
                                            <label class="list-group-item d-flex align-items-center">
                                                <input class="form-check-input me-2" type="checkbox" checked disabled>
                                                <span>{{ $label }}</span>
                                            </label>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Image Section --}}
                    @php $images = json_decode($data->image, true); @endphp
                    @if(is_array($images) && count($images) > 0)
                        <div class="swiper-outer-wrapper" style="position: relative; overflow: hidden;">
                            <div class="swiper mySwiper">
                                <div class="swiper-wrapper">
                                    @foreach($images as $img)
                                        <div class="swiper-slide">
                                            <img src="{{ asset('storage/photos/campaign/' . $img) }}"
                                                 alt="Image"
                                                 class="img-fluid rounded-4">
                                        </div>
                                    @endforeach
                                </div>

                                <!-- Navigation Arrows -->
                                <div class="swiper-button-prev"></div>
{{--                                <div class="swiper-button-next"></div> <!-- ✅ Add this back -->--}}
                            </div>
                        </div>

                        <style>
                            .swiper {
                                width: 100%;
                                padding-top: 60px;
                                padding-bottom: 60px;
                                overflow: visible !important;
                            }

                            .swiper-wrapper {
                                overflow: visible !important;
                                align-items: center;
                            }

                            .swiper-slide {
                                width: auto;
                                transition: transform 0.4s ease, z-index 0.4s ease;
                                z-index: 1;
                                display: flex;
                                justify-content: center;
                                align-items: center;
                            }

                            .swiper-slide img {
                                width: 300px;
                                height: auto;
                                border-radius: 15px;
                                transition: transform 0.4s ease, box-shadow 0.4s ease;
                                transform: scale(0.9);
                                transform-origin: center center;
                            }

                            .swiper-slide-active {
                                z-index: 10 !important;
                            }

                            .swiper-slide-active img {
                                transform: scale(1.5);
                                box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
                            }

                            .swiper-button-prev,
                            .swiper-button-next {
                                color: #333;
                                background-color: white;
                                border-radius: 50%;
                                width: 44px;
                                height: 44px;
                                box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
                                top: 50%;
                                transform: translateY(-50%);
                            }

                            .swiper-button-prev::after,
                            .swiper-button-next::after {
                                font-size: 25px;
                            }

                            /* Optional: keep arrows inside bounds */
                            .swiper-button-prev {
                                left: 5px;
                                background-color: #0d6efd; /* Bootstrap Primary Blue */
                                color: white;
                                border-radius: 50%;
                                width: 54px; /* 🔧 Bigger width */
                                height: 54px; /* 🔧 Bigger height */
                                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.25); /* 💡 More shadow */
                                z-index: 20;
                            }

                            .swiper-button-next {
                                right: 5px;
                            }
                        </style>

                        <script>
                            document.addEventListener('DOMContentLoaded', function () {
                                new Swiper('.mySwiper', {
                                    slidesPerView: 'auto',
                                    centeredSlides: true,
                                    spaceBetween: 10,
                                    loop: true,
                                    grabCursor: true,
                                    navigation: {
                                        prevEl: '.swiper-button-prev',
                                        nextEl: '.swiper-button-next'
                                    },
                                });
                            });
                        </script>

                    @endif
                </div>

                @php $h=0; $g=0;
                        foreach ($heart as $fg){
                           if ($fg->note_id == $data->id){
                               $h++;
                           }
                        }

                        foreach ($all_comment as $com){
                            if ($com->note_id == $data->id){
                                $g++;
                            }
                        }
                        $totalHeart = $h;
                        $totalComment = $g;
                @endphp
                <div style="margin-top: 2%; display: flex">
                    <i class="fa-solid fa-heart" style="font-size: 20px; margin-right: 0.5%; color: red; cursor: pointer" data-bs-toggle="modal" data-bs-target="#reactor" wire:click="reactor({{$data->id}})"></i> {{$totalHeart}}
                    <u style="margin-left: 4%; cursor: pointer" data-bs-toggle="modal" data-bs-target="#comment" wire:click="commented({{$data->id}})">{{$totalComment}} Comment</u>
                </div>
                <hr>
                <div style="display: flex">
                    <div style="width: 50%; text-align: center">
                        @if(count($heart) < 1)
                            <i class="fa-regular fa-heart" style="font-size: 25px; cursor: pointer;" wire:click="clickHeart({{$data->id}})"></i>
                        @else
                            @php $n=0; @endphp
                            @foreach($heart as $hearts)
                                @if($hearts->user_id == $user_id and $hearts->note_id == $data->id)
                                    <i class="fa-solid fa-heart" style="font-size: 25px; cursor: pointer; color: red" wire:click="clickHeart({{$data->id}})"></i>
                                    @php $n++; @endphp
                                @else

                                @endif
                            @endforeach
                            @if($n == 0)
                                <i class="fa-regular fa-heart" style="font-size: 25px; cursor: pointer;" wire:click="clickHeart({{$data->id}})"></i>
                            @endif
                        @endif

                    </div>
                    <div style="width: 50%; display: flex;">
                        <i class="fa-regular fa-comment" style="margin-left: 35%; font-size: 22px; cursor: pointer;" data-bs-toggle="modal" data-bs-target="#comment" wire:click="commented({{$data->id}})"></i>
                        <p style="margin-left: 2%; cursor: pointer" data-bs-toggle="modal" data-bs-target="#comment" wire:click="commented({{$data->id}})">Comment</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    {{--    @script--}}
    {{--    <script>--}}
    {{--        $wire.on('post-created', () => {--}}
    {{--            $('#image').val('');--}}
    {{--        });--}}
    {{--    </script>--}}
    {{--    @endscript--}}
</div>
@push('css')
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <style>
        /* General animation on load */
        @keyframes fadeSlideUp {
            0% {
                opacity: 0;
                transform: translateY(30px) scale(0.98);
            }
            100% {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        /* Apply animation to each image wrapper */
        .hero-img-wrapper,
        .image-thumb-wrapper {
            animation: fadeSlideUp 0.6s ease forwards;
            opacity: 0;
        }

        /* Stagger the animation delay */
        .hero-img-wrapper {
            animation-delay: 0.1s;
        }
        .image-thumb-wrapper:nth-child(1) {
            animation-delay: 0.2s;
        }
        .image-thumb-wrapper:nth-child(2) {
            animation-delay: 0.3s;
        }

        /* Hover animation with glow */
        .hero-img-wrapper:hover img,
        .image-thumb-wrapper:hover img {
            transform: scale(1.05);
            filter: brightness(1.08);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        /* Image base styles */
        .hero-img,
        .image-thumb {
            transition: all 0.4s ease-in-out;
            border-radius: 1rem;
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    </style>
@endpush

@push('js')
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
@endpush

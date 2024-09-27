<nav class="px-3 py-2 position-fixed w-100 bg-white" style=" border-bottom: 1px solid rgba(0, 0, 0, 0.3);">
{{--    <div class="container-fluid border border-dark">--}}
        <div class="row">
            <div class="col-2 col-sm-1 btn" @click="marginLeftVar = marginLeftVar === 1 ? 0 : 1">
                <span style="font-size:27px;">&#9776; </span>
            </div>
            <div class="col-8 col-sm-10 text-center text-md-start pt-1">
                <img src="{{asset('photo/logo-banner.png')}}" width="150" x-show="marginLeftVar === 0">
            </div>
        </div>
{{--    </div>--}}
    <!-- Button for sidebar toggle -->
{{--    <button class="btn" type="button" data-bs-theme="dark" @click="marginLeftVar = marginLeftVar === 1 ? 0 : 1">--}}
{{--        <span style="font-size:27px;">&#9776; </span>--}}
{{--    </button>--}}
{{--    <div class="ms-3">--}}
{{--        <img src="{{asset('photo/logo-banner.png')}}" width="150" x-show="marginLeftVar === 0">--}}
{{--    </div>--}}

</nav>

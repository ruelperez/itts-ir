<nav class="px-3 position-fixed w-100 bg-white row pt-2" style=" z-index: 2;">
    <div class="col-8" style=" border-bottom: 1px solid rgba(0, 0, 0, 0.3);">
        <div class="row">
            <div class="col-3 col-sm-1 btn me-sm-2" @click="marginLeftVar = marginLeftVar === 1 ? 0 : 1">
                <span style="font-size:27px;">&#9776; </span>
            </div>
            <div class="col-8 pt-3" x-show="marginLeftVar === 1">
                <h6 style="font-family: 'Lora', serif;">Knowledge Base Tool</h6>
            </div>
            <div class="col-8 col-sm-10 text-md-start">
                <img src="{{asset('photo/logo-banner.png')}}" width="150" x-show="marginLeftVar === 0">
            </div>
        </div>
    </div>
    <div class="col-4 pt-sm-3 pt-md-4 text-center" style=" border-bottom: 1px solid rgba(0, 0, 0, 0.3);" x-show="marginLeftVar === 0">
       <h6 style="font-family: 'Lora', serif;">Knowledge Base Tool</h6>
    </div>
    <div class="col-4 pt-sm-3 pt-md-4 text-center" style=" border-bottom: 1px solid rgba(0, 0, 0, 0.3);" x-show="marginLeftVar === 1">

    </div>
</nav>

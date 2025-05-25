<div id="navbar-home" style="z-index:10">
    <div class="container">
        <div class="row" id="navbar-home-content">
            <div class="col-lg-3 py-3 d-flex justify-content-center">
                <div class="row position-relative" style="width: 90%;">
                    <div class="col-10 col-lg-12 d-flex justify-content-start justify-content-lg-center align-items-center" id="navbar-home-container-logo">
                        <a href="{{url('')}}"><img src="{{asset('assets/images/static/logo-text-grad.svg')}}" class="he-25"></a>
                    </div>
                    <div class="col-2 d-flex d-lg-none justify-content-end justify-content-lg-center align-items-center" id="navbar-home-container-drop">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list cursor-pointer" viewBox="0 0 16 16" id="navbar-home-button-drop">
                            <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5"/>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 d-none d-lg-flex justify-content-center align-items-start navbar-home-resp">
                <div class="row w-100 py-lg-4 px-3 px-md-5" id="navbar-home-menu">
                    <div class="col-lg-3 pt-3 pt-lg-0 pb-3 pb-lg-0 d-flex justify-content-center">
                        <a href="{{url('')}}" class="m-0 text-center td-none text-dark">Beranda</a>
                    </div>
                    <div class="col-lg-3 pb-3 pb-lg-0 d-flex justify-content-center">
                        <a href="{{url('')}}" class="m-0 text-center td-none text-dark">Tentang</a>
                    </div>
                    <div class="col-lg-3 pb-3 pb-lg-0 d-flex justify-content-center">
                        <a href="{{url('')}}" class="m-0 text-center td-none text-dark">Kegiatan</a>
                    </div>
                    <div class="col-lg-3 pb-3 pb-lg-0 d-flex justify-content-center">
                        <a href="{{url('')}}" class="m-0 text-center td-none text-dark">Pemesanan</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 pt-4 pb-2 d-none d-lg-flex justify-content-center align-items-center navbar-home-resp">
                <div class="position-relative m-0">
                    <a href="{{url('')}}" class="btn btn-outline-light rounded-pill pt-2 px-5 fsz-10 position-absolute" id="button-login">LOGIN</a>
                    <p class="btn btn-outline-light btn-lg-dark rounded-pill pt-2 px-5 fsz-10" id="navbar-home-button">LOGIN</p>
                </div>
            </div>
        </div>
    </div>
</div>
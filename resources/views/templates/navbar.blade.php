@if (session()->has('is_user'))
    <div class="rounded-pill bg-clrsuc shadow-m position-fixed left-0 bottom-0 ms-3 mb-3 px-2 py-1 z-1 fsz-8">
        <p class="m-0 text-light fw-bold">Anda telah login <i class="fas fa-check-circle"></i></p>
    </div>
@endif

<div id="navbar-home" style="z-index:10" data-aos="fade-down" data-aos-mirror="false" data-aos-delay="10" data-aos-easing="ease-in-out-back">
    <div class="container">
        <div class="row" id="navbar-home-content">
            <div class="col-lg-3 pb-4 pt-4 pt-md-2 d-flex justify-content-center">
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
                <div class="row w-100 py-lg-3 px-3 px-md-5" id="navbar-home-menu">
                    <div class="col-lg-4 pt-3 pt-lg-0 pb-3 pb-lg-0 d-flex justify-content-center">
                        <a href="{{url('')}}" class="m-0 text-center td-none text-light text-shadow d-flex align-items-center">
                            <img src="{{ asset('assets/images/static/icon/home.svg') }}" class="he-13 me-1">
                            Beranda
                        </a>
                    </div>
                    <div class="col-lg-4 pb-3 pb-lg-0 d-flex justify-content-center">
                        <a href="{{url('ruangan')}}" class="m-0 text-center td-none text-light text-shadow d-flex align-items-center">
                            <img src="{{ asset('assets/images/static/icon/ruangan.svg') }}" class="he-13 me-1">
                            Ruangan
                        </a>
                    </div>
                    <div class="col-lg-4 pb-3 pb-lg-0 d-flex justify-content-center">
                        <a href="{{url('tentang')}}" class="m-0 text-center td-none text-light text-shadow d-flex align-items-center">
                            <img src="{{ asset('assets/images/static/icon/tentang.svg') }}" class="he-16">
                            Tentang
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 pt-4 pt-lg-0 pb-4 pb-lg-0 d-none d-lg-flex justify-content-center align-items-center navbar-home-resp">
                <div class="position-relative m-0" id="navbar-home-container-login">
                    @if (session()->has('is_user'))
                        <div class="rounded-pill fsz-10 position-absolute d-flex justify-content-center align-items-center gap-2 bg-clrsuc" id="button-login">
                        </div>
                        <div class="border-light rounded-pill fsz-10 position-relative z-1 d-flex justify-content-center align-items-center gap-3" id="navbar-home-button">
                            <a href="{{ url('profil') }}">
                                <img src="{{ asset('assets/images/static/icon/user.svg') }}" class="he-18">
                            </a>
                            <p class="m-0 text-light fsz-14">|</p>
                            <a href="{{ url('riwayat') }}">
                                <img src="{{ asset('assets/images/static/icon/log.svg') }}" class="he-18">
                            </a>
                        </div>
                    @else 
                        <div class="rounded-pill fsz-10 position-absolute d-flex justify-content-center align-items-center gap-2 bg-clr2" id="button-login">
                        </div>
                        <div class="border-light rounded-pill fsz-10 position-relative z-1 d-flex justify-content-center align-items-center gap-3" id="navbar-home-button">
                            <a href="{{ url('login') }}">
                                <img src="{{ asset('assets/images/static/icon/user.svg') }}" class="he-18">
                            </a>
                            <p class="m-0 text-light fsz-14">|</p>
                            <a href="{{ url('riwayat') }}">
                                <img src="{{ asset('assets/images/static/icon/log.svg') }}" class="he-18">
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<div class="bg-clr3">
    <div class="container">
        <div class="row justify-content-center m-0" style="padding-top:160px;padding-bottom:110px">
            <div class="card bg-clr1 p-3 p-md-4 p-xl-5">
                <div class="row">
                    <div class="col-md-4 d-flex flex-column">
                        <div class="card rounded-m shadow-m bg-clrgold mb-2 p-4">
                            <div class="d-flex justify-content-center mb-4">
                                <img src="{{ $avatar }}" alt="Profil" class="rounded-circle shadow-m">
                            </div>
                            <div class="text-center">
                                <h5 class="text-dark fw-bold">{{ $profil['customer_fullname'] }}</h5>
                                <p class="fsz-11 text-dark m-0">{{ $profil['customer_email'] }}</p>
                            </div>
                            <div class="d-flex justify-content-center mt-4">
                                <a href="#" data-bs-toggle="modal" data-bs-target="#modalLogout" class="btn btn-clrdang rounded-m px-3 py-2 fsz-11 lh-1">Keluar <i class="fas fa-sign-out"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="row mb-5">
                            <div class="col-12 col-md-3 d-flex justify-content-center">
                                <div class="he-40 d-flex justify-content-center align-items-center">
                                    <a href="{{{ url('profil') }}}" class="td-none fw-bold text-shadow text-center d-block lh-1 @if($profil_page == 'index') text-warning @else text-light @endif">Profil</a>
                                </div>
                            </div>
                            <div class="col-12 col-md-3 d-flex justify-content-center">
                                <div class="he-40 d-flex justify-content-center align-items-center">
                                    <a href="{{{ url('profil') }}}" class="td-none fw-bold text-shadow text-center d-block lh-1 @if($profil_page == 'edit-profil') text-warning @else text-light @endif">Edit Profil</a>
                                </div>
                            </div>
                            <div class="col-12 col-md-3 d-flex justify-content-center">
                                <div class="he-40 d-flex justify-content-center align-items-center">
                                    <a href="{{{ url('profil') }}}" class="td-none fw-bold text-shadow text-center d-block lh-1 @if($profil_page == 'edit-password') text-warning @else text-light @endif">Edit Password</a>
                                </div>
                            </div>
                            <div class="col-12 col-md-3 d-flex justify-content-center">
                                <div class="he-40 d-flex justify-content-center align-items-center">
                                    <a href="{{{ url('profil') }}}" class="td-none fw-bold text-shadow text-center d-block lh-1 @if($profil_page == 'riwayat') text-warning @else text-light @endif">Riwayat</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalLogout" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialogmd modal-dialog-centered modal-dialog-scrollable" style="width:100%;">
        <div class="modal-content rounded-m">
            <div class="modal-header bg-clrdang text-light">
                <h3 class="modal-title fw-bold">Peringatan</h3>
                <button type="button" class="ms-auto hover bg-clrdang border-light text-light rounded-circle he-28 we-28" data-bs-dismiss="modal" aria-label="Close">x</button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin keluar dari aplikasi?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <a href="{{ url('logout') }}" class="btn btn-clrdang">Keluar</a>
            </div>
        </div>
    </div>
</div>
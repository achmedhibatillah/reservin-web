<div class="bg-clr3">
    <div class="container">
        <div class="row justify-content-center m-0" style="padding-top:160px;padding-bottom:110px">
            <div class="card bg-clr1 p-3 p-md-4 p-xl-5">
                <div class="row">
                    <div class="col-md-4 d-flex flex-column">
                        @include('templates/flashdata')
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
                    <div class="col-md-8 pt-5 pt-md-0">
                        <div class="card">
                            <div class="row">
                                <div class="col-md-5 pt-3">
                                    <div class="w-100 overflow-hidden rounded p-2 pe-md-0" style="height:200px">
                                        @if (!empty($riwayat['room_images']))
                                            <img src="{{ $riwayat['room_images'][0]['ri_image'] }}" class="img-cover shadow-m rounded">
                                        @else 
                                            <img src="{{ asset('assets/images/static/blank-room.svg') }}" class="img-cover shadow-m rounded">
                                        @endif
                                    </div>
                                    <a href="{{ url('ruangan/' . $riwayat['room_id']) }}" class="td-hover p-2 pt-0 fsz-10 text-center text-md-start d-block">Lihat ruangan <i class="fas fa-arrow-right ms-2"></i></a>
                                </div>
                                <div class="col-md-7 px-4 px-md-0 py-4 text-center text-md-start">
                                    <div class="mb-4 d-flex justify-content-center justify-content-md-start">
                                        @if ($riwayat['position'] == 'upcoming') 
                                            <p class="bg-clrprim rounded-pill fsz-10 m-0 px-2">Mendatang</p>
                                        @elseif ($riwayat['position'] == 'ongoing')
                                            <p class="bg-clrsuc rounded-pill fsz-10 m-0 px-2">Berjalan</p>
                                        @elseif ($riwayat['position'] == 'past')
                                            <p class="bg-clrsec rounded-pill fsz-10 m-0 px-2">Berakhir</p>
                                        @endif
                                    </div>
                                    <div class="mb-1">
                                        <p class="fsz-10 m-0 text-secondary">Kode booking</p>
                                        <p class="text-clr2 m-0">{{ $riwayat['booking_code'] }}</p>
                                    </div>
                                    <div class="mb-3">
                                        <h5 class="text-clr1 fw-bold">{{ $riwayat['room_name'] }}</h5>
                                        <p class="text-clr1 fsz-10 m-0">{{ $riwayat['booking_date'] }}</p>
                                        <p class="text-clr1 fsz-10 m-0">{{ $riwayat['booking_start'] }} - {{ $riwayat['booking_end'] }}</p>
                                        <p class="text-clr1 fsz-10 m-0 text-clrsuc">Rp. {{ $riwayat['booking_price'] }}</p>
                                    </div>
                                    <div class="m-0">
                                        <p class="fsz-10 text-secondary m-0">Tujuan peminjaman :</p>
                                        <p class="m-0">{{ $riwayat['booking_desc'] }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
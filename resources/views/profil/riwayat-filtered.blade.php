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
                        <h4 class="text-center text-md-start text-light fw-bold mb-3">
                            Riwayat
                            @if ($time_order == 'upcoming') Mendatang @elseif ($time_order == 'ongoing') Berjalan @elseif ($time_order == 'past') Berlalu @endif
                        </h4>
                        @foreach ($riwayat['booking'] as $x)
                            @if ($x['position'] == $time_order)
                                <div class="card mb-3">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="w-100 overflow-hidden rounded p-2 pe-md-0" style="height:100px">
                                                @if (!empty($x['room_images']))
                                                    <img src="{{ $x['room_images'][0]['ri_image'] }}" class="img-cover shadow-m rounded">
                                                @else 
                                                    <img src="{{ asset('assets/images/static/blank-room.svg') }}" class="img-cover shadow-m rounded">
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6 px-4 px-md-0 py-2 text-center text-md-start">
                                            <div class="mb-1">
                                                <p class="fsz-10 m-0 text-secondary">Kode booking</p>
                                                <p class="text-clr2 m-0">{{ $x['booking_code'] }}</p>
                                            </div>
                                            <h5 class="text-clr1 fw-bold">{{ $x['room_name'] }}</h5>
                                            <p class="text-clr1 fsz-10 m-0">{{ $x['booking_date'] }}</p>
                                            <p class="text-clr1 fsz-10 m-0">{{ $x['booking_start'] }} - {{ $x['booking_end'] }}</p>
                                            <p class="text-clr1 fsz-10 m-0 text-clrsuc">Rp. {{ $x['booking_price'] }}</p>
                                        </div>
                                        <div class="col-md-3 p-2 pe-md-4 d-flex flex-column align-items-center">
                                            <a href="{{ url('riwayat/' . $x['booking_code']) }}" class="btn btn-clr2 w-75 d-flex justify-content-center align-items-center gap-2 fsz-10">Detail <i class="fas fa-arrow-right fsz-9"></i></a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                        @if ($riwayat['to_' . $time_order] == 0)
                            <div class="card bg-clrsec p-3 mb-3">
                                <p class="text-clr5 m-0 text-center text-md-start">Tidak ada riwayat</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

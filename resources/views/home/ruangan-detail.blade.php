<div class="bg-clr3 position-relative">
    <div class="position-absolute d-flex justify-content-start" style="top:0;left:0;">
        <img src="{{ asset('assets/images/static/effect/sun-gold-left-top.svg') }}" class="w-75">
    </div>
    <div class="position-absolute d-flex justify-content-end" style="bottom:0;right:0;">
        <img src="{{ asset('assets/images/static/effect/sun-gold-right-bottom.svg') }}" class="w-75">
    </div>
    <div class="container">
        <div class="row m-0" style="padding-top:160px;padding-bottom:110px">
            <div class="col-md-7">
                <h1 class="text-clr2 fw-900 text-shadow">{{ $room['room_name'] }}</h1>
                <div class="mt-3">
                    @if(count($room['images']) === 0)
                        <img src="{{ asset('assets/images/static/blank-room.svg') }}" class="rounded" style="width:60%;">
                    @elseif(count($room['images']) === 1)
                        <img src="{{ $room['images'][0]['ri_image'] }}" class="w-100">
                    @elseif(count($room['images']) === 2)
                        <div class="row">
                            <div class="col-md-6 p-1">
                                <div class="bg-web rounded" style="height:200px;background-image:url('{{ $room['images'][0]['ri_image'] }}')"></div>
                            </div>
                            <div class="col-md-6 p-1">
                                <div class="bg-web rounded" style="height:200px;background-image:url('{{ $room['images'][1]['ri_image'] }}')"></div>
                            </div>
                        </div>
                        <a href="#" class="td-hover text-clr2 mt-3 d-block" data-bs-toggle="modal" data-bs-target="#modalFoto">
                            Lihat semua foto <i class="fas fa-arrow-right"></i>
                        </a>
                    @elseif(count($room['images']) > 2)
                        <div class="row">
                            <div class="col-6 p-1">
                                <div class="bg-web rounded" style="height:410px;background-image:url('{{ $room['images'][0]['ri_image'] }}')"></div>
                            </div>
                            <div class="col-6 p-1">
                                <div class="bg-web rounded" style="height:200px;background-image:url('{{ $room['images'][1]['ri_image'] }}')"></div>
                                <div class="bg-web rounded mt-2" style="height:200px;background-image:url('{{ $room['images'][2]['ri_image'] }}')"></div>
                            </div>
                            <div class="col-6 p-1"></div>
                        </div>
                        <a href="#" class="td-hover text-clr2 mt-3 d-block" data-bs-toggle="modal" data-bs-target="#modalFoto">
                            Lihat semua foto <i class="fas fa-arrow-right"></i>
                        </a>
                    @endif
                </div> {{-- ini penutup div .mt-3 --}}
            </div> {{-- ini penutup col-md-7 --}}
            
            <div class="col-md-4">
                <h1 class="text-clr3">{{ $room['room_name'] }}</h1>
                <div class="card bg-clr4 p-3 mt-3">
                    <div class="">
                        <h5 class="text-clr2 fw-bold">Informasi Ruangan</h5>
                        <div class="mt-3 mx-3">
                            <div class="d-flex align-items-center gap-4 text-light">
                                <i class="fas fa-users"></i>
                                <p class="m-0">{{ $room['room_capacity'] }} orang</p>
                            </div>
                            <div class="mt-3 d-flex align-items-center gap-4 text-light">
                                <i class="fas fa-clock"></i>
                                <p class="m-0">{{ $room['room_start'] }} - {{ $room['room_end'] }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <h5 class="text-clr2 fw-bold">Kelengkapan Ruangan</h5>
                        <div class="mt-3 mx-3">
                            @if (count($room['facility']) !== 0)
                                <div class="row text-light">
                                    @foreach ($room['facility'] as $x)
                                        <div class="col-6">
                                            <p class="m-0">{{ $x['facility_name'] }}</p>
                                        </div>
                                    @endforeach
                                </div>
                            @else 
                                <p class="m-0 text-light">-</p>  
                            @endif
                        </div>
                    </div>
                    <div class="mt-4">
                        <h5 class="text-clr2 fw-bold">Deskripsi Ruangan</h5>
                        <div class="mt-3 mx-3">
                            <p class="m-0 text-light">{{ $room['room_desc'] }}</p>
                        </div>
                    </div>
                    <div class="mt-4">
                        <h5 class="text-clr2 fw-bold">Harga Sewa</h5>
                        <div class="mt-3 mx-3">
                            <div class="d-flex align-items-center gap-2">
                                <p class="m-0 text-clr2 fw-bold fsz-20">Rp. {{ $room['room_price'] }}</p>
                                <p class="m-0 text-light">/ jam</p>
                            </div>
                        </div>
                    </div>
                    <div class="mt-5">
                        <a href="{{ url('booking/' . $room['room_id']) }}" class="btn btn-outline-light rounded-pill w-100">Pesan Sekarang</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalFoto" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <button type="button" class="position-absolute btn btn-outline-light" style="top:20px;right:20px;" data-bs-dismiss="modal" aria-label="Close">x</button>
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
        <div class="modal-content border-light">
            <div class="modal-body p-0 border-radius-none">
                <div class="m-0 px-0 px-md-4">
                    <div class="mt-5 mt-md-4">
                        <h4 class="text-clr1 fw-bold mx-1 mb-3">Foto Ruangan</h4>
                        <hr>
                    </div>
                    <div class="overflow-hidden w-75 p-0">
                        <div class="slick-carousel">
                            @foreach ($room['images'] as $x)
                                <div>
                                    <img src="{{ $x['ri_image'] }}" class="w-100 h-100 object-fit-cover" style="height: 300px; object-fit: cover;">
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.slick-prev, .slick-next { position: absolute; top: 52%; transform: translateY(-50%); z-index: 10;  }
.slick-prev { left: 5px; box-shadow: 6px rgba(0, 0, 0, 0.8) }
.slick-next { right: 5px; }

.slick-dots li button:before { color: var(--clrsec); font-size: 12px; }
.slick-dots .slick-active button:before { color: var(--clrw) !important; }
.slick-dots { position: absolute; bottom: 20px; text-shadow: 2px 2px 2px rgba(0, 0, 0, 0.8) }
.slick-dots li { width: 15px; height: 15px; margin: 0 5px; }
.slick-dots li button:before { content: "■"; text-shadow: 2px 2px 2px rgba(0, 0, 0, 0.8); }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        $('#modalFoto').on('shown.bs.modal', function () {
            const $carousel = $('.slick-carousel');

            if (!$carousel.hasClass('slick-initialized')) {
                $carousel.slick({
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: true,
                    dots: true,
                    infinite: false,
                    autoplay: false
                });
            }
        });

        // Optional: destroy on modal hide (biar bisa reinit kalau konten dinamis)
        $('#modalFoto').on('hidden.bs.modal', function () {
            const $carousel = $('.slick-carousel');
            if ($carousel.hasClass('slick-initialized')) {
                $carousel.slick('unslick');
            }
        });
    });
</script>

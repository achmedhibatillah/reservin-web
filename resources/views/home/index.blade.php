<div class="bg-web" style="max-width:100%;background-image: url('assets/images/static/bg-top.svg');padding-top:260px;padding-bottom:250px;">
    <div class="container">
        <div class="row">
            <div class="col-md-6 order-2 order-md-1 d-flex justify-content-center align-items-center">
                <div class="text-center text-md-start ms-0 ms-md-4 ms-lg-0">
                    <h4 class="text-light fw-900" data-aos="fade-up" data-aos-delay="10" data-aos-easing="ease-in-out-back">Pesan Ruangan<br>Acara Anda di</h4>
                    <h1 class="fw-900 text-clr2" style="font-size:40px" data-aos="fade-up" data-aos-delay="50" data-aos-easing="ease-in-out-back">ReservIN</h1>
                    <p class="text-light" style="max-width:300px" data-aos="fade-up" data-aos-delay="100" data-aos-easing="ease-in-out-back">Solusi cerdas untuk Anda yang ingin memesan ruangan acara dengan mudah, cepat, dan tanpa ribet.</p>
                    <a href="{{ url('booking') }}" class="btn btn-clr2" data-aos="fade-up" data-aos-delay="150" data-aos-easing="ease-in-out-back">Pesan sekarang</a>
                </div>
            </div>
            <div class="col-md-6 order-1 order-md-2 d-flex justify-content-center align-items-center">
                <div class="d-flex justify-content-center align-items-center bg-light rounded-circle p-5 shadow-l mb-5 mb-md-0" style="width:150px;height:150px;" data-aos="zoom-out" data-aos-delay="220" data-aos-easing="ease-in-out-back">
                    <img src="{{ asset('assets/images/static/logo.svg') }}" class="w-100 mt-2 ms-2" data-aos="zoom-in" data-aos-delay="400" data-aos-easing="ease-in-out-back">
                </div>
            </div>
        </div>
    </div>
</div>
<div class="bg-clr1 position-relative" style="min-height:200px">
    <div class="position-relative translate-center d-flex justify-content-center bg-clr1 w-100" style="left:50%;background:linear-gradient(to bottom, transparent, var(--clr1) 50%" id="transition">
        <div class="container mt-5" data-aos="fade-down" data-aos-delay="10" data-aos-easing="ease-in-out-back">
            <img src="{{ asset('assets/images/static/resv-style-1.svg') }}" class="w-100" style="filter:opacity(0.3)">
        </div>
    </div>
    <div class="container">
        <h1 class="text-clr2 fw-800 text-center" data-aos="fade-up" data-aos-delay="200" data-aos-easing="ease-in-out-back">RUANGAN</h1>
        <div class="data-room mt-5" data-aos="fade-up" data-aos-delay="10" data-aos-easing="ease-in-out-back">
            @foreach($roomslide as $index => $x)
            <div class="d-flex justify-content-center position-relative m-0 p-0">
                <div class="card border-clr3 rounded-m shadow m-0 pb-3 cursor-pointer position-relative overflow-hidden card-room" onclick="window.location.href='<?= url('ruangan/' . $x['room_id']) ?>'">
                    <div class="d-flex shadow-m justify-content-center align-items-center overflow-hidden m-3 rounded-m card-room-image" style="width:180px;aspect-ratio:4/5;">
                        @if(count($x['images']) === 0)
                            <img src="{{ asset('assets/images/static/blank-room.svg') }}" class="img-cover">
                        @else
                            <img src="{{ $x['images'][0]['ri_image'] }}" class="img-cover">
                        @endif
                    </div>
                    <div class="w-100 px-3">
                        <p class="text-primary fw-800 m-0">{{ $x['room_name'] }}</p>
                        <p class="text-clr2 fw-bold text-end m-0">Rp. {{ $x['room_price'] }}</p>
                        <p class="fsz-9 text-secondary text-end">/ hari</p>
                        <div class="d-flex gap-2">
                            <div class="d-flex align-items-center gap-1 fsz-10">
                                <i class="fas fa-user"></i>
                                <p class="m-0">{{ $x['room_capacity'] }} orang</p>
                            </div>
                            <div class="d-flex align-items-center gap-1 fsz-10">
                                <i class="fas fa-circle"></i>
                                <p class="m-0">{{ $x['room_kategori'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="d-flex justify-content-center mt-5">
            <a href="{{ url('ruangan') }}" class="btn btn-clr2" data-aos="fade-up" data-aos-delay="50" data-aos-easing="ease-in-out-back">Lihat lainnya</a>
        </div>
        <div class="mt-5">.</div>
    </div>
</div>
<div class="bg-clr3 position-relative pb-5">
    <div class="container">
        <img src="{{ asset('assets/images/static/dec-top-1.svg') }}" data-aos="fade-up" data-aos-delay="10" data-aos-easing="ease-in-out-back">
        <div class="row mt-5">
            <div class="col-md-7 pb-md-5 d-flex flex-column justify-content-center">
                <h3 class="text-light fw-bold text-center text-md-start" data-aos="fade-up" data-aos-delay="100" data-aos-easing="ease-in-out-back">Gedung Kreativitas Mahasiswa</h3>
                <p class="text-light mt-3 text-center text-md-start" data-aos="fade-up" data-aos-delay="200" data-aos-easing="ease-in-out-back">"Open space area" dapat diartikan sebagai area terbuka, yaitu ruang yang tidak tertutup oleh bangunan dan biasanya digunakan untuk keperluan umum, seperti taman, alun-alun, atau lapangan.</p>
            </div>
            <div class="col-md-5 d-flex align-items-center justify-content-center justify-content-md-start" data-aos="zoom-in" data-aos-delay="300" data-aos-easing="ease-in-out-back">
                <img src="{{ asset('assets/images/static/dec-room-1.svg') }}" class="w-75">
            </div>
        </div>
    </div>
</div>
<div class="bg-clr3 py-5">
    <div class="container mb-5">
        <h1 class="text-center text-clr2 fw-900 mb-4" data-aos="fade-up" data-aos-delay="10" data-aos-easing="ease-in-out-back">GALERI</h1>
        <div class="marquee marquee-top" data-aos="fade-down" data-aos-delay="300" data-aos-easing="ease-in-out-back">
            <div class="marquee-content">
              <img src="{{ asset('assets/images/dynamic/gallery/1.svg') }}" class="gal-top">
              <img src="{{ asset('assets/images/dynamic/gallery/2.svg') }}" class="gal-top">
              <img src="{{ asset('assets/images/dynamic/gallery/3.svg') }}" class="gal-top">
              <img src="{{ asset('assets/images/dynamic/gallery/4.svg') }}" class="gal-top">
              <img src="{{ asset('assets/images/dynamic/gallery/1.svg') }}" class="gal-top">
              <img src="{{ asset('assets/images/dynamic/gallery/2.svg') }}" class="gal-top">
              <img src="{{ asset('assets/images/dynamic/gallery/3.svg') }}" class="gal-top">
              <img src="{{ asset('assets/images/dynamic/gallery/4.svg') }}" class="gal-top">
            </div>
          </div>
          
          <div class="marquee marquee-bottom mt-2" data-aos="fade-up" data-aos-delay="400" data-aos-easing="ease-in-out-back">
            <div class="marquee-content">
              <img src="{{ asset('assets/images/dynamic/gallery/7.svg') }}" class="gal-bottom">
              <img src="{{ asset('assets/images/dynamic/gallery/8.svg') }}" class="gal-bottom">
              <img src="{{ asset('assets/images/dynamic/gallery/9.svg') }}" class="gal-bottom">
              <img src="{{ asset('assets/images/dynamic/gallery/10.svg') }}" class="gal-bottom">
              <img src="{{ asset('assets/images/dynamic/gallery/7.svg') }}" class="gal-bottom">
              <img src="{{ asset('assets/images/dynamic/gallery/8.svg') }}" class="gal-bottom">
              <img src="{{ asset('assets/images/dynamic/gallery/9.svg') }}" class="gal-bottom">
              <img src="{{ asset('assets/images/dynamic/gallery/10.svg') }}" class="gal-bottom">
            </div>
          </div>          
    </div>
</div>

<style>
.slick-prev { left: 0; }
.slick-next { right: 0;}
.slick-prev, .slick-next { transform: translate(0%,-50%); z-index: 10 !important; color: #ffffff; background-color: transparent; border: none; display: flex; justify-content: center; }
.slick-prev:before, .slick-next:before { color: #ffffff !important; font-size: 24px; }
.slick-prev:hover:before, .slick-next:hover:before { color: #ffffff; }
.gradient-overlay { cursor: pointer; white; height: 50%; }
.gradient-overlay:hover .img-hover { transform: scale(1.05); }

.card-room-image { transition: transform 0.3s ease; }
.card-room:hover .card-room-image { transform: scale(1.05); }
</style>
<script>
$(document).ready(function(){
    $('.data-room').slick({
        autoplay: true,
        dots: false,
        arrows: true,
        infinite: true,
        speed: 500,
        slidesToShow: 5,
        // centerMode: true,
        centerPadding: '60px', 
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 1450,
                settings: {
                    slidesToShow: 5
                }
            },
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 1,
                }
            }
        ]
    });
});
</script>
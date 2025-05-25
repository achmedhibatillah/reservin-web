<div class="bg-web" style="max-width:100%;background-image: url('assets/images/static/bg-top.svg');padding-top:260px;padding-bottom:250px;">
    <div class="container">
        <div class="row">
            <div class="col-md-6 d-flex justify-content-center align-items-center">
                <div class="text-center text-md-start">
                    <h4 class="text-light fw-900">Pesan Ruangan<br>Acara Anda di</h4>
                    <h1 class="fw-900 text-clr2" style="font-size:40px">ReservIN</h1>
                    <p class="text-light" style="max-width:300px">Solusi cerdas untuk Anda yang ingin memesan ruangan acara dengan mudah, cepat, dan tanpa ribet.</p>
                    <a href="{{ url('booking') }}" class="btn btn-clr2">Pesan sekarang</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="bg-clr1 position-relative" style="min-height:200px">
    <div class="position-relative translate-center d-flex justify-content-center bg-clr1 w-100" style="left:50%;background:linear-gradient(to bottom, transparent, var(--clr1) 50%" id="transition">
        <div class="container mt-5" style="">
            <img src="{{ asset('assets/images/static/resv-style-1.svg') }}" class="w-100">
        </div>
    </div>
    <div class="container">
        <h1 class="text-clr2 fw-800 text-center">RUANGAN</h1>
        <div class="data-room mt-5">
            @foreach($roomslide as $index => $x)
            <div class="d-flex justify-content-center position-relative m-0 p-0">
                <div class="card border-clr3 shadow m-0 position-relative overflow-hidden" onclick="window.location.href='<?= url('ruangan/' . $x['room_id']) ?>'">
                    <div class="d-flex justify-content-center align-items-center overflow-hidden" style="width:200px;aspect-ratio:3/4;">
                    </div>
                    <div class="position-absolute gradient-overlay w-100 text-center text-clr5 px-3" style="bottom:0;padding-top:42px;">
                        <div class="m-0 mb-2 lh-xs he-55 d-flex align-items-center justify-content-center shadow-l px-2" style="border-top:1px solid var(--clr5);">
                            <a href="{{ url('ruangan/' . $x['room_id']) }}" class="td-hover text-clr5" style="line-height:1;">{{ $x['room_name'] }}</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="d-flex justify-content-center mt-5">
            <a href="{{ url('ruangan') }}" class="btn btn-clr2">Lihat selengkanya</a>
        </div>
        <div class="mt-5">lorem</div>
    </div>
</div>
<div class="bg-clr3 position-relative pb-5">
    <div class="container">
        <img src="{{ asset('assets/images/static/dec-top-1.svg') }}" alt="">
        <div class="row mt-5">
            <div class="col-md-7 pb-md-5 d-flex flex-column justify-content-center">
                <h3 class="text-light fw-bold">Gedung Kreativitas Mahasiswa</h3>
                <p class="text-light mt-3">"Open space area" dapat diartikan sebagai area terbuka, yaitu ruang yang tidak tertutup oleh bangunan dan biasanya digunakan untuk keperluan umum, seperti taman, alun-alun, atau lapangan.</p>
            </div>
            <div class="col-md-5 d-flex align-items-center">
                <img src="{{ asset('assets/images/static/dec-room-1.svg') }}" class="w-75">
            </div>
        </div>
    </div>
</div>
<div class="bg-clr3 py-5">
    <div class="container">
        <h1 class="text-center text-clr2 fw-900 mb-5">KEGIATAN</h1>
        <div class="row">
            <div class="col-md-6 col-lg-3 p-2">
                <div class="card bg-light mb-3">
                    img
                </div>
            </div>
        </div>
    </div>
</div>
<div class="bg-clr3 py-5">
    <div class="container mb-5">
        <h1 class="text-center text-clr2 fw-900 mb-4">GALERI</h1>
        <div class="marquee marquee-top">
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
          
          <div class="marquee marquee-bottom mt-2">
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
        centerMode: true,
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
                    slidesToShow: 3,
                }
            }
        ]
    });
});
</script>
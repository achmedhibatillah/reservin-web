<div class="bg-clrdark position-relative d-flex justify-content-center align-items-center" style="padding:100px 0;min-height:100vh">
    <div class="card bg-transparent text-light border-clrsecgold p-3 position-relative" style="z-index:10;width:310px;">
        <div class="mt-3">
            <h5 class="text-center bg-clrdang text-clr1 rounded-pill fw-bold shadow-m">Halaman tidak Valid</h5>
            <p class="text-light text-center fsz-10 mt-3">Silakan kembali ke halaman registrasi untuk melakukan pendaftaran.</p>
        </div>
        <a href="{{ url('registrasi') }}" class="d-block td-hover text-center fsz-10 text-clrgold">Kembali <i class="fas fa-arrow-right"></i></a>
    </div>
    <div class="position-absolute d-flex justify-content-start" style="top:0;left:0;">
        <img src="{{ asset('assets/images/static/effect/sun-gold-left-top.svg') }}" class="w-75">
    </div>
    <div class="position-absolute d-flex justify-content-end" style="bottom:0;right:0;">
        <img src="{{ asset('assets/images/static/effect/sun-gold-right-bottom.svg') }}" class="w-75">
    </div>
    <div class="position-absolute justify-content-start d-none d-md-flex" style="top:0;left:0;">
        <img src="{{ asset('assets/images/static/effect/auth-text-right.svg') }}" class="w-50">
    </div>
    <div class="position-absolute justify-content-end d-none d-md-flex" style="bottom:0;right:0;">
        <img src="{{ asset('assets/images/static/effect/auth-text-left.svg') }}" class="w-50">
    </div>
</div>

<style>
.border-active { border-bottom: 1px solid var(--clrgold) }
</style>
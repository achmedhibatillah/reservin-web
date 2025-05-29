<div class="bg-clrdark position-relative d-flex justify-content-center align-items-center" style="padding:100px 0;min-height:100vh">
    <div class="card bg-transparent text-light border-clrsecgold p-3 pt-4 pb-5 position-relative" style="z-index:10;width:310px;">
        <div class="row mb-4 fsz-11">
            <div class="col-6 pe-2 d-flex justify-content-end">
                <a href="{{ url('login') }}" class="text-clrgold td-none border-active">Masuk</a>
            </div>
            <div class="col-6 ps-2 d-flex justify-content-start">
                <a href="{{ url('registrasi') }}" class="text-light td-none">Daftar</a>
            </div>
        </div>
        <div class="mb-2">
            @include('templates/flashdata')
        </div>
        <div class="">
            <p class="text-light fw-bold text-center">Selamat datang di Reservin👋</p>
            <p class="text-light fsz-10 text-center">Aplikasi reservasi yang memudahkan Anda untuk memesan ruangan rapat, kelas, kantor, studio, atau ruang lainnya hanya dalam beberapa klik.</p>
        </div>
        <form method="POST" action="/login">
            @csrf
            <div class="mb-3">
                <label for="customer_email" class="fsz-10">Email</label>
                <input type="email" name="customer_email" class="form-control fsz-10 he-40 @error('customer_email') is-invalid @enderror" id="customer_email" value="{{ old('customer_email') }}" placeholder="reservin@gmail.com">
                @error('customer_email')
                    <div class="fsz-8 text-danger mt-2 ms-2"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="customer_pass" class="fsz-10">Password</label>
                <input type="password" name="customer_pass" class="form-control fsz-10 he-40 @error('customer_pass') is-invalid @enderror" placeholder="Your password">
                @error('customer_pass')
                    <div class="fsz-8 text-danger mt-2 ms-2"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</div>
                @enderror
            </div>
            <div class="d-flex justify-content-end mb-3">
                <a href="{{ url('') }}" class="td-hover text-clrgold fsz-10 text-end">Lupa password?</a>
            </div>
            <button type="submit" class="btn btn-clrgold fsz-12 w-100 mb-3">Login</button>
            <div class="mb-3 d-flex justify-content-center align-items-center gap-3">
                <div class="flex-grow-1"><hr></div>
                <p class="m-0 fsz-10">Atau</p>
                <div class="flex-grow-1"><hr></div>
            </div>
            <a href="{{ route('google.redirect') }}" class="btn btn-light d-flex justify-content-center align-items-center fsz-11 gap-2 mb-3">
                <img src="{{ asset('assets/images/static/icon/google.svg') }}" class="he-14">
                <p class="m-0">Login dengan Google</p>
            </a>
            <p class="m-0 text-light text-center fsz-10">Belum punya akun? <a href="{{ url('registrasi') }}" class="td-hover text-clrgold">Daftar sekarang.</a></p>
        </form>
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
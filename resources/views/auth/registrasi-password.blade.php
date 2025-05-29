<div class="bg-clrdark position-relative d-flex justify-content-center align-items-center" style="padding:100px 0;min-height:100vh">
    <div class="card bg-transparent text-light border-clrsecgold p-3 pt-4 pb-5 position-relative" style="z-index:10;width:310px;">
        <div class="mb-2">
            @include('templates/flashdata')
        </div>
        <div class="">
            <div class="fsz-12 text-center">
                <div class="mb-3">
                    <p class="m-0 fsz-8">Nama lengkap</p>
                    <p class="m-0 lh-1 text-clr2">{{ $customer['registrasi_fullname'] }}</p>
                </div>
                <div class="mb-4">
                    <p class="m-0 fsz-8">Email</p>
                    <p class="m-0 lh-1 text-clr2 hide-text-1">{{ $customer['registrasi_email'] }}</p>
                </div>
                <hr class="mb-4">
                <p class="text-light fw-bold text-center">Atur Password</p>
            </div>
        </div>
        <div class="">
            @error('customer_pass')
                <div class="alert alert-danger fade show text-center fsz-10 lh-1" role="alert">
                    {{ $message }}
                    <button type="button" class="position-absolute fsz-10 border-none bg-transparent text-danger" style="top:2px;right:0;" data-bs-dismiss="alert" aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
                </div>
            @endif
        </div>
        <form method="POST" action="{{ url('registrasi/set-password') }}">
            @csrf
            <input type="hidden" name="registrasi_fullname" value="{{ $customer['registrasi_fullname'] }}">
            <input type="hidden" name="registrasi_email" value="{{ $customer['registrasi_email'] }}">
            <div class="mb-3">
                <label for="customer_pass" class="fsz-10">Password</label>
                <input type="password" name="customer_pass" class="form-control fsz-10 he-40 @error('customer_pass') is-invalid @enderror" id="customer_pass" value="{{ old('customer_pass') }}" placeholder="Min 8 karakter">
            </div>
            <div class="mb-3">
                <label for="customer_pass_confirmation" class="fsz-10">Konfirmasi Password</label>
                <input type="password" name="customer_pass_confirmation" class="form-control fsz-10 he-40 @error('customer_pass') is-invalid @enderror" id="customer_pass_confirmation" value="{{ old('customer_pass_confirmation') }}" placeholder="Min 8 karakter">
            </div>
            <button type="submit" class="btn btn-clrgold fsz-12 w-100 mt-4">Registrasi</button>
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
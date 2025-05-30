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
                    <div class="col-md-8">
                        @include('templates/top-profil')
                        <div class="ms-md-5 text-center text-md-start">
                            <div class="mb-3">
                                <p class="m-0 text-secondary">Nama</p>
                                <h4 class="text-light lh-1">{{ $profil['customer_fullname'] }}</h4>
                            </div>
                            <div class="mb-4">
                                <p class="m-0 text-secondary">Nama</p>
                                <h4 class="text-light lh-1">{{ $profil['customer_email'] }}</h4>
                            </div>
                            <div class="mb-3 mt-4 d-flex justify-content-center justify-content-md-start">
                                <a href="#" data-bs-toggle="modal" data-bs-target="#modalPengaturan" class="btn btn-clr5 rounded-pill fsz-11 px-3 py-2"><i class="fas fa-cog"></i> Pengaturan</a>
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

<!-- Modal -->
<div class="modal fade" id="modalPengaturan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialogmd modal-dialog-centered modal-dialog-scrollable" style="width:100%;">
        <div class="modal-content rounded-m">
            <div class="modal-header bg-clr5 text-clr3">
                <h3 class="modal-title fw-bold">Pengaturan</h3>
                <button type="button" class="ms-auto hover bg-clr5 border-clr3 text-clr3 rounded-circle he-28 we-28" data-bs-dismiss="modal" aria-label="Close">x</button>
            </div>
            <div class="modal-body">
                <div class="row justify-content-center mt-3">
                    <div class="col-6">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#modalEditNama" class="btn btn-clr2 text-light w-100 mb-3">Ubah nama lengkap</a>
                    </div>
                    <div class="col-6">
                        @if (session('customer')['google_id'] == null)
                            <a href="#" data-bs-toggle="modal" data-bs-target="#modalEditPass" class="btn btn-clr2 text-light w-100 mb-3">Ubah password</a> 
                        @else 
                            <div class="bg-secondary text-light w-100 mb-3 he-35 rounded d-flex justify-content-center align-items-center">Ubah password <i class="fab fa-google ms-2 fsz-11"></i></div>
                        @endif
                    </div>
                    <div class="col-6">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#modalHapusAkun" class="btn btn-clrdang text-light w-100 mb-3">Hapus akun</a>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalEditNama" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialogmd modal-dialog-centered modal-dialog-scrollable" style="width:100%;">
        <div class="modal-content rounded-m">
            <div class="modal-header bg-clr5 text-clr3">
                <h3 class="modal-title fw-bold">Pengaturan</h3>
                <button type="button" class="ms-auto hover bg-clr5 border-clr3 text-clr3 rounded-circle he-28 we-28" data-bs-dismiss="modal" aria-label="Close">x</button>
            </div>
            <div class="modal-body">
                <form action="{{ url('profil/edit-nama') }}" method="post" id="formEditNama">
                    @csrf
                    <div class="mb-3">
                        <p class="fsz-10 m-0 text-secondary">Nama lama</p>
                        <p class="text-clr1">{{ $profil['customer_fullname'] }}</p>
                    </div>
                    <div class="mb-3">
                        <label for="customer_fullname">Nama baru</label>
                        <input type="text" autocomplete="off" name="customer_fullname" id="customer_fullname" class="form-control border-clr3 @error('customer_fullname') is-invalid @enderror" placeholder="..."
                        value="{{ old('customer_fullname') }}">
                        @error('customer_fullname')
                            <div class="ms-2 fsz-10 text-danger mt-1"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</div>
                        @enderror
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-clr3 text-light" onclick="submitEditNama()">Simpan</button>
            </div>
        </div>
    </div>
</div>

@if (session('customer')['google_id'] !== 'null')
<!-- Modal -->
<div class="modal fade" id="modalEditPass" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialogmd modal-dialog-centered modal-dialog-scrollable" style="width:100%;">
        <div class="modal-content rounded-m">
            <div class="modal-header bg-clr5 text-clr3">
                <h3 class="modal-title fw-bold">Ubah password</h3>
                <button type="button" class="ms-auto hover bg-clr5 border-clr3 text-clr3 rounded-circle he-28 we-28" data-bs-dismiss="modal" aria-label="Close">x</button>
            </div>
            <div class="modal-body">
                <form action="{{ url('profil/edit-pass') }}" method="post" id="formEditPass">
                    @csrf
                    @if (session()->has('error-edit-pass'))
                        @include('templates/flashdata')
                    @endif
                    <div class="mb-3">
                        <label for="customer_pass_old">Password lama</label>
                        <input type="password" name="customer_pass_old" id="customer_pass_old" class="form-control border-clr3 @error('customer_pass_old') is-invalid @enderror" placeholder="..."
                        value="{{ old('customer_pass_old') }}">
                        @error('customer_pass_old')
                            <div class="ms-2 fsz-10 text-danger mt-1"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</div>
                        @enderror
                    </div>
                    <hr>
                    <div class="mb-3">
                        <label for="customer_pass">Password baru</label>
                        <input type="password" name="customer_pass" id="customer_pass" class="form-control border-clr3 @error('customer_pass') is-invalid @enderror" placeholder="..."
                        value="{{ old('customer_pass') }}">
                        @error('customer_pass')
                            <div class="ms-2 fsz-10 text-danger mt-1"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="customer_pass_confirmation">Konfirmasi password baru</label>
                        <input type="password" name="customer_pass_confirmation" id="customer_pass_confirmation" class="form-control border-clr3 @error('customer_pass_confirmation') is-invalid @enderror" placeholder="..."
                        value="{{ old('customer_pass_confirmation') }}">
                        @error('customer_pass_confirmation')
                            <div class="ms-2 fsz-10 text-danger mt-1"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</div>
                        @enderror
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-clr3 text-light" onclick="submitEditPass()">Simpan</button>
            </div>
        </div>
    </div>
</div>
@endif

<!-- Modal -->
<div class="modal fade" id="modalHapusAkun" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialogmd modal-dialog-centered modal-dialog-scrollable" style="width:100%;">
        <div class="modal-content rounded-m">
            <div class="modal-header bg-clrdang text-clr3">
                <h3 class="modal-title fw-bold text-light">Hapus Akun</h3>
                <button type="button" class="ms-auto hover bg-clrdang border-light text-light rounded-circle he-28 we-28" data-bs-dismiss="modal" aria-label="Close">x</button>
            </div>
            <div class="modal-body">
                <form action="{{ url('profil/hapus-akun') }}" method="post" id="formHapusAkun">
                    @csrf
                    <p>Apakah Anda yakin ingin menghapus akun Anda?</p>
                    <div class="mb-3">
                        <label for="delete_confirm">Ketik <i class="fst-normal font-price bg-clrsec text-light px-2">hapus</i> untuk menghapus akun Anda.</label>
                        <input type="text" placeholder="hapus" class="form-control border-clr4 @error('delete_confirm') is-invalid @enderror" autocomplete="off" name="delete_confirm" id="delete_confirm"
                        value="{{ old('delete_confirm') }}">
                        @error('delete_confirm')
                            <div class="ms-2 fsz-10 text-danger mt-1"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</div>
                        @enderror
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-clrdang text-light" onclick="submitHapusAkun()">Hapus</button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    @if(session()->has('errors') && (session('errors')->has('customer_fullname')))
        var myModal = new bootstrap.Modal(document.getElementById('modalEditNama'))
        myModal.show()
    @endif 
    @if(session()->has('errors') && (session('errors')->has('customer_pass_old') || session('errors')->has('customer_pass') || session('errors')->has('customer_pass_confirmation')))
        var myModal = new bootstrap.Modal(document.getElementById('modalEditPass'))
        myModal.show()
    @endif 
    @if(session()->has('error-edit-pass'))
        var myModal = new bootstrap.Modal(document.getElementById('modalEditPass'))
        myModal.show()
    @endif 
    @if(session()->has('errors') && (session('errors')->has('delete_confirm')))
        var myModal = new bootstrap.Modal(document.getElementById('modalHapusAkun'))
        myModal.show()
    @endif 
})

function submitEditNama() { document.getElementById('formEditNama').submit(); }
function submitEditPass() { document.getElementById('formEditPass').submit(); }
function submitHapusAkun() { document.getElementById('formHapusAkun').submit(); }
</script>
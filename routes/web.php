<?php
 
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;

use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\TestController;
use App\Http\Middleware\CustomerMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);
Route::get('ruangan', [HomeController::class, 'ruangan']);
Route::get('ruangan/{slug}', [HomeController::class, 'ruangan_detail']);
Route::get('tentang', [HomeController::class, 'tentang']);

Route::middleware([CustomerMiddleware::class])->group(function () {
    Route::get('profil', [ProfilController::class, 'index']);

    Route::post('profil/edit-nama', [ProfilController::class, 'edit_nama']);
    Route::post('profil/edit-pass', [ProfilController::class, 'edit_pass']);
    Route::post('profil/hapus-akun', [ProfilController::class, 'hapus_akun']);

    Route::get('riwayat', [ProfilController::class, 'riwayat']);
    Route::get('riwayat/{slug}', [ProfilController::class, 'riwayat']);

    Route::get('booking/{slug}', [HomeController::class, 'booking']);
    Route::get('booking-konfirmasi/{slug}', [HomeController::class, 'booking_konfirmasi']);
    Route::get('booking-pembayaran/{slug}', [HomeController::class, 'booking_pembayaran']);

    Route::post('booking', [BookingController::class, 'booking']);
    Route::post('booking-konfirmasi', [BookingController::class, 'booking_konfirmasi']);
    Route::post('booking-pembayaran', [BookingController::class, 'booking_pembayaran']);
    Route::post('paid-off', [BookingController::class, 'paid_off']);
});

Route::get('login', [AuthController::class, 'showLoginForm']);
Route::post('login', [AuthController::class, 'login']);

Route::get('registrasi', [AuthController::class, 'showRegistrasiForm']);
Route::post('registrasi', [AuthController::class, 'registrasi']);
Route::get('registrasi/info-{slug}', [AuthController::class, 'showRegistrasiInfo']);
Route::get('registrasi/{slug}', [AuthController::class, 'showPasswordRegistrasiForm']);
Route::post('registrasi/set-password', [AuthController::class, 'registrasi_password']);

Route::get('auth/redirect/google', [GoogleController::class, 'redirect'])->name('google.redirect');
Route::get('auth/callback/google', [GoogleController::class, 'callback'])->name('google.callback');

Route::get('/dashboard', [AuthController::class, 'dashboard']);


Route::get('s', function () { return session()->all(); });
Route::get('d', function () { session()->flush(); return redirect()->back(); });
Route::get('logout', function () { session()->flush(); return redirect()->to(''); });

Route::get('test', [PaymentController::class, 'index']);
Route::get('c', [HomeController::class, 'check']);
Route::get('mail', [MailController::class, 'send']);
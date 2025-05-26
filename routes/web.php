<?php
 
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;

use App\Http\Controllers\Auth\GoogleController;

use App\Http\Middleware\CustomerMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);
Route::get('ruangan', [HomeController::class, 'ruangan']);
Route::get('ruangan/{slug}', [HomeController::class, 'ruangan_detail']);

Route::middleware([CustomerMiddleware::class])->group(function () {
    Route::get('ruangan/{slug}/booking', [HomeController::class, 'ruangan_booking']);
    Route::post('ruangan/{slug}/booking', [HomeController::class, 'ruangan_booking']);
});

Route::get('login', [AuthController::class, 'showLoginForm']);
Route::post('login', [AuthController::class, 'login']);

Route::get('registrasi', [AuthController::class, 'showRegistrasiForm']);
Route::post('registrasi', [AuthController::class, 'registrasi']);
Route::get('registrasi/set-password', [AuthController::class, 'showPasswordRegistrasiForm']);

Route::get('auth/redirect/google', [GoogleController::class, 'redirect'])->name('google.redirect');
Route::get('auth/callback/google', [GoogleController::class, 'callback'])->name('google.callback');

Route::get('/dashboard', [AuthController::class, 'dashboard']);


Route::get('s', function () { return session()->all(); });
Route::get('d', function () { session()->flush(); return redirect()->back(); });
Route::get('c', [HomeController::class, 'check']);
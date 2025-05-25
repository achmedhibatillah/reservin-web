<?php
 
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);
Route::get('ruangan', [HomeController::class, 'ruangan']);
Route::get('ruangan/{slug}', [HomeController::class, 'ruangan_detail']);
Route::get('ruangan/{slug}/booking', [HomeController::class, 'ruangan_booking']);
Route::post('ruangan/{slug}/booking', [HomeController::class, 'ruangan_booking']);

Route::get('/login', [AuthController::class, 'showLoginForm']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/dashboard', [AuthController::class, 'dashboard']);

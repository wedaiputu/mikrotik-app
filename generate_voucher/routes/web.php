<?php

use App\Http\Controllers\AdminPageController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GenerateController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RouterController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\VoucherController;
use Illuminate\Support\Facades\Route;


Route::get('/', [AuthController::class, 'login'])->name('login');
// Route::get('/', [PageController::class, 'index'])->name('index');
Route::get('/dashboard', [RouterController::class, 'index'])->name('dashboard');
Route::get('/admin', [AdminPageController::class, 'index'])->name('admin');

// Route::get('/voucher', [VoucherController::class, 'index'])->name('voucher');
// Route::post('/voucher/store', [VoucherController::class, 'store'])->name('voucher.store');
Route::get('/session', [SessionController::class, 'index'])->name('session');
Route::get('/sessionstore', [SessionController::class, 'store'])->name('sessionstore');

Route::middleware(['save.profile'])->group(function () {
    Route::get('/voucher/create', [VoucherController::class, 'create'])->name('vouchers.create');
    Route::post('/voucher/store', [VoucherController::class, 'store'])->name('vouchers.store');
});
Route::get('/gen', [GenerateController::class, 'generate'])->name('generate');
// Login and AdminPageController routes
Route::get('/login', [AdminPageController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AdminPageController::class, 'login']);
Route::post('/logout', [AdminPageController::class, 'logout'])->name('logout');

// GenerateController routes
Route::get('/generate', function () {
    return view('generate');
})->name('generate.voucher');

Route::post('/generate', [GenerateController::class, 'generate'])->name('generate.voucher.post');
<?php

use App\Http\Controllers\AdminPageController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GenerateController;
use App\Http\Controllers\RouterController;
use App\Http\Controllers\VoucherController;
use Illuminate\Support\Facades\Route;


Route::get('/', [AuthController::class, 'login'])->name('login');
Route::get('/dashboard', [RouterController::class, 'index'])->name('dashboard');
Route::get('/admin', [AdminPageController::class, 'index'])->name('admin');

Route::get('/voucher', [VoucherController::class, 'index'])->name('voucher');
// Route::post('/voucher', [VoucherController::class, 'index'])->name('voucher');
Route::get('/gen', [GenerateController::class, 'generate'])->name('generate');
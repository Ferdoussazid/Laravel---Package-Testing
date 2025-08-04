<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Payment\BkashPaymentController;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => ['web']], function () {
    Route::post("bkash/pay",[BkashPaymentController::class,'pay'])->name('bkash.pay');
    Route::get("bkash/callback",[BkashPaymentController::class,'callback'])->name('bkash.callback');
});

<?php

use App\Http\Controllers\RazorpayController;
use Illuminate\Support\Facades\Route;


Route::get("/", [RazorpayController::class, 'index']);
Route::post("/razorpay/payment", [RazorpayController::class, 'payment'])->name('razorpay.payment');
Route::get("/razorpay/callback", [RazorpayController::class, 'callback'])->name('razorpay.callback');







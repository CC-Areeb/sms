<?php

use App\Http\Controllers\SMS\SmsController;
use Illuminate\Support\Facades\Route;

Route::prefix('sms')->group(function () {
    Route::get('/', [SmsController::class, 'index'])->name('index');
    Route::post('/send', [SmsController::class, 'sendSMS'])->name('send');
});
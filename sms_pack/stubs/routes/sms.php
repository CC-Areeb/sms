<?php

use App\Http\Controllers\Emails\SMSController;
use Illuminate\Support\Facades\Route;

Route::prefix('sms')->group(function () {
    Route::get('/', [SMSController::class, 'index'])->name('index');
    Route::post('/send', [SMSController::class, 'sendEmail'])->name('sendEmail');
});
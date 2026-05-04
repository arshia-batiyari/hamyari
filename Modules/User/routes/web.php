<?php

use Illuminate\Support\Facades\Route;
use Modules\User\App\Http\Controllers\Front\DepositController;

Route::prefix('/front')->name('front.')->group(function() {
    Route::post('deposits/store', [DepositController::class,'store'])->name('deposits.store');
});
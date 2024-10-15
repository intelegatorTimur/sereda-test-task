<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubscriptionController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/subscription', [SubscriptionController::class, 'show'])->name('subscription.show');
Route::put('/subscription', [SubscriptionController::class, 'update'])->name('subscription.update');

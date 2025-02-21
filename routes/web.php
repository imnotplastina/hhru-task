<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;

Route::resource('products', ProductController::class);
Route::resource('orders', OrderController::class);

Route::post('/orders/{order}/complete', [OrderController::class, 'complete'])
    ->name('orders.complete');

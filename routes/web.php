<?php

use App\Http\Controllers\CatalogController;
use App\Http\Controllers\DeliveryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;



Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/catalog', [CatalogController::class, 'index'])->name('catalog');

Route::get('/products/{product:slug}', [ProductController::class, 'show'])->name('products.show');

Route::get('/delivery', [DeliveryController::class, 'index'])->name('delivery.prices');

Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');

Route::get('/orders/create', [OrderController::class, 'create']);

Route::post('/order', [OrderController::class, 'store'])->name('orders.store');

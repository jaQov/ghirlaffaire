<?php

use App\Http\Controllers\CatalogController;
use App\Http\Controllers\DeliveryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;



Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/catalog', [CatalogController::class, 'index'])->name('catalog');

Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.details');

Route::get('/delivery', [DeliveryController::class, 'index'])->name('delivery.prices');



<?php

use App\Http\Controllers\CatalogController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DeliveryController;

// Route::get('/', function () {
//     return view('home');
// });

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/catalog', [ProductController::class, 'catalog'])->name('catalog');

Route::get('/products/{slug}', [ProductController::class, 'show'])->name('products.show');

Route::get('/delivery', [DeliveryController::class, 'index'])->name('delivery.index');

Route::get('/catalog', [CatalogController::class, 'index'])->name('catalog');

Route::view('/contact', 'pages.contact')->name('contact');

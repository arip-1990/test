<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::redirect('/', '/products');

Route::resource('products', ProductController::class);
Route::prefix('orders')->group(function () {
    Route::resource('/', OrderController::class)->except(['edit', 'update', 'destroy']);
    Route::post('/{order}/complete', [OrderController::class, 'complete'])->name('orders.complete');
});

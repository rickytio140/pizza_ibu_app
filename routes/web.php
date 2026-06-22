<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/meja/{kode_qr}', [\App\Http\Controllers\CustomerController::class, 'scanQr'])->name('customer.scan');
Route::get('/katalog', [\App\Http\Controllers\CustomerController::class, 'catalog'])->name('customer.catalog');
Route::get('/cart', [\App\Http\Controllers\CustomerController::class, 'viewCart'])->name('customer.cart');
Route::post('/cart/add', [\App\Http\Controllers\CustomerController::class, 'addToCart'])->name('customer.cart.add');
Route::post('/cart/update', [\App\Http\Controllers\CustomerController::class, 'updateCart'])->name('customer.cart.update');
Route::post('/checkout', [\App\Http\Controllers\CustomerController::class, 'checkout'])->name('customer.checkout');
Route::get('/status/{order_id}', [\App\Http\Controllers\CustomerController::class, 'orderStatus'])->name('customer.status');

Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('tables', \App\Http\Controllers\Admin\TableController::class);
    Route::resource('menu-categories', \App\Http\Controllers\Admin\MenuCategoryController::class);
    Route::resource('menus', \App\Http\Controllers\Admin\MenuController::class);
    Route::get('reports', [\App\Http\Controllers\Admin\ReportController::class, 'index'])->name('reports.index');
});

Route::middleware(['auth'])->prefix('kasir')->name('kasir.')->group(function () {
    Route::get('/orders', [\App\Http\Controllers\CashierController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [\App\Http\Controllers\CashierController::class, 'show'])->name('orders.show');
    Route::post('/orders/{order}/pay', [\App\Http\Controllers\CashierController::class, 'processPayment'])->name('orders.pay');
    Route::post('/orders/{order}/complete', [\App\Http\Controllers\CashierController::class, 'completeOrder'])->name('orders.complete');
});

require __DIR__.'/auth.php';

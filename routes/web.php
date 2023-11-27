<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CheckPostageController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\NotificationHandlerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShippingAddressController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');

Route::get('cities/{province}', [LocationController::class, 'city'])->name('location.city');
Route::get('sub-district/{city}', [LocationController::class, 'subdistrict'])->name('location.subdistrict');

// Route::put('transactions/{transaction}/update', [TransactionController::class, 'update'])->name('transactions.update');
// Route::get('transactions/list', [TransactionController::class, 'index'])->name('transactions.index');
// Route::get('transactions/{transaction}', [TransactionController::class, 'show'])->name('transactions.show');

Route::middleware('auth')->group(function () {
    Route::get('checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('checkout', [CheckoutController::class, 'create'])->name('checkout.create');
    Route::post('checkout/process', [CheckoutController::class, 'store'])->name('checkout.store');
});

Route::post('check-postage', CheckPostageController::class)->name('check-postage');

// Route::get('invoices/{transaction}', [InvoiceController::class, 'download'])->name('invoices.download');

Route::resource('carts', CartController::class)
    ->except(['edit', 'create', 'show'])
    ->middleware('auth');

Route::resource('categories', CategoryController::class)
    ->scoped(['category' => 'slug']);

Route::get('products/list', [ProductController::class, 'list'])->name('products.list');
Route::resource('products', ProductController::class)
    ->scoped(['product' => 'slug']);

Route::resource('shipping-addresses', ShippingAddressController::class)
    ->except('show')
    ->middleware('auth');

Route::get('dashboard', DashboardController::class)->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route::post('api/notification/handling', [NotificationHandlerController::class, 'handling']);

require __DIR__ . '/auth.php';

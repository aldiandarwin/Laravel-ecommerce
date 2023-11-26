<?php
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ShippingAddressController;

Route::get('/', HomeController::class)->name('home');

Route::get('dashboard', DashboardController::class)->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('categories', CategoryController::class)
    ->scoped(['category' => 'slug']);

Route::resource('products', ProductController::class)
    ->scoped(['product' => 'slug']);

Route::resource('carts', CartController::class)
    ->except(['edit', 'create', 'show'])
    ->middleware('auth');

    Route::resource('shipping-addresses', ShippingAddressController::class)
    ->except('show')
    ->middleware('auth');

Route::get('cities/{province}', [LocationController::class, 'city'])->name('location.city');

Route::get('sub-district/{city}', [LocationController::class, 'subdistrict'])->name('location.subdistrict');

require __DIR__ . '/auth.php';
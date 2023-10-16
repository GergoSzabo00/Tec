<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers;
use App\Http\Controllers\Controller;

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

Route::get('/', [Controllers\HomeController::class, 'index'])->name('home');
Route::post('products/search', [Controllers\HomeController::class, 'searchProduct'])->name('search.product');
Route::get('products/{product}', [Controllers\HomeController::class, 'show'])->name('user.product.detail');

Route::get('services', [Controllers\ServicesController::class, 'index'])->name('services');

Route::get('contact', [Controllers\ContactController::class, 'index'])->name('contact');

Route::get('lang/{locale}', [Controllers\LocalizationController::class, 'setLocale'])->name('set.locale');

// Cart controllers
Route::get('cart', [Controllers\CartController::class, 'index'])->name('cart');
Route::get('get-cart-info', [Controllers\CartController::class, 'getCartInfo'])->name('get.cart.info');
Route::post('add-to-cart', [Controllers\CartController::class, 'addToCart'])->name('add.to.cart');
Route::post('update-cart-quantity', [Controllers\CartController::class, 'updateCartQuantity'])->name('update.cart.quantity');
Route::post('remove-from-cart', [Controllers\CartController::class, 'removeFromCart'])->name('remove.from.cart');
Route::post('remove-all-from-cart', [Controllers\CartController::class, 'removeAllFromCart'])->name('remove.all.from.cart');

// Checkout controllers
Route::get('checkout',  [Controllers\CheckoutController::class, 'index'])->name('checkout');
Route::post('checkout',  [Controllers\CheckoutController::class, 'store']);

Route::middleware('admin')->group(function () 
{
    Route::get('admin', [Controllers\Admin\AdminController::class, 'index'])->name('admin');
    Route::get('monthly-sales', [Controllers\Admin\AdminController::class, 'getMonthlySales'])->name('get.monthly.sales');

    // Order controllers
    Route::get('admin/orders', [Controllers\Admin\OrderController::class, 'index'])->name('orders');
    Route::get('admin/orders/{order}', [Controllers\Admin\OrderController::class, 'show'])->name('order.details');
    Route::get('admin/orders/{order}/edit', [Controllers\Admin\OrderController::class, 'edit'])->name('order.edit');
    Route::post('admin/orders/{order}/edit', [Controllers\Admin\OrderController::class, 'update']);
    Route::post('admin/orders/delete', [Controllers\Admin\OrderController::class, 'destroy'])->name('order.delete');

    // Manufacturer controllers
    Route::get('admin/manufacturers', [Controllers\Admin\ManufacturerController::class, 'index'])->name('manufacturers');
    Route::get('admin/manufacturers/create', [Controllers\Admin\ManufacturerController::class, 'create'])->name('manufacturer.create');
    Route::post('admin/manufacturers/create', [Controllers\Admin\ManufacturerController::class, 'store']);
    Route::get('admin/manufacturers/{manufacturer}/edit', [Controllers\Admin\ManufacturerController::class, 'edit'])->name('manufacturer.edit');
    Route::post('admin/manufacturers/{manufacturer}/edit', [Controllers\Admin\ManufacturerController::class, 'update']);
    Route::post('admin/manufacturers/delete', [Controllers\Admin\ManufacturerController::class, 'destroy'])->name('manufacturer.delete');

    // Category controllers
    Route::get('admin/categories', [Controllers\Admin\CategoryController::class, 'index'])->name('categories');
    Route::get('admin/categories/create', [Controllers\Admin\CategoryController::class, 'create'])->name('category.create');
    Route::post('admin/categories/create', [Controllers\Admin\CategoryController::class, 'store']);
    Route::get('admin/categories/{category}/edit', [Controllers\Admin\CategoryController::class, 'edit'])->name('category.edit');
    Route::post('admin/categories/{category}/edit', [Controllers\Admin\CategoryController::class, 'update']);
    Route::post('admin/categories/delete', [Controllers\Admin\CategoryController::class, 'destroy'])->name('category.delete');

    // Product controllers
    Route::get('admin/products', [Controllers\Admin\ProductController::class, 'index'])->name('products');
    Route::get('admin/products/create', [Controllers\Admin\ProductController::class, 'create'])->name('product.create');
    Route::post('admin/products/create', [Controllers\Admin\ProductController::class, 'store']);
    Route::get('admin/products/{product}', [Controllers\Admin\ProductController::class, 'show'])->name('product.details');
    Route::get('admin/products/{product}/edit', [Controllers\Admin\ProductController::class, 'edit'])->name('product.edit');
    Route::post('admin/products/{product}/edit', [Controllers\Admin\ProductController::class, 'update']);
    Route::post('admin/products/delete', [Controllers\Admin\ProductController::class, 'destroy'])->name('product.delete');

    // Coupon controllers
    Route::get('admin/coupons', [Controllers\Admin\CouponController::class, 'index'])->name('coupons');
    Route::get('admin/coupons/create', [Controllers\Admin\CouponController::class, 'create'])->name('coupon.create');
    Route::post('admin/coupons/create', [Controllers\Admin\CouponController::class, 'store']);
    Route::get('admin/coupons/{coupon}/edit', [Controllers\Admin\CouponController::class, 'edit'])->name('coupon.edit');
    Route::post('admin/coupons/{coupon}/edit', [Controllers\Admin\CouponController::class, 'update']);
    Route::post('admin/coupons/delete', [Controllers\Admin\CouponController::class, 'destroy'])->name('coupon.delete');

    // Users controllers
    Route::get('admin/users', [Controllers\Admin\UserController::class, 'index'])->name('users');
    Route::get('admin/users/{user}/edit', [Controllers\Admin\UserController::class, 'edit'])->name('user.edit');
    Route::post('admin/users/{user}/edit', [Controllers\Admin\UserController::class, 'update']);
    Route::post('admin/users/delete', [Controllers\Admin\CategoryController::class, 'destroy'])->name('user.delete');

    // Store settings controllers
    Route::get('admin/storesettings/edit', [Controllers\Admin\StoreSettingsController::class, 'edit'])->name('storesettings.edit');
    Route::post('admin/storesettings/edit', [Controllers\Admin\StoreSettingsController::class, 'update']);
});

require __DIR__ . '/auth.php';
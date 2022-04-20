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

Route::middleware('admin')->group(function () 
{
    Route::get('admin', [Controllers\Admin\AdminController::class, 'index'])->name('admin');

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
    Route::get('admin/products/create', [Controllers\Admin\ProductController::class, 'create'])->name('product.create');
    Route::post('admin/products/create', [Controllers\Admin\ProductController::class, 'store']);
    Route::get('admin/products/{product}', [Controllers\Admin\ProductController::class, 'show'])->name('product.details');


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
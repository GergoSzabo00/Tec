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
    Route::get('admin/products/create', [Controllers\Admin\ProductController::class, 'create'])->name('product.create');
    Route::post('admin/products/create', [Controllers\Admin\ProductController::class, 'store']);
    Route::get('admin/products/{product}', [Controllers\Admin\ProductController::class, 'show'])->name('product.details');
});

require __DIR__ . '/auth.php';
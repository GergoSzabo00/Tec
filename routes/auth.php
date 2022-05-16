<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\AddressesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OrderHistoryController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
                ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
                ->name('password.update');

    Route::get('verify-email', [EmailVerificationPromptController::class, '__invoke'])
                ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('verification.send');
});

Route::middleware('auth')->group(function () {

    Route::get('profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('profile/update-personal-info', [ProfileController::class, 'updatePersonalInfo'])->name('update.personal.info');
    Route::post('profile/change-password', [ProfileController::class, 'changePassword'])->name('change.password');

    Route::get('addresses', [AddressesController::class, 'index'])->name('addresses');
    Route::get('addresses/create', [AddressesController::class, 'create'])->name('address.create');
    Route::post('addresses/create', [AddressesController::class, 'store']);
    Route::get('addresses/{address}/edit', [AddressesController::class, 'edit'])->name('address.edit');
    Route::post('addresses/{address}/edit', [AddressesController::class, 'update']);
    Route::post('addresses/delete', [AddressesController::class, 'destroy'])->name('address.delete');

    Route::get('orders', [OrderHistoryController::class, 'index'])->name('recent.orders');


    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');
});
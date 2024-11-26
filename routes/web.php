<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Gateways\PaypalController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Models\User;
use Illuminate\Support\Facades\Auth;


Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'countClients'])->name('dashboard');

});


Route::get('/paymentPlane', [PaypalController::class, 'planes'])->name('planes.general');

Route::get('/dashboard/chart-data', [DashboardController::class, 'chartData'])->middleware('api');

/**
 * google authantication
 */
Route::get('/auth/redirect', [AuthenticatedSessionController::class, 'googleAuthRedirect'])->name('google.login');
 
Route::get('/auth/callback', [AuthenticatedSessionController::class, 'googleAuthCallback']);

/**
 * email verification and resend routes
 */
Route::middleware('auth')->group(function () {
    Route::get('/email/verify', [AuthenticatedSessionController::class, 'verifyNotice'])->name('verification.noticed');

    Route::get('/email/verify/{id}/{hash}', [AuthenticatedSessionController::class, 'verifyEmail'])->middleware('signed')->name('verification.verified');

    Route::post('/email/verification-notification', [AuthenticatedSessionController::class, 'verifyHandler'])->middleware( 'throttle:6,1')->name('verification.send');
});


/**
 * profile route administration 
 */
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


/**
 * clients route administration
 */
Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/client', [ClientController::class, 'list'])->name('client.list');
    Route::get('/client/urgent', [DashboardController::class, 'urgentFilter'])->name('client.urgent');
    Route::get('/client/important', [DashboardController::class, 'importantFilter'])->name('client.important');
    Route::get('/client/done', [DashboardController::class, 'doneFilter'])->name('client.done');

    Route::get('/client/store', [ClientController::class, 'store'])->name('client.store');
    Route::get('/client/create', [ClientController::class, 'create'])->name('client.create');
    Route::get('/client/trashed', [ClientController::class, 'trashed'])->name('client.trashed');

    Route::get('/client/note/{id}', [ClientController::class, 'showNote'])->name('client.note');    
    Route::get('/client/{id}/show', [ClientController::class, 'show'])->name('client.show');
    Route::get('/client/{id}/edit', [ClientController::class, 'edit'])->name('client.edit');
    Route::get('/client/{id}/update', [ClientController::class, 'update'])->name('client.update');
    Route::get('/client/{id}/destroy', [ClientController::class, 'destroy'])->name('client.destroy');
    Route::get('/client/{id}/restore', [ClientController::class, 'restore'])->name('client.restore');
    Route::get('/client/{id}/force_delete', [ClientController::class, 'forceDelete'])->name('client.force_delete');
    Route::get('/client/{id}/status/{status}', [ClientController::class, 'updateStatus'])->name('client.updateStatus');

    Route::get('/client/search', [ClientController::class, 'search'])->name('client.search');


});


//payments route

Route::post('/paypal/payment', [PaypalController::class, 'payment'])->name('paypal.payment');
Route::get('/paypal/success', [PaypalController::class, 'success'])->name('paypal.success');
Route::get('/paypal/cancel', [PaypalController::class, 'cancel'])->name('paypal.cancel');

require __DIR__ . '/auth.php';

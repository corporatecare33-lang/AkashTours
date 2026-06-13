<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TourController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminContentController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::get('/admin', [AuthController::class, 'showAdminLogin'])->name('admin.login');
Route::post('/admin', [AuthController::class, 'adminLogin'])->name('admin.login.submit');

Route::get('/tours/{id}', [TourController::class, 'show'])->name('tours.show');

Route::middleware(['auth'])->group(function () {
    Route::get('/booking/create/{tour}', [BookingController::class, 'create'])->name('bookings.create');
    Route::post('/booking/store', [BookingController::class, 'store'])->name('bookings.store');
    Route::get('/booking/confirmation/{booking}', [BookingController::class, 'confirmation'])->name('bookings.confirmation');
    
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/dashboard/profile', [DashboardController::class, 'profileUpdate'])->name('dashboard.profile.update');
    Route::post('/dashboard/password', [DashboardController::class, 'passwordUpdate'])->name('dashboard.password.update');
    Route::post('/admin/content/hero', [AdminContentController::class, 'updateHero'])->name('admin.content.hero');
    Route::post('/admin/content/sections', [AdminContentController::class, 'updateSections'])->name('admin.content.sections');
    Route::post('/admin/content/tours/{tour}', [AdminContentController::class, 'updateTour'])->name('admin.content.tours.update');
    Route::post('/admin/content/destinations', [AdminContentController::class, 'storeDestination'])->name('admin.content.destinations.store');
    Route::post('/admin/content/destinations/{destination}', [AdminContentController::class, 'updateDestination'])->name('admin.content.destinations.update');
    Route::delete('/admin/content/destinations/{destination}', [AdminContentController::class, 'deleteDestination'])->name('admin.content.destinations.delete');
    Route::post('/admin/content/payments', [AdminContentController::class, 'storePayment'])->name('admin.content.payments.store');
    Route::post('/admin/content/payments/{paymentMethod}', [AdminContentController::class, 'updatePayment'])->name('admin.content.payments.update');
    Route::delete('/admin/content/payments/{paymentMethod}', [AdminContentController::class, 'deletePayment'])->name('admin.content.payments.delete');
});

require __DIR__.'/auth.php';

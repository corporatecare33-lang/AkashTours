<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TourController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;

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
});

require __DIR__.'/auth.php';

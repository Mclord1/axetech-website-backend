<?php

use App\Constants\RouteConstants;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\Auth\AdminPasswordResetController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\TestimonialController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
| Current API Structure:
| /api/auth/* - Authentication endpoints
| /api/projects/* - Project endpoints (protected)
| /api/services/* - Service endpoints (protected)
| /api/admins/* - Admin management endpoints (protected)
| /api/settings/* - Settings management endpoints (protected)
| /api/testimonials/* - Testimonial management endpoints (protected)
|
*/

// Public Routes
Route::post('/auth/login', [AdminAuthController::class, 'login'])->name('auth.login');
Route::post('/auth/forgot-password', [AdminPasswordResetController::class, 'sendResetLinkEmail'])->name('auth.password.email');
Route::post('/auth/reset-password', [AdminPasswordResetController::class, 'reset'])->name('auth.password.reset');

// Protected Routes
Route::middleware(['auth:sanctum'])->group(function () {
    // Auth Module
    Route::prefix('auth')->group(function () {
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('auth.logout');
        Route::get('/profile', [AdminAuthController::class, 'profile'])->name('auth.profile');
        Route::put('/profile', [AdminAuthController::class, 'updateProfile'])->name('auth.profile.update');
    });

    // Projects Module
    Route::controller(ProjectController::class)
        ->prefix('projects')
        ->group(function () {
            Route::get('/', 'index')->name('projects.index');
            Route::post('/', 'store')->name('projects.store');
            Route::get(RouteConstants::PROJECT_PARAM, 'show')->name('projects.show');
            Route::put(RouteConstants::PROJECT_PARAM, 'update')->name('projects.update');
            Route::delete(RouteConstants::PROJECT_PARAM, 'destroy')->name('projects.destroy');
        });

    // Services Module
    Route::controller(ServiceController::class)
        ->prefix('services')
        ->group(function () {
            Route::get('/', 'index')->name('services.index');
            Route::post('/', 'store')->name('services.store');
            Route::get('/{service}', 'show')->name('services.show');
            Route::put('/{service}', 'update')->name('services.update');
            Route::delete('/{service}', 'destroy')->name('services.destroy');
            Route::put('/order/update', 'updateOrder')->name('services.order.update');
        });

    // Products Module
    Route::controller(ProductController::class)
        ->prefix('products')
        ->group(function () {
            Route::get('/', 'index')->name('products.index');
            Route::post('/', 'store')->name('products.store');
            Route::get('/{product}', 'show')->name('products.show');
            Route::put('/{product}', 'update')->name('products.update');
            Route::delete('/{product}', 'destroy')->name('products.destroy');
            Route::put('/order/update', 'updateOrder')->name('products.order.update');
        });

    // Settings Module
    Route::controller(SettingController::class)
        ->prefix('settings')
        ->group(function () {
            Route::get('/', 'index')->name('settings.index');
            Route::post('/', 'store')->name('settings.store');
            Route::get('/{setting}', 'show')->name('settings.show');
            Route::put('/{setting}', 'update')->name('settings.update');
            Route::delete('/{setting}', 'destroy')->name('settings.destroy');
            Route::get('/group/{group}', 'getByGroup')->name('settings.group');
            Route::get('/public/all', 'getPublic')->name('settings.public');
            Route::put('/bulk/update', 'bulkUpdate')->name('settings.bulk.update');
        });

    // Testimonials Module
    Route::controller(TestimonialController::class)
        ->prefix('testimonials')
        ->group(function () {
            Route::get('/', 'index')->name('testimonials.index');
            Route::post('/', 'store')->name('testimonials.store');
            Route::get('/{testimonial}', 'show')->name('testimonials.show');
            Route::put('/{testimonial}', 'update')->name('testimonials.update');
            Route::delete('/{testimonial}', 'destroy')->name('testimonials.destroy');
            Route::put('/order/update', 'updateOrder')->name('testimonials.order.update');
        });

    // Admins Module
    Route::apiResource('admins', AdminController::class);
});
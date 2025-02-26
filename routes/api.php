<?php

use App\Constants\RouteConstants;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\Auth\AdminPasswordResetController;

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
| /api/admins/* - Admin management endpoints (protected)
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

    // Admins Module
    Route::apiResource('admins', AdminController::class);
});
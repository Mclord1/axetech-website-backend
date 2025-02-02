<?php

use App\Constants\RouteConstants;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;

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
| /api/v1/projects - Project endpoints
|
*/


Route::middleware('api')->group(function () {
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
});
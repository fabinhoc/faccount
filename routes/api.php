<?php

use App\Http\Controllers\AuthenticationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => '/auth'], function () {
    Route::middleware('auth:sanctum')
        ->get('/email/verify/{id}/{hash}', [AuthenticationController::class, 'verify'])
        ->name('verification.verify');
    Route::middleware(['auth:sanctum', 'throttle:6,1'])
        ->post('/email/verification-notification', [AuthenticationController::class, 'verification'])
        ->name('verification.send');
    Route::post('/register', [AuthenticationController::class, 'register']);
    Route::post('/login', [AuthenticationController::class, 'login']);
    Route::post('/forgot-password', [AuthenticationController::class, 'forgot']);
    Route::middleware('guest')
        ->post('/reset-password', [AuthenticationController::class, 'reset'])
        ->name('password.reset');
    Route::middleware(['auth:sanctum'])->post('/logout', [AuthenticationController::class, 'logout']);
});

<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\NotebookController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
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

Route::group(['prefix' => '/user'], function () {
    Route::get('/{id}', [UserController::class, 'show']);
    Route::put('/{id}', [UserController::class, 'update']);
    Route::delete('/{id}', [UserController::class, 'destroy']);
    Route::put('/{id}/change-password', [UserController::class, 'changePassword']);
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

Route::group(['prefix' => '/notebook', 'middleware' => 'auth:sanctum', 'verified'], function () {
    Route::post('/', [NotebookController::class, 'store']);
    Route::put('/{id}', [NotebookController::class, 'update']);
    Route::get('/get/all', [NotebookController::class, 'all']);
    Route::get('/', [NotebookController::class, 'paginate']);
    Route::get('/{id}', [NotebookController::class, 'show']);
    Route::delete('/{id}', [NotebookController::class, 'destroy']);
});

Route::group(['prefix' => '/tag', 'middleware' => 'auth:sanctum', 'verified'], function () {
    Route::post('/', [TagController::class, 'store']);
    Route::put('/{id}', [TagController::class, 'update']);
    Route::get('/get/all', [TagController::class, 'all']);
    Route::get('/', [TagController::class, 'paginate']);
    Route::get('/{id}', [TagController::class, 'show']);
    Route::delete('/{id}', [TagController::class, 'destroy']);
});

Route::group(['prefix' => '/bill', 'middleware' => 'auth:sanctum', 'verified'], function () {
    Route::post('/', [BillController::class, 'store']);
    Route::put('/{id}', [BillController::class, 'update']);
    Route::get('/get/all', [BillController::class, 'all']);
    Route::get('/', [BillController::class, 'paginate']);
    Route::get('/{id}', [BillController::class, 'show']);
    Route::delete('/{id}', [BillController::class, 'destroy']);
    Route::get('/{notebookId}/{year}/{month}', [BillController::class, 'findByNotebookIdAndYearAndMonth']);
    Route::post('/duplicate', [BillController::class, 'duplicateBills']);
    Route::delete('/delete/{notebookId}/{year}/{month}', [BillController::class, 'destroyMany']);
});

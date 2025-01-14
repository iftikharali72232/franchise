<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\EmailController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BranchController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
// public routes

Route::post('/register', [AuthController::class, 'register']); // Create a new user
Route::post('/login', [AuthController::class, 'login']);
Route::post('/verify-otp', [AuthController::class, 'verifyOTP']);
Route::post('/resend-otp', [AuthController::class, 'resendOTP']);
Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
Route::post('/reset-password', [AuthController::class, 'resetPassword']);


Route::post('/send-email', [EmailController::class, 'sendOTP']);

// protected routes
Route::group(["middleware"=> "auth:sanctum"], function () {
    // Requests

// routes/api.php


Route::prefix('branches')->group(function () {
    Route::get('/', [BranchController::class, 'index']); // List all branches
    Route::get('/{id}', [BranchController::class, 'show']); // List all branches
    Route::post('/', [BranchController::class, 'store']); // Add a branch
    Route::put('/{id}', [BranchController::class, 'update']); // Update a branch
    Route::delete('/{id}', [BranchController::class, 'destroy']); // Delete a branch
});

});

<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\EmailController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BranchController;
use App\Http\Controllers\Api\ReportController;
use App\Http\Controllers\Api\RequestController;

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


    Route::post('/user/notification_status', [AuthController::class, 'notification_status']);

    Route::post('/reports', [ReportController::class, 'storeReport']);
    Route::post('/reports/result', [ReportController::class, 'storeReportResult']);
    Route::post('/reports/exit', [ReportController::class, 'exitReport']);
    Route::get('/reports/list', [ReportController::class, 'reportList']);
    Route::post('/reports/get', [ReportController::class, 'reportDetail']);
    Route::get('/reports/previousReportslist', [ReportController::class, 'previousReportApi']);

    Route::post('/user/update', [AuthController::class, 'updateUser']);
    Route::get("/user/logout", [AuthController::class,"logout"])->name('logout');
    Route::get('/user/delete', [AuthController::class, 'delete'])->name('deleteUser');

    Route::prefix('branches')->group(function () {
        Route::get('/', [BranchController::class, 'index']); // List all branches
        Route::get('/{id}', [BranchController::class, 'show']); // List all branches
        Route::post('/', [BranchController::class, 'store']); // Add a branch
        Route::put('/{id}', [BranchController::class, 'update']); // Update a branch
        Route::delete('/{id}', [BranchController::class, 'destroy']); // Delete a branch

        Route::post('/getCodeApproval', [RequestController::class, 'getCodeApproval']);
    });
    Route::get('/cityList', [RequestController::class, 'cityList']);
    Route::get('/notifications', [RequestController::class, 'notifications']);
    Route::post('/notifications/read', [RequestController::class, 'readNotification']);

});

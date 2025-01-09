<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// protected routes
Route::group(["middleware"=> "auth:sanctum"], function () {
    // Requests


});

<?php

use App\Http\Controllers\Api\Auth\EmailVerificationController;
use App\Http\Controllers\Api\Auth\ForgotPasswordController;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\LogoutController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Auth\ResetPasswordController;
use App\Http\Controllers\Api\CompanyController;
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
Route::post('/register',[RegisterController::class, 'register']);
Route::post('/login',[LoginController::class, 'login']);
Route::middleware('auth:sanctum', 'verified')->group( function () {
    Route::post('/logout',[LogoutController::class, 'logout']);
    Route::post('/send-otp', [EmailVerificationController::class, 'sendOtp']);
    Route::post('/verify-otp',[EmailVerificationController::class, 'verifyOtp']);

    Route::get('/companies',[CompanyController::class,'index']);
    Route::get('/companies',[CompanyController::class,'store']);
});
Route::post('password/forgot', [ForgotPasswordController::class, 'sendResetOTP']);
Route::post('password/reset', [ResetPasswordController::class, 'reset']);
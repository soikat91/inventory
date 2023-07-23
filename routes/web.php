<?php

use App\Http\Controllers\UserController;
use App\Http\Middleware\TokenVerificationMiddleware;
use Illuminate\Support\Facades\Route;


Route::post('/user-registration',[UserController::class,'userRegistration']);
Route::post('/UserLogin',[UserController::class,'userLogin']);
Route::post('/sendOtpToEmail',[UserController::class,'sendOtpToEmail']);
Route::post('/otpVerify',[UserController::class,'otpVerify']);
Route::post('/setPassword',[UserController::class,'setPassword'])->middleware([TokenVerificationMiddleware::class]);

// profile route details
Route::get('/user-profile-details',[UserController::class,'getUser'])->middleware([TokenVerificationMiddleware::class]);
//profile update
Route::post('/profile-update',[UserController::class,'profileUpdate'])->middleware([TokenVerificationMiddleware::class]);

// pages
Route::get('/registration',[UserController::class,'registration']);
Route::get('/login',[UserController::class,'login']);
Route::get('/sendOtp',[UserController::class,'sendOtp']);
Route::get('/verifyOtp',[UserController::class,'verifyOtp']);
Route::get('/resetPassword',[UserController::class,'resetPassword'])->middleware([TokenVerificationMiddleware::class]);
// after authtication 
Route::get('/dashboard',[UserController::class,'dashboard'])->middleware([TokenVerificationMiddleware::class]);
Route::get('/profile',[UserController::class,'profile'])->middleware([TokenVerificationMiddleware::class]);


// logout route

Route::get('/logout',[UserController::class,'userLogOut']);
// html 5 back history 
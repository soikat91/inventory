<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CatrgoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashBoardController;
use App\Http\Controllers\ProductController;
use App\Http\Middleware\TokenVerificationMiddleware;


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



// Category Pages
Route::get('/category',[CatrgoryController::class,'category'])->middleware([TokenVerificationMiddleware::class]);
Route::get('/customer',[CustomerController::class,'customer'])->middleware([TokenVerificationMiddleware::class]);
Route::get('/product',[ProductController::class,'product'])->middleware([TokenVerificationMiddleware::class]);








// logout route

Route::get('/logout',[UserController::class,'userLogOut']);
// html 5 back history 


// customer route api
Route::get('/getCustomer',[CustomerController::class,'getCustomer'])->middleware([TokenVerificationMiddleware::class]);
Route::post('/create-customer',[CustomerController::class,'createCustomer'])->middleware([TokenVerificationMiddleware::class]);
Route::post('/update-customer',[CustomerController::class,'updateCustomer'])->middleware([TokenVerificationMiddleware::class]);
Route::post('/delete-customer',[CustomerController::class,'deleteCustomer'])->middleware([TokenVerificationMiddleware::class]);

Route::post('/customer-by-id',[CustomerController::class,'customerById'])->middleware([TokenVerificationMiddleware::class]);



// category route api
Route::get('/list-category',[CatrgoryController::class,'listCategory'])->middleware([TokenVerificationMiddleware::class]);
Route::post('/create-category',[CatrgoryController::class,'createCategory'])->middleware([TokenVerificationMiddleware::class]);
Route::post('/update-category',[CatrgoryController::class,'updateCategory'])->middleware([TokenVerificationMiddleware::class]);
Route::post('/delete-category',[CatrgoryController::class,'deleteCategory'])->middleware([TokenVerificationMiddleware::class]);
Route::post('/get-category-id',[CatrgoryController::class,'getCategoryId'])->middleware([TokenVerificationMiddleware::class]);

// product route api

Route::get('/product-list',[ProductController::class,'getProduct'])->middleware([TokenVerificationMiddleware::class]);
Route::post('/product-create',[ProductController::class,'createProduct'])->middleware([TokenVerificationMiddleware::class]);
Route::post('/product-update',[ProductController::class,'updateProduct'])->middleware([TokenVerificationMiddleware::class]);
Route::post('/product-delete',[ProductController::class,'deleteProduct'])->middleware([TokenVerificationMiddleware::class]);
Route::post('/product-by-id',[ProductController::class,'productById'])->middleware([TokenVerificationMiddleware::class]);


// dashboard Route Api

Route::get('/total-customer',[DashBoardController::class,'totalCustomer'])->middleware([TokenVerificationMiddleware::class]);
Route::get('/total-category',[DashBoardController::class,'totalCategory'])->middleware([TokenVerificationMiddleware::class]);
Route::get('/total-product',[DashBoardController::class,'totalProduct'])->middleware([TokenVerificationMiddleware::class]);

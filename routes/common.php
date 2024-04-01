<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Common\AuthController;
use App\Http\Controllers\Common\ProfileController;
use App\Http\Controllers\Common\VarificationController;



//Auth
Route::post('user/login', [AuthController::class, 'Login']);
Route::post('user/registration', [AuthController::class, 'Registration']);


Route::post('user/send-otp', [VarificationController::class, 'SendOtp']);
Route::post('user/verify-otp', [VarificationController::class, 'VerifyOtp']);

Route::post('/user/find', [ProfileController::class, 'FindProfile']);


Route::post('user/reset-password', [AuthController::class, 'ResetPassword']);





Route::group(['middleware' => 'checkUser'], function () {
    //password
    Route::post('update/password', [AuthController::class, 'UpdatePassword']);


    Route::get('user', [ProfileController::class, 'GetProfile']);
    Route::get('get/user/details', [ProfileController::class, 'DetailsProfile']);
    Route::post('user/update', [ProfileController::class, 'UserUpdate']);






});


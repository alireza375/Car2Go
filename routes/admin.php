<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;




Route::group(['middleware' => 'admin'], function () {

    Route::get('user/list', [UserController::class, 'index']);


});

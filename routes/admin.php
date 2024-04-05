<?php

use App\Http\Controllers\Admin\PageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;




Route::group(['middleware' => 'admin'], function () {

    Route::get('user/list', [UserController::class, 'index']);


    Route::get('page/list', [PageController::class, 'List']);
    Route::post('page', [PageController::class, 'Page']);
    Route::get('get/page', [PageController::class, 'GetPage']);
    Route::delete('delete/page', [PageController::class, 'Delete']);

});

<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\HeaderController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\DownloadController;
use App\Http\Controllers\Admin\FooterController;
use App\Http\Controllers\Admin\SolutionController;
use App\Http\Controllers\Admin\TestimonialController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// For Header
Route::get('header/list', [HeaderController:: class, 'index']);
Route::post('updateOrAdd/header', [HeaderController:: class, 'updateOrAddHeader']);
Route::delete('delete/header', [HeaderController:: class, 'delete']);


// For Solution
Route::get('solution/list', [SolutionController:: class, 'index']);
Route::post('updateOrAdd/solution', [SolutionController::class, 'updateOrAddSolution']);
Route::delete('delete/solution', [SolutionController::class, 'delete']);


// For Banner
Route::get('banner/list', [BannerController:: class, 'index']);
Route::post('updateOrAdd/banner', [BannerController::class, 'updateOrAddBanner']);
Route::delete('delete/banner', [BannerController::class, 'delete']);


// For About
Route::get('about/list', [AboutController:: class, 'index']);
Route::post('updateOrAdd/about', [AboutController::class, 'updateOrAddAbout']);
Route::delete('delete/about', [AboutController::class, 'delete']);


// For Contact
Route::get('contact/list', [ContactController:: class, 'index']);
Route::post('updateOrAdd/contact', [ContactController::class, 'updateOrAddContact']);
Route::delete('delete/contact', [ContactController::class, 'delete']);


// For Testimonial
Route::get('testimonial/list', [TestimonialController:: class, 'index']);
Route::post('updateOrAdd/testimonial', [TestimonialController::class, 'updateOrAddTestimonial']);
Route::delete('delete/testimonial', [TestimonialController::class, 'delete']);


// For Download
Route::get('download/list', [DownloadController:: class, 'index']);
Route::post('updateOrAdd/download', [DownloadController::class, 'updateOrAddDownload']);
Route::delete('delete/download', [DownloadController::class, 'delete']);


// For Footer
Route::get('footer/list', [FooterController:: class, 'index']);
Route::post('updateOrAdd/footer', [FooterController::class, 'updateOrAddFooter']);
Route::delete('/delete-footer', [FooterController::class, 'delete']);


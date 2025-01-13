<?php

use App\Http\Controllers\FaqController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TestimonyController;
use App\Http\Controllers\UserController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('cms/users', [UserController::class, 'index'])->name('users');
Route::delete('cms/users/delete-user', [UserController::class, 'delete'])->name('delete-user');

Route::get('services', [ServiceController::class, 'data'])->name('services');
Route::delete('cms/services/delete-service', [ServiceController::class, 'destroy'])->name('delete-service');

Route::get('faqs', [FaqController::class, 'show'])->name('faqs');
Route::delete('cms/faq/delete-faq', [FaqController::class, 'destroy'])->name('delete-faq');


Route::get('show-testimony', [TestimonyController::class, 'show'])->name('show-testimony');
Route::delete('/delete-testimony', [TestimonyController::class, 'destroy'])->name('delete-testimony');


Route::post('store-testimony', [TestimonyController::class, 'store'])->name('store-testimony');

Route::get('cms/show-media', [MediaController::class, 'show'])->name('show-media');
Route::delete('cms/delete-media', [MediaController::class, 'destroy'])->name('delete-media');
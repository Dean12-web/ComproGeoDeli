<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//CMS ROUTE
Route::prefix('cms')->name('cms.')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
    Route::post('/login', [LoginController::class, 'authenticate']);
    Route::post('/logout', [LoginController::class, 'logout']);

    Route::get('/profile', [UserController::class, 'edit'])->name('profile')->middleware('auth');
    Route::post('/profile/changepassword', [UserController::class, 'update'])->name('changepassword')->middleware('auth');

    Route::redirect('/', '/cms/login');

    Route::view('/dashboard', 'cms.home')->name('dashboard')->middleware('auth');
    Route::view('/users', 'cms.users.users')->name('users')->middleware('auth');
    Route::get('/users/add-user', [UserController::class, 'create'])->name('add-user')->middleware('auth');
    Route::post('/users/store-user', [UserController::class, 'store'])->name('store-user')->middleware('auth');
    Route::view('/blogs', 'cms.blogs.blogs')->name('blogs')->middleware('auth');
    Route::view('/contact', 'cms.contacts.contacts')->name('contact')->middleware('auth');
    Route::view('/services', 'cms.services.services')->name('services')->middleware('auth');
    Route::view('/info', 'cms.info.info')->name('info')->middleware('auth');
    Route::view('/media', 'cms.medias.medias')->name('media')->middleware('auth');
    Route::view('/faqs', 'cms.faqs.faqs')->name('faqs')->middleware('auth');
    Route::view('/testimony', 'cms.testimonies.testimonies')->name('testimony')->middleware('auth');
});
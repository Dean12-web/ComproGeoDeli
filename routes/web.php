<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ServiceController;
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
    Route::get('/services', [ServiceController::class, 'index'])->name('services')->middleware('auth');
    Route::get('/services/add-services', [ServiceController::class, 'create'])->name('add-services')->middleware('auth');
    Route::get('/services/edit-services/{id}', [ServiceController::class, 'edit'])->name('edit-services')->middleware('auth');
    Route::put('/services/update-services/{service}', [ServiceController::class, 'update'])->name('update-services')->middleware('auth');
    Route::post('/services/store-services', [ServiceController::class, 'store'])->name('store-services')->middleware('auth');

    Route::get('/info', [CompanyController::class, 'index'])->name('info')->middleware('auth');
    Route::get('/info/add-info', [CompanyController::class, 'create'])->name('add-info')->middleware('auth');
    Route::get('/info/edit-info/{id}', [CompanyController::class, 'edit'])->name('edit-info')->middleware('auth');
    Route::put('/info/update-info/{company}', [CompanyController::class, 'update'])->name('update-info')->middleware('auth');
    Route::get('/info/preview-info/{id}', [CompanyController::class, 'show'])->name('preview-info')->middleware('auth');
    Route::delete('/info/delete-info/{company}', [CompanyController::class, 'destroy'])->name('delete-info')->middleware('auth');
    Route::post('/info/store-info', [CompanyController::class, 'store'])->name('store-info')->middleware('auth');

    Route::view('/media', 'cms.medias.medias')->name('media')->middleware('auth');

    Route::get('/faqs', [FaqController::class, 'index'])->name('faqs')->middleware('auth');
    Route::get('/faqs/add-faqs', [FaqController::class, 'create'])->name('add-faqs')->middleware('auth');
    Route::post('/faqs/store-faqs', [FaqController::class, 'store'])->name('store-faqs')->middleware('auth');
    Route::get('/faqs/edit-faqs/{id}', [FaqController::class, 'edit'])->name('edit-faqs')->middleware('auth');
    Route::put('/faqs/update-faqs/{faq}', [FaqController::class, 'update'])->name('update-faqs')->middleware('auth');
    Route::view('/testimony', 'cms.testimonies.testimonies')->name('testimony')->middleware('auth');
});
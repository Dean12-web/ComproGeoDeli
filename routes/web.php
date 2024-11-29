<?php

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
    Route::view('/dashboard', 'cms.home')->name('dashboard');
    Route::view('/users', 'cms.users')->name('users');
    Route::view('/blogs', 'cms.blogs')->name('blogs');
    Route::view('/contact', 'cms.contacts')->name('contact');
    Route::view('/services', 'cms.services')->name('services');
    Route::view('/info', 'cms.info')->name('info');
    Route::view('/media', 'cms.medias')->name('media');
    Route::view('/faqs', 'cms.faqs')->name('faqs');
    Route::view('/testimony', 'cms.testimonies')->name('testimony');
});
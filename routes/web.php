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
    Route::redirect('/', '/cms/dashboard')->name('home');

    Route::view('/dashboard', 'cms.home')->name('dashboard');
    Route::view('/users', 'cms.users.users')->name('users');
    Route::view('/users/add-user', 'cms.users.add-user')->name('add-user');
    Route::view('/blogs', 'cms.blogs.blogs')->name('blogs');
    Route::view('/contact', 'cms.contacts.contacts')->name('contact');
    Route::view('/services', 'cms.services.services')->name('services');
    Route::view('/info', 'cms.info.info')->name('info');
    Route::view('/media', 'cms.medias.medias')->name('media');
    Route::view('/faqs', 'cms.faqs.faqs')->name('faqs');
    Route::view('/testimony', 'cms.testimonies.testimonies')->name('testimony');
});
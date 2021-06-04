<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/profile', 'ProfileController@index')->name('profile');
Route::put('/profile', 'ProfileController@update')->name('profile.update');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/blank', function () {
    return view('blank');
})->name('blank');

Route::name('admin.')->prefix('admin')->middleware('can:admin')->group(function(){
    Route::get('/assets', 'AdminController@assets')->name('assets');
    Route::post('/assets', 'AdminController@assets');
    Route::get('/status_kamar', 'AdminController@status_kamar')->name('status_kamar');
    Route::post('/status_kamar', 'AdminController@status_kamar');
    Route::get('/roles', 'AdminController@roles')->name('roles');
    Route::post('/roles', 'AdminController@roles');
    Route::get('/keluhan', 'AdminController@keluhan')->name('keluhan');
    Route::post('/keluhan', 'AdminController@keluhan');
    Route::get('/perbaikan', 'AdminController@perbaikan')->name('perbaikan');
    Route::post('/perbaikan', 'AdminController@perbaikan');
    Route::get('/kamar', 'AdminController@kamar')->name('kamar');
    Route::post('/kamar', 'AdminController@kamar');
});

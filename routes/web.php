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

Route::name('admin.')->prefix('admin')->middleware('auth','can:admin')->group(function(){
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
    Route::get('/asset', 'AdminController@asset')->name('assets');
    Route::post('/asset', 'AdminController@asset');
    Route::get('/asset-kamar/{kamar}', 'AdminController@asset_kamar')->name('asset');
    Route::post('/asset-kamar/{kamar}', 'AdminController@asset_kamar');
});

Route::name('tamu.')->prefix('tamu')->middleware('auth','can:tamu')->group(function(){
    Route::get('/', 'TamuController@index')->name('index');
    Route::post('/', 'TamuController@index');
    Route::get('/respon/{keluhan}', 'TamuController@respon')->name('respon');
    Route::post('/respon/{keluhan}', 'TamuController@respon');
});

Route::name('petugas.')->prefix('petugas')->middleware('auth','can:petugas')->group(function(){
    Route::get('/', 'PetugasController@index')->name('index');
    Route::post('/', 'PetugasController@index');
    Route::get('/histori', 'PetugasController@histori')->name('histori');
    Route::post('/histori', 'PetugasController@histori');
});

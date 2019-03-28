<?php

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
    return view('index');
});

Auth::routes(['verify' => true]);

Route::get('/index', 'IndexController@showIndex')->name('index');
Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');
Route::get('/profil', 'UserController@index')->name('profil')->middleware('verified');
Route::get('/edit', 'UserController@edit')->name('edit')->middleware('verified');
Route::post('/update', 'UserController@update')->name('update')->middleware('verified');
Route::post('/reset', 'UserController@reset')->name('reset')->middleware('verified');
Route::get('/destroy', 'UserController@destroy')->name('destroy')->middleware('verified');

Route::resource('products','ProductController');
// Route::resource('profilUser', 'UserController');

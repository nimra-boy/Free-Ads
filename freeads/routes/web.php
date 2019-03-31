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

Route::get('/change', function () {
    return view('/auth/passwords/change');
});

Auth::routes(['verify' => true]);

Route::get('/index', 'IndexController@showIndex')->name('index');
Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');
Route::get('/result', 'HomeController@result')->name('result')->middleware('verified');
Route::get('/resulttype', 'HomeController@resultType')->name('resulttype')->middleware('verified');

Route::get('/profil', 'UserController@index')->name('profil')->middleware('verified');
Route::get('/edit', 'UserController@edit')->name('edit')->middleware('verified');
Route::post('/update', 'UserController@update')->name('update')->middleware('verified');
Route::post('/reset', 'UserController@reset')->name('reset')->middleware('verified');
Route::get('/destroy', 'UserController@destroy')->name('destroy')->middleware('verified');

Route::get('/conversations', 'ConversationsController@index')->name('conversations');
Route::get('/conversations/{user}', 'ConversationsController@show')->name('conversations.show');
Route::post('/conversations/{user}', 'ConversationsController@store');

Route::resource('products','ProductController')->middleware('verified');
// Route::resource('profilUser', 'UserController');

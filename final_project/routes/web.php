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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/shows', 'ContentController@popular')->name('contents');
Route::get('/shows/search', 'ContentController@search')->name('contents.search');
Route::post('/shows/{id}/episodes', 'WatchController@store')->name('watchstatus.store');
Route::delete('/shows/{id}/episodes', 'WatchController@destroy')->name('watchstatus.destroy');

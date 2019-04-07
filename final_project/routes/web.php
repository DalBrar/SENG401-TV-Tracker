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
Route::get('/shows/{id}/episodes', 'ContentController@show')->name('content.show');
Route::post('/shows/{id}/episodes', 'WatchStatusController@store')->name('watchstatus.store');
Route::delete('/shows/{id}/episodes', 'WatchStatusController@destroy')->name('watchstatus.destroy');
Route::get('/shows/{content_id}/episodes/{episode_id}', 'EpisodeController@show')->name('episode.show');

Route::post('/subscriptions', 'SubscriptionController@create_or_activate')->name('subscriptions.create_or_activate');
Route::delete('/subscriptions/{id}', 'SubscriptionController@deactivate')->name('subscriptions.deactivate');

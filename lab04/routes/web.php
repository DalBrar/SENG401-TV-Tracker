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

Route::get('/home', [
    'as' => 'user.show',
    'uses' => 'UserController@showMyUser'
]);

Route::get('/books', 'BookController@index');

Route::get('/books/{id}', [
    'as' => 'book.show',
    'uses' => 'BookController@show'
]);

Route::delete('/books/destroy/{id}', [
    'as' => 'book.destroy',
    'uses' => 'BookController@destroy'
]);

Route::post('/books/store', [
    'as' => 'book.store',
    'uses' => 'BookController@store'
]);

Route::post('/books/{book_id}/comment', [
    'as' => 'book.comment',
    'uses' => 'CommentController@store'
]);

Route::get('/subscriptions', [
    'as' => 'subscriptions.index',
    'uses' => 'SubscriptionController@index'
]);

Route::post('/subscriptions/create', [
    'as' => 'subscriptions.create',
    'uses' => 'SubscriptionController@create'
]);

Route::post('/subscriptions/store', [
    'as' => 'subscriptions.store',
    'uses' => 'SubscriptionController@store'
]);

Route::delete('/subscriptions/destroy_by_book_id/{id}', [
    'as' => 'subscriptions.destroy_by_book_id',
    'uses' => 'SubscriptionController@destroy'
]);

Route::delete('/subscriptions/destroy/{id}', [
    'as' => 'subscriptions.destroy',
    'uses' => 'SubscriptionController@destroy'
]);

Route::get('/users', [
    'as' => 'users.index',
    'uses' => 'UserController@index'
]);

Route::post('/users/make_visitor', [
    'as' => 'users.make_visitor',
    'uses' => 'UserController@make_visitor'
]);

Route::post('/users/make_subscriber', [
    'as' => 'users.make_subscriber',
    'uses' => 'UserController@make_subscriber'
]);

Route::post('/users/make_admin', [
    'as' => 'users.make_admin',
    'uses' => 'UserController@make_admin'
]);

Route::get('/authors', [
    'as' => 'authors.index',
    'uses' => 'AuthorController@index'
]);

Route::post('/authors', [
    'as' => 'authors.store',
    'uses' => 'AuthorController@store'
]);

Route::delete('/authors/destroy/{id}', [
    'as' => 'authors.destroy',
    'uses' => 'AuthorController@destroy'
]);

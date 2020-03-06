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

Route::get('/event',             ['as' => 'event.index', 'uses' =>'EventController@index']);
Route::get('/event/create',      ['as' => 'event.create', 'uses' =>'EventController@create']);
Route::post('/event/store',      ['as' => 'event.store', 'uses' =>'EventController@store']);
Route::get('/event/{id}/edit',   ['as' => 'event.edit', 'uses' =>'EventController@edit']);
Route::put('/event/{id}/update', ['as' => 'event.update', 'uses' =>'EventController@update']);
Route::delete('/event/{id}',     ['as' => 'event.destroy', 'uses' =>'EventController@destroy']);
Route::post('/event/import',      ['as' => 'event.import', 'uses' =>'EventController@import']);
Route::get('/event/{id}/export', ['as' => 'event.export', 'uses' =>'EventController@export']);
Route::get('/event/{id}/invite', ['as' => 'event.invite', 'uses' =>'EventController@mail']);
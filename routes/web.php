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

Route::get('/', 'SortController@index');
Route::get('/bubble', 'SortController@bubble');
Route::get('/bubble2', 'SortController@bubble2');
Route::get('/selection', 'SortController@selection');
Route::get('/insertion', 'SortController@insertion');
Route::get('/shell', 'SortController@shell');
Route::get('/quick', 'SortController@quick');
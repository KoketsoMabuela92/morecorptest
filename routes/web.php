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

Route::get('/', 'ProductsController@showProducts');
Route::get('/view/{productId}', 'ProductsController@viewProduct');
Route::get('/bid/{productId}', 'ProductsController@bidProduct');
Route::post('/place-bid', 'ProductsController@placeBid');

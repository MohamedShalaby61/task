<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('addtocart' , 'CartController@store');
Route::post('change_quantity' , 'CartController@changeQuantity');
Route::post('delete_from_cart' , 'CartController@deleteFromCart');
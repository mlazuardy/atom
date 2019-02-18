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
Route::group(['middleware' => 'auth'],function(){
    Route::get('/prepaid-balance','PrepaidController@create')->name('prepaid.create');
    Route::post('/prepaid-balance','PrepaidController@store')->name('prepaid.store');
    //Success
    Route::get('/success/{no}','OrderController@success')->name('orders.success');
    Route::get('/payment','OrderController@payment')->name('payments');
});
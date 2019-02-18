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
    Route::get('/success/{no}','OrderController@success')->name('order.success');
    Route::get('/payment','OrderController@payment')->name('payment');
    //paynow
    Route::post('/payment','OrderController@prepaidPayment')->name('payment.store');
    //product page
    Route::get('/product','ProductController@create')->name('product.create');
    Route::post('/product','ProductController@store')->name('product.store');
});
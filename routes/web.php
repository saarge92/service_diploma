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

Route::group(['middleware' => 'web'], function () {
    Route::get('/', [
        'uses' => 'HomeController@index',
        'as' => 'frontend.home'
    ]);
    Route::post('/add-to-cart', [
        'uses' => 'HomeController@addToCart',
        'as' => 'frontend.addToCart'
    ]);
    Route::get('/get-shopping-cart/', [
        'uses' => 'HomeController@getShoppingCart',
        'as' => 'frontend.getShoppingCart'
    ]);
    Route::post('/reduceByOne', [
        'uses' => 'HomeController@reduceItemRequest',
        'as' => 'frontend.reduceItem'
    ]);
    Route::post('/increaseByOne', [
        'uses' => 'HomeController@increaseItemRequest',
        'as' => 'frontend.increaseItem'
    ]);
    Route::post('/deleteItemRequest', [
        'uses' => 'HomeController@deleteItemRequest',
        'as' => 'frontend.deleteItem'
    ]);
});

Route::group(['middleware' => 'auth', 'prefix' => 'client'], function () {
    Route::get('/index', [
        'uses' => 'ClientController@index',
        'as' => 'client.index'
    ]);
    Route::post('/postOrder', [
        'uses' => 'ClientController@confirmOrder',
        'as' => 'client.confirmOrder'
    ]);
    Route::get('/getOrder/{id}', [
        'uses' => 'ClientController@getOrder',
        'as' => 'client.getOrder'
    ]);
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

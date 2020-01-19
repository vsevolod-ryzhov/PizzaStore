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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/product/{id}', 'HomeController@product')->name('product');

Route::get('/order', 'OrderController@index')->name('order.index');
Route::get('/order/checkout', 'OrderController@checkout')->name('order.checkout');
Route::get('/order/add/{id}/{count}', 'OrderController@add')->name('order.add');
Route::get('/order/remove/{id}', 'OrderController@remove')->name('order.remove');
Route::get('/order/clear', 'OrderController@clear')->name('order.clear');
Route::post('/order/create', 'OrderController@create')->name('order.create');

Route::group(
    [
        'prefix' => 'admin',
        'as' => 'admin.',
        'namespace' => 'Admin',
        'middleware' => ['auth'],
    ],
    function () {
        Route::get('/', 'HomeController@index')->name('home');
        Route::resource('users', 'UsersController');
        Route::resource('products', 'ProductsController');
    }
);


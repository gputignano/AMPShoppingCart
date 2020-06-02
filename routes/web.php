<?php

use Illuminate\Support\Facades\Route;

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

Route::prefix('admin')->name('admin.')->group(function() {
    Route::view('/', 'admin.home')->name('home');

    Route::resource('attributes', 'Admin\AttributesController');
    Route::resource('attributeSets', 'Admin\AttributeSetsController');
    Route::resource('categories', 'Admin\CategoriesController');
    Route::resource('orders', 'Admin\OrdersController');
    Route::resource('orderDetails', 'Admin\OrderDetailsController');
    Route::resource('pages', 'Admin\PagesController');
    Route::resource('products', 'Admin\ProductsController');
    Route::resource('users', 'Admin\UsersController');
    Route::resource('rewrites', 'Admin\RewritesController');
});

// FRONT
Route::prefix('cart')->name('cart.')->group(function() {
    Route::get('/', 'Front\CartController@index')->name('index');
    Route::post('/', 'Front\CartController@store')->name('store');
    Route::delete('{id}', 'Front\CartController@destroy')->name('destroy');
});

Route::get('{rewrite:slug}', 'Front\FrontController')->defaults('rewrite', 'home')->where('rewrite', '.*')->name('front');

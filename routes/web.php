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

    Route::prefix('attributes')->name('attributes.')->group(function() {
        Route::get('/', 'Admin\AttributesController@index')->name('index');
        Route::post('/', 'Admin\AttributesController@store')->name('store');
        Route::get('/create', 'Admin\AttributesController@create')->name('create');
        Route::get('/{attribute}', 'Admin\AttributesController@show')->name('show');
        Route::patch('/{attribute}', 'Admin\AttributesController@update')->name('update');
        Route::delete('/{attribute}', 'Admin\AttributesController@destroy')->name('destroy');
        Route::get('/{attribute}/edit', 'Admin\AttributesController@edit')->name('edit');
    });

    Route::prefix('attributeSets')->name('attributeSets.')->group(function() {
        Route::get('/', 'Admin\AttributeSetsController@index')->name('index');
        Route::post('/', 'Admin\AttributeSetsController@store')->name('store');
        Route::get('/create', 'Admin\AttributeSetsController@create')->name('create');
        Route::get('/{attributeSet}', 'Admin\AttributeSetsController@show')->name('show');
        Route::patch('/{attributeSet}', 'Admin\AttributeSetsController@update')->name('update');
        Route::delete('/{attributeSet}', 'Admin\AttributeSetsController@destroy')->name('destroy');
        Route::get('/{attributeSet}/edit', 'Admin\AttributeSetsController@edit')->name('edit');
    });

    Route::prefix('categories')->name('categories.')->group(function() {
        Route::get('/', 'Admin\CategoriesController@index')->name('index');
        Route::post('/', 'Admin\CategoriesController@store')->name('store');
        Route::get('/create', 'Admin\CategoriesController@create')->name('create');
        Route::get('/{category}', 'Admin\CategoriesController@show')->name('show');
        Route::patch('/{category}', 'Admin\CategoriesController@update')->name('update');
        Route::delete('/{category}', 'Admin\CategoriesController@destroy')->name('destroy');
        Route::get('/{category}/edit', 'Admin\CategoriesController@edit')->name('edit');
    });

    Route::prefix('orders')->name('orders.')->group(function() {
        Route::get('/', 'Admin\OrdersController@index')->name('index');
        Route::post('/', 'Admin\OrdersController@store')->name('store');
        Route::get('/create', 'Admin\OrdersController@create')->name('create');
        Route::get('/{order}', 'Admin\OrdersController@show')->name('show');
        Route::patch('/{order}', 'Admin\OrdersController@update')->name('update');
        Route::delete('/{order}', 'Admin\OrdersController@destroy')->name('destroy');
        Route::get('/{order}/edit', 'Admin\OrdersController@edit')->name('edit');
    });

    Route::prefix('orderDetails')->name('orderDetails.')->group(function() {
        Route::get('/', 'Admin\OrderDetailsController@index')->name('index');
        Route::post('/', 'Admin\OrderDetailsController@store')->name('store');
        Route::get('/create', 'Admin\OrderDetailsController@create')->name('create');
        Route::get('/{orderDetail}', 'Admin\OrderDetailsController@show')->name('show');
        Route::patch('/{orderDetail}', 'Admin\OrderDetailsController@update')->name('update');
        Route::delete('/{orderDetail}', 'Admin\OrderDetailsController@destroy')->name('destroy');
        Route::get('/{orderDetail}/edit', 'Admin\OrderDetailsController@edit')->name('edit');
    });

    Route::prefix('pages')->name('pages.')->group(function() {
        Route::get('/', 'Admin\PagesController@index')->name('index');
        Route::post('/', 'Admin\PagesController@store')->name('store');
        Route::get('/create', 'Admin\PagesController@create')->name('create');
        Route::get('/{page}', 'Admin\PagesController@show')->name('show');
        Route::patch('/{page}', 'Admin\PagesController@update')->name('update');
        Route::delete('/{page}', 'Admin\PagesController@destroy')->name('destroy');
        Route::get('/{page}/edit', 'Admin\PagesController@edit')->name('edit');
    });

    Route::prefix('products')->name('products.')->group(function() {
        Route::get('/', 'Admin\ProductsController@index')->name('index');
        Route::post('/', 'Admin\ProductsController@store')->name('store');
        Route::get('/create', 'Admin\ProductsController@create')->name('create');
        Route::get('/{product}', 'Admin\ProductsController@show')->name('show');
        Route::patch('/{product}', 'Admin\ProductsController@update')->name('update');
        Route::delete('/{product}', 'Admin\ProductsController@destroy')->name('destroy');
        Route::get('/{product}/edit', 'Admin\ProductsController@edit')->name('edit');
    });

    Route::prefix('users')->name('users.')->group(function() {
        Route::get('/', 'Admin\UsersController@index')->name('index');
        Route::post('/', 'Admin\UsersController@store')->name('store');
        Route::get('/create', 'Admin\UsersController@create')->name('create');
        Route::get('/{user}', 'Admin\UsersController@show')->name('show');
        Route::patch('/{user}', 'Admin\UsersController@update')->name('update');
        Route::delete('/{user}', 'Admin\UsersController@destroy')->name('destroy');
        Route::get('/{user}/edit', 'Admin\UsersController@edit')->name('edit');
    });

    Route::prefix('rewrites')->name('rewrites.')->group(function() {
        Route::get('/', 'Admin\RewritesController@index')->name('index');
        Route::post('/', 'Admin\RewritesController@store')->name('store');
        Route::get('/create', 'Admin\RewritesController@create')->name('create');
        Route::get('/{rewrite}', 'Admin\RewritesController@show')->name('show');
        Route::patch('/{rewrite}', 'Admin\RewritesController@update')->name('update');
        Route::delete('/{rewrite}', 'Admin\RewritesController@destroy')->name('destroy');
        Route::get('/{rewrite}/edit', 'Admin\RewritesController@edit')->name('edit');
    });
});

// FRONT
Route::prefix('cart')->name('cart.')->group(function() {
    Route::get('/', 'Front\CartController@index')->name('index');
    Route::post('/', 'Front\CartController@store')->name('store');
    Route::delete('{id}', 'Front\CartController@destroy')->name('destroy');
});

Route::get('{rewrite:slug}', 'Front\FrontController')->defaults('rewrite', 'home')->where('rewrite', '.*')->name('front');

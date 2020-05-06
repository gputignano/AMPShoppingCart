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
    Route::resource('categories', 'Admin\CategoriesController');
    Route::resource('eavs', 'Admin\EAVsController');
    Route::resource('eavDecimals', 'Admin\EAVDecimalsController');
    Route::resource('eavIntegers', 'Admin\EAVIntegersController');
    Route::resource('eavStrings', 'Admin\EAVStringsController');
    Route::resource('eavTexts', 'Admin\EAVTextsController');
    Route::resource('entityTypes', 'Admin\EntityTypesController');
    Route::resource('orders', 'Admin\OrdersController');
    Route::resource('orderDetails', 'Admin\OrderDetailsController');
    Route::resource('pages', 'Admin\PagesController');
    Route::resource('products', 'Admin\ProductsController');
    Route::resource('users', 'Admin\UsersController');
    Route::resource('rewrites', 'Admin\RewritesController');
});

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

Route::prefix('admin')->group(function() {
    Route::get('/', function() {
        return 'Admin Area';
    });

    Route::resource('attributes', 'Admin\AttributesController');
    Route::resource('attributeSets', 'Admin\AttributeSetsController');
    Route::resource('eavBooleans', 'Admin\EAVBooleansController');
    Route::resource('eavDecimals', 'Admin\EAVDecimalsController');
    Route::resource('eavIntegers', 'Admin\EAVIntegersController');
    Route::resource('eavStrings', 'Admin\EAVStringsController');
    Route::resource('eavTexts', 'Admin\EAVTextsController');
    Route::resource('pages', 'Admin\PagesController');
    Route::resource('products', 'Admin\ProductsController');
    Route::resource('users', 'Admin\UsersController');
});

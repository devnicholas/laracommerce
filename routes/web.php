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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::prefix('dashboard')->middleware('auth.admin')->group(function(){
    Route::get('/', 'HomeController@index')->name('dashboard');

    Route::prefix('categories')->group(function(){
        Route::get('/', 'Admin\CategoryController@index')->name('dashboard.category.index');
        Route::post('/', 'Admin\CategoryController@store')->name('dashboard.category.store');
        Route::get('/create', 'Admin\CategoryController@create')->name('dashboard.category.create');
        Route::get('/{id}', 'Admin\CategoryController@show')->name('dashboard.category.show');
        Route::put('/{id}', 'Admin\CategoryController@update')->name('dashboard.category.update');
        Route::delete('/{id}', 'Admin\CategoryController@destroy')->name('dashboard.category.destroy');
    });
    Route::prefix('products')->group(function(){
        Route::get('/', 'Admin\ProductController@index')->name('dashboard.product.index');
        Route::post('/', 'Admin\ProductController@store')->name('dashboard.product.store');
        Route::get('/create', 'Admin\ProductController@create')->name('dashboard.product.create');
        Route::get('/{id}', 'Admin\ProductController@show')->name('dashboard.product.show');
        Route::put('/{id}', 'Admin\ProductController@update')->name('dashboard.product.update');
        Route::delete('/{id}', 'Admin\ProductController@destroy')->name('dashboard.product.destroy');
    });
    Route::prefix('attributes')->group(function(){
        Route::get('/', 'Admin\AttributeController@index')->name('dashboard.attribute.index');
        Route::post('/', 'Admin\AttributeController@store')->name('dashboard.attribute.store');
        Route::get('/create', 'Admin\AttributeController@create')->name('dashboard.attribute.create');
        Route::get('/{id}', 'Admin\AttributeController@show')->name('dashboard.attribute.show');
        Route::put('/{id}', 'Admin\AttributeController@update')->name('dashboard.attribute.update');
        Route::delete('/{id}', 'Admin\AttributeController@destroy')->name('dashboard.attribute.destroy');
    });
    Route::prefix('group-products')->group(function(){
        Route::get('/', 'Admin\GroupProductController@index')->name('dashboard.group-product.index');
        Route::post('/', 'Admin\GroupProductController@store')->name('dashboard.group-product.store');
        Route::get('/create', 'Admin\GroupProductController@create')->name('dashboard.group-product.create');
        Route::get('/{id}', 'Admin\GroupProductController@show')->name('dashboard.group-product.show');
        Route::put('/{id}', 'Admin\GroupProductController@update')->name('dashboard.group-product.update');
        Route::delete('/{id}', 'Admin\GroupProductController@destroy')->name('dashboard.group-product.destroy');
    });
    Route::prefix('users')->group(function(){
        Route::get('/', 'Admin\UserController@index')->name('dashboard.user.index');
        Route::post('/', 'Admin\UserController@store')->name('dashboard.user.store');
        Route::get('/create', 'Admin\UserController@create')->name('dashboard.user.create');
        Route::get('/{id}', 'Admin\UserController@show')->name('dashboard.user.show');
        Route::put('/{id}', 'Admin\UserController@update')->name('dashboard.user.update');
        Route::delete('/{id}', 'Admin\UserController@destroy')->name('dashboard.user.destroy');
    });
    Route::prefix('promotions')->group(function(){
        Route::get('/', 'Admin\PromotionController@index')->name('dashboard.promotion.index');
        Route::post('/', 'Admin\PromotionController@store')->name('dashboard.promotion.store');
        Route::get('/create', 'Admin\PromotionController@create')->name('dashboard.promotion.create');
        Route::get('/{id}', 'Admin\PromotionController@show')->name('dashboard.promotion.show');
        Route::put('/{id}', 'Admin\PromotionController@update')->name('dashboard.promotion.update');
        Route::delete('/{id}', 'Admin\PromotionController@destroy')->name('dashboard.promotion.destroy');
    });
});

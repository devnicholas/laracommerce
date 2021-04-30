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
});

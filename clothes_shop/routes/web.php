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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('','App\Http\Controllers\ProductController@index')->name('home');


Route::get('admin', function (){
    return view('backend.index');
});


Route::prefix('user')->group(function () {
    Route::get('show-signup','App\Http\Controllers\UserController@showRegister')->name('show_signup');
    Route::post('/signup', 'App\Http\Controllers\UserController@register')->name('user_signup');
    Route::post('/login', 'App\Http\Controllers\UserController@login')->name('user_login');
    // Route::post('/check-username', 'UserController@checkExistUsername');
    // Route::post('/remove-token', 'UserController@removeToken');
});

Route::prefix('product')->group(function(){
    Route::get('show-product-backend','App\Http\Controllers\ProductController@listBackend')->name('show_product_backend');
    Route::get('show-product','App\Http\Controllers\ProductController@index')->name('show_product');
    Route::get('show-page-create','App\Http\Controllers\ProductController@create')->name('product_page_create');
    Route::post('create','App\Http\Controllers\ProductController@store')->name('create_product');
    Route::get('delete/{id}','App\Http\Controllers\ProductController@destroy')->name('delete_product');
    Route::get('show-product-detail/{id}','App\Http\Controllers\ProductController@show')->name('product_detail');
    Route::post('edit/{id}', 'App\Http\Controllers\ProductController@update')->name('edit_product');
    Route::get('show-last-product','App\Http\Controllers\ProductController@showLastProduct')->name('show_last_product');
});

Route::prefix('productline')->group(function(){
    Route::get('show-productline','App\Http\Controllers\ProductLineController@index')->name('show_productline');
    Route::get('show-page-create','App\Http\Controllers\ProductLineController@create')->name('show_page_create');
    Route::post('create','App\Http\Controllers\ProductLineController@store')->name('create_productline');
    Route::get('delete/{id}','App\Http\Controllers\ProductLineController@destroy')->name('delete_productline');
    Route::get('show-productline-detail/{id}','App\Http\Controllers\ProductLineController@show')->name('productline_detail');
    Route::post('edit/{id}', 'App\Http\Controllers\ProductLineController@edit')->name('edit_productline');

});

Route::group(['middleware' => ['jwt.verify']], function () {
    Route::prefix('user')->group(function () {
        Route::get('/token', 'App\Http\Controllers\UserController@getAuthenticatedUser');
        // Route::put('/update/{id}', 'UserController@update');
        // Route::post('/change-password', 'UserController@changePassword');
    });
});

Route::middleware('LoginCheck')->group(function ()
{

});

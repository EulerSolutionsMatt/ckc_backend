<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// public routes
Route::group(['middleware' => ['cors', 'json.response']], function () {
    Route::post('/login', 'Auth\ApiAuthController@login')->name('login.api');
    Route::post('/register', 'Auth\ApiAuthController@register')->name('register.api');
    Route::post('/logout', 'Auth\ApiAuthController@logout')->name('logout.api');
    Route::get('products', 'ProductController@getAllProducts');
    Route::get('products/{id}', 'ProductController@getProduct');
    Route::post('products', 'ProductController@createProduct');
    Route::put('products/{id}', 'ProductController@updateProduct');
    Route::delete('products/{id}', 'ProductController@deleteProduct');
});

// protected routes
Route::middleware('auth:api')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});



<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1', 'namespace' => 'Api'], function () {

    Route::post('register', 'AuthController@register');
    Route::post('login', 'AuthController@login');
    Route::post('reset-password', 'AuthController@resetPassword');
    Route::post('new-password', 'AuthController@newPassword');

    Route::get('governorates', 'MainController@governorates');
    Route::get('cities', 'MainController@cities');
    Route::get('blood_types', 'MainController@bloodTypes');
    Route::post('contact-us', 'MainController@contact');
    Route::get('settings', 'MainController@settings');


    Route::group(['middleware' => 'auth:api'], function () {
        Route::post('logout', 'AuthController@logout');
        Route::get('categories', 'MainController@categories');
        // articles Route
        Route::get('articles', 'MainController@articles');
        Route::get('articles/{id}', 'MainController@articleView');
        Route::post('toggle-favourite-articles', 'MainController@toggleFavourite');
        Route::get('my-favourite-articles', 'MainController@favouriteArticles');
        //orders Route
        Route::post('orders', 'MainController@createOrder');
        Route::get('orders', 'MainController@orders');
        Route::get('orders/{id}', 'MainController@orderView');
        // profile Route
        Route::get('profile', 'AuthController@profile');
        Route::post('profile', 'AuthController@updateProfile');
        //Notifications
        Route::post('create-settings-notifications', 'MainController@createSttNotifications');
        Route::post('register-token', 'AuthController@registerToken');
        Route::post('remove-token', 'AuthController@removeToken');
        Route::get('my-all-notifications', 'MainController@myAllNotifications');


    });

});

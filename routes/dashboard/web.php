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



Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ],
    function()
    {
        /** ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP **/

        Route::prefix('dashboard')->name('dashboard.')->middleware(['auth'])->group(function() {

            Route::get('/index', 'DashboardController@index')->name('index');

            // Route Users
            Route::resource('/users', 'UserController');
            // Route bloodTypes
            Route::resource('/bloodTypes', 'bloodTypesController');
            // Route categories
            Route::resource('/categories', 'CategoriesController');
            // Route governorates
            Route::resource('/governorates', 'GovernorateController');
            // Route cities
            Route::resource('/cities', 'CitiesController');
            // Route clients
            Route::resource('/clients', 'ClientController');
            // Route clients
            Route::resource('/articles', 'ArticleController');
            // Route orders
            Route::resource('/orders', 'OrderController');
            //settings routes
            Route::resource('settings', 'SettingController');
        });

    });




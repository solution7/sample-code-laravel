<?php

use Illuminate\Http\Request;

Route::middleware('country_settings', 'api_language')->prefix('v1')->namespace('Api\V1')->group(function () {
    Route::post('login', 'AuthenticationController@login');
    Route::get('request-password-reset/{token}', 'AuthenticationController@checkValidToken');

    Route::middleware('auth:api')->group(function () {
        Route::resource('customers', 'CustomerController', ['only' => ['show', 'store', 'update', 'destroy']]);
        Route::post('billing-address', 'CustomerController@storeBillingAddress');
        Route::prefix('admin')->group(function () {
            Route::resource('/profiles', 'ProfileController', ['only' => ['show', 'update']]);
            Route::get('users', 'UserController@index');
            Route::patch('/country-settings', 'DefaultController@countrySetting');
        });

        Route::get('status-types', 'InvoiceController@getStatusType');
    });
});

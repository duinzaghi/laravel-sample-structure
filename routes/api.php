<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group(['prefix' => '/v1'], function () {
    Route::get('/files/{id}', 'FileUploadController@getImage');
    Route::group(['middleware' => ['firebase.jwt']], function() {
        //Authentication controller
        Route::group(['prefix' => '/auth'], function() {
            Route::get('/me', 'AuthController@me');
            Route::post('/signup', 'AuthController@signUp');
            Route::put('/{id}', 'AuthController@update');
        });

        // Industry controller
        Route::group(['prefix' => '/industries'], function() {
            Route::get('', 'IndustryController@index');
            Route::get('/{id}', 'IndustryController@show');
            Route::group(['middleware' => ['admin.role']], function() {
                Route::post('', 'IndustryController@store');
                Route::put('/{id}', 'IndustryController@update');
                Route::delete('/{id}', 'IndustryController@destroy');
            });
        });
    });
});

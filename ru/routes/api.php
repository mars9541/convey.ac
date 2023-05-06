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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', 'Auth\AuthController@login')->name('login');
    Route::post('register', 'Auth\AuthController@register');
    Route::group([
        'middleware' => 'auth:api'
    ], function() {
        Route::post('logout', 'Auth\AuthController@logout');
        Route::get('user', 'Auth\AuthController@user');
    });
});

Route::group(['middleware' => 'auth:api'], function() {
    Route::get('search', 'Api\SearchController@search');
    Route::post('request_record_unlock', 'Api\SearchController@request_record_unlock');
    Route::post('rate_record', 'Api\SearchController@rate_record');
    Route::post('request_departure_evaluation', 'Api\SearchController@request_departure_evaluation');
    Route::get('user', 'Api\SearchController@user');
    Route::post('insert_record','Api\RecordController@InsertRecord');
    Route::post('insert_multi_records','Api\RecordController@InsertMultiRecords');
    Route::post('InsertRecordByFile','Api\RecordController@InsertRecordByFile');
});

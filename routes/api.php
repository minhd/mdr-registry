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

// api/me
Route::middleware('auth:api')->get('/me', function (Request $request) {
    return $request->user();
});

// api/
Route::get('/', 'API\APIController@index');

// api/registry
Route::middleware('auth:api')->prefix('registry')->group(function () {
    Route::prefix('resources')->group(function() {
        Route::apiResource('datasources', 'API\Resource\DataSourceAPIController');
        Route::apiResource('records', 'API\Resource\RecordAPIController');
        Route::apiResource('records.versions', 'API\Resource\RecordVersionAPIController');
    });
});

// api/igsn

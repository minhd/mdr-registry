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

Route::middleware('auth:api')->get('/me', function (Request $request) {
    return $request->user();
});

Route::get('/', 'API\APIController@index');

Route::middleware('auth:api')->group(function () {
    Route::model('datasource', App\Datasource::class);
    Route::model('record', App\Record::class);
    Route::model('schema', App\Schema::class);

    Route::apiResource('datasources', 'API\Resource\DataSourceAPIController');
    Route::apiResource('records', 'API\Resource\RecordAPIController');
    Route::apiResource('schemas', 'API\Resource\SchemaAPIController');
});

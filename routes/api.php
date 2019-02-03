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

Route::get('/inventory', 'InventoryController@index');

Route::post('/getpicture', 'CarController@getPicture');

Route::post('/image', 'InventoryController@image');

Route::resource('/manufacturer', 'ManufacturerController', [
    'except' => ['edit', 'show', 'create']
]);

Route::resource('/car', 'CarController', [
    'except' => ['edit', 'create']
]);

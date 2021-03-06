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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'auth:api', 'prefix' => 'admin'], function() {
    Route::apiResource('/users', 'API\UserController');
    Route::get('/getAuthUser', 'API\UserController@getAuthUser');
    Route::get('/countUsers', 'API\UserController@countUsers');
    Route::apiResource('/permissions', 'API\PermissionController');
    Route::get('/countPermissions', 'API\PermissionController@countPermissions');

    
});
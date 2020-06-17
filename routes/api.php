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


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/
Route::post('/register', 'Api\AuthController@register');
Route::post('/login', 'Api\AuthController@login');


Route::post('/router/updateByIp', 'Api\RouterController@updateByIpAddress')->middleware('auth:api');
Route::get('/router/getRoutersByIpRange', 'Api\RouterController@getRoutersByIpRange')->middleware('auth:api');
Route::delete('/router/deleteByIp', 'Api\RouterController@deleteByIpAddress')->middleware('auth:api');
Route::apiResource('/router', 'Api\RouterController')->middleware('auth:api');
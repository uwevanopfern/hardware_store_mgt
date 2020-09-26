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

Route::apiResource('/users', 'Api\UserController');

Route::group(['middleware' => 'auth:api'], function () {

    Route::get('/profile', 'Api\UserController@me');
    Route::get('/logout', 'Api\UserController@logout');
    Route::post('/login', 'Api\UserController@login');

    Route::apiResource('/clients', 'Api\ClientController');
    Route::apiResource('/products', 'Api\ProductController');
    Route::apiResource('/sales', 'Api\SaleController');
    Route::apiResource('/stocks', 'Api\StockController');
    Route::apiResource('/companies', 'CompanyController');

    Route::group(['prefix' => 'reports'], function () {
        Route::post('stock', 'Api\StockController@reports');
        Route::post('sales', 'Api\SaleController@reports');
    });
});
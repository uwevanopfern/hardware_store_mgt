<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'auth:api'], function () {
    Route::resource('/companies', 'CompanyController');
});

Auth::routes(['verify' => true]);

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/admin-login', function () {
    return view('layouts.login');
});

Route::get('/admin-register', function () {
    return view('layouts.register');
});

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



Route::get('/findpass','UserController@vFindpass');     //找回密码
Route::post('/findpass','UserController@findpass');     //找回密码
Route::get('/resetpass','UserController@vResetpass');   //重置密码
Route::post('/resetpass','UserController@resetpass');   //重置密码

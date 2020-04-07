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

Route::get('/reg','UserController@reg');  //注册视图
Route::post('/regdo','UserController@regdo');  //执行注册
Route::get('/login','UserController@login');  //登录视图
Route::post('/logindo','UserController@logindo');  //执行登录

Route::get('/pan','UserController@pan');  //判断用户是否登录

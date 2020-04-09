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


Route::get('/test/mailto','UserController@testMail');     //邮件测试
Route::get('/findpass','UserController@vFindpass');     //找回密码
Route::post('/findpass','UserController@findpass');     //找回密码
Route::get('/resetpass','UserController@vResetpass');   //重置密码
Route::post('/resetpass','UserController@resetpass');   //重置密码
Route::get('/reg','UserController@reg');  //注册视图
Route::post('/regdo','UserController@regdo');  //执行注册
Route::get('/login','UserController@login');  //登录视图
Route::post('/logindo','UserController@logindo');  //执行登录
Route::get('/modify','UserController@modify');  //修改密码
Route::any('/modifydo','UserController@modifydo');  //执行修改
Route::get('/personal','UserController@personal');  //首页

Route::get('/pan','UserController@pan');  //判断用户是否登录

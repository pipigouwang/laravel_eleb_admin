<?php

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
//商品分类
Route::resource('goodscategory','GoodscategoryController');
//商品分类
Route::resource('shopscategory','ShopscategoryController');
//Route::get('user','UserController@index');
//商家表
Route::resource('shops','ShopsController');
//用户信息表
Route::resource('users','UsersController');
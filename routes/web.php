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

//注册
Route::get('register', function () {
    return view('register');
});

//Route::get('register', function () {
//    return view('welcome');
//});
//商品分类
Route::resource('goodscategory','GoodscategoryController');
//商品分类
Route::resource('shopscategory','ShopscategoryController');
//Route::get('user','UserController@index');
//商家表
Route::resource('shops','ShopsController');
//用户信息表
Route::resource('users','UsersController');
//审核状态
Route::get('/shops/info/{shop}','ShopsController@info')->name('shops.info');
Route::post('/shops/{shop}','ShopsController@status')->name('shops.status');
//管理员资源路由
Route::resource('admin','AdminController');
//会话登录
Route::get('login','SessionsController@login')->name('login');
Route::post('login','SessionsController@store')->name('login');
Route::get('logout','SessionsController@logout')->name('logout');
//修改个人密码
Route::get('/admin/pass/{admin}','AdminController@pass')->name('admin.pass');
Route::patch('/admin/password/{admin}',"AdminController@password")->name('admin.password');
//注册
Route::get('register','ShopsController@register')->name('register');
Route::post('store','ShopsController@store')->name('store');
//接收文件上传
Route::post('upload',function (){
    $storage = \Illuminate\Support\Facades\Storage::disk('oss');
    $fileName = $storage->putFile('upload',request()->file('file'));
    return[
        'fileName'=>$storage->url($fileName)
    ];
})->name('upload');
//活动路由列表
Route::resource('activities','activitiesController');
//查看活动详情
Route::get('/activities/show/{activity}','ActivitiesController@show')->name('activities.show');
Route::get('test','MembersController@test');
//收货地址
Route::resource('Address','AddressController');
//
//Route::resource('count','CountController');
//订单统计
Route::get('/CountOrder','CountController@index')->name('CountOrder');
Route::get('/OrderDay','CountController@order_day')->name('OrderDay');
Route::get('/OrderMonth','CountController@order_month')->name('OrderMonth');
//菜品统计
Route::get('/CountMenu','CountController@menu')->name('CountMenu');
Route::get('/MenuDay','CountController@menu_day')->name('MenuDay');
Route::get('/MenuMonth','CountController@menu_month')->name('MenuMonth');
//会员表
Route::get('/members','MembersController@index')->name('members');
//会员账号启用和禁用
Route::get('/members.able/{member}','MembersController@able')->name('members.able');
//权限管理
Route::resource('permissions','PermissionsController');
Route::resource('roles','RolesController');
//菜单
Route::resource('/navs','NavController');
//抽奖活动表
Route::resource('events','EventController');
//抽奖活动列表
Route::resource('eventprizes','EventprizesController');
//活动报名列表
Route::resource('eventusers','EventusersController');

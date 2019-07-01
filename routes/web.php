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





// 路由: 后台登录
Route::get('admin/login','Admin\LoginController@login');
// 路由: 执行后台登录
Route::post('admin/dologin','Admin\LoginController@dologin');
// 路由: 后台退出
Route::get('admin/outlogin','Admin\LoginController@outlogin');
// 路由: 权限
Route::get('admin/rbac',function(){
	return view('admin.rbac');
});

Route::group(['middleware'=>['login','nodes']],function(){

	// 路由: 后台首页
	Route::get('admin','Admin\IndexController@index');

	// 路由: 后台管理员用户
	Route::resource('admin/adminuser','Admin\AdminuserController');

	// 路由: 后台用户
	Route::resource('admin/users','Admin\UsersController');

	// 路由: 后台角色
	Route::resource('admin/roles','Admin\RolesController');

	// 路由: 后台权限
	Route::resource('admin/nodes','Admin\NodesController');

	// 路由： 后台分类
	Route::resource('admin/cates','Admin\CatesController');

	// 路由： 后台轮播图
	Route::resource('admin/slideshow','Admin\SlideshowController');

	// 路由： 后台友情链接
	Route::resource('admin/link','Admin\LinkController');

	//路由：后台商品
	Route::resource('admin/goods','Admin\GoodsController');

	//路由：后台商品图片管理
	Route::resource('admin/goodsimg','Admin\GoodsimgController');

	// 路由: 后台订单列表
	Route::get('admin/order','Admin\OrderController@index');

	// 路由: 后台订单删除
	Route::post('admin/order/del','Admin\OrderController@destory');

	// 路由: 后台订单详情
	Route::get('admin/order/detail/{oid}','Admin\OrderController@detail');

	// 路由: 后台订单状态修改
	Route::post('admin/order/update','Admin\OrderController@update');

	// 路由: 修改头像
	Route::get('admin/profile','Admin\LoginController@profile');

	// 路由: 执行头像修改
	Route::post('admin/doprofile','Admin\LoginController@doprofile');

	// 修改 密码
	Route::get('admin/pass','Admin\LoginController@pass');

	// 执行 密码 修改
	Route::post('admin/dopass','Admin\LoginController@dopass');


	

	

	

	
});

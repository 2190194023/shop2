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






// 路由: 前台首页
Route::get('/','Home\IndexController@index');

// 路由: 前台列表
Route::resource('home/list','Home\ListController');

// 路由: 前台商品详情
Route::resource('home/page','Home\PageController');




// 路由: 后台登录
Route::get('admin/login','Admin\LoginController@login');
// 路由: 执行后台登录
Route::post('admin/dologin','Admin\LoginController@dologin');
// 路由: 后台退出
Route::get('admin/outlogin','Admin\LoginController@outlogin');

Route::group(['middleware'=>'login'],function(){

	// 路由: 后台首页
	Route::get('admin','Admin\IndexController@index');


	// 路由: 后台订单列表
	Route::get('admin/order','Admin\OrderController@index');

	// 路由: 后台订单删除
	Route::post('admin/order/del','Admin\OrderController@destory');

	// 路由: 后台订单详情
	Route::get('admin/order/detail/{oid}','Admin\OrderController@detail');

	// 路由: 后台订单状态修改
	Route::post('admin/order/update','Admin\OrderController@update');

	// 路由： 后台分类
	Route::resource('admin/cates','Admin\CatesController');

	// 路由： 后台友情链接
	Route::resource('admin/link','Admin\LinkController');

	// 路由： 后台轮播图
	Route::resource('admin/slideshow','Admin\SlideshowController');

	//路由: 后台修改头像
	Route::get('admin/profile','Admin\LoginController@profile');
	Route::post('admin/upload','Admin\LoginController@upload');

	// 路由: 后台管理员用户
	Route::resource('admin/adminuser','Admin\AdminuserController');

	// 路由: 后台用户
	Route::resource('admin/users','Admin\UsersController');

	// 路由: 后台角色
	Route::resource('admin/roles','Admin\RolesController');

	// 路由: 后台权限
	Route::resource('admin/nodes','Admin\NodesController');

	//路由： 后台分类
	Route::resource('admin/cates','Admin\CatesController');

	//路由：后台商品
	Route::resource('admin/goods','Admin\GoodsController');

	//路由：后台商品 评论
	Route::resource('admin/discuss','Admin\DiscussController');

	//路由：后天商品图片管理
	Route::resource('admin/goodsimg','Admin\GoodsimgController');

	//路由：后台商品图片管理
	Route::resource('admin/goodsimg','Admin\GoodsimgController');

	//路由：后台秒杀商品管理
	Route::resource('admin/miao','Admin\MiaoController');

	//路由：后台活动管理
	Route::resource('admin/dong','Admin\HuodongController');
});




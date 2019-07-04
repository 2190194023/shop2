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

// 路由: 前台注册
Route::get('home/register','Home\RegisterController@index');

// 路由: 前台注册(手机号)
Route::get('home/register/sendPhone','Home\RegisterController@sendPhone');

// 路由: 前台执行注册(手机号)
Route::post('home/register/store','Home\RegisterController@store');

// 路由: 前台注册(邮箱)
Route::post('home/register/insert','Home\RegisterController@insert');

// 路由: 激活用户邮件
Route::get('home/register/changeStatus/{id}/{token}','Home\RegisterController@changeStatus');

// 路由: 前台登录
Route::get('home/login','Home\LoginController@index');

// 路由: 执行前台登录
Route::post('home/dologin','Home\LoginController@dologin');

// 路由: 前台退出
Route::get('home/logout','Home\LoginController@logout');

// 路由: 前台个人中心
Route::get('home/geren/index','Home\GerenController@index');

// 路由: 前台修改个人中心
Route::get('home/geren/edit/{id}','Home\GerenController@edit');

// 路由: 前台执行修改个人中心
Route::post('home/geren/update/{id}','Home\GerenController@update');

// 路由: 前台修改密码
Route::get('home/geren/pass/{id}','Home\GerenController@pass');

// 路由: 前台执行修改密码
Route::post('home/geren/dopass/{id}','Home\GerenController@dopass');

// 路由: 前台收货地址
Route::get('home/geren/ress/{id}','Home\GerenController@ress');

// 路由: 前台添加收货地址
Route::get('home/geren/ressjia/{id}','Home\GerenController@ressjia');
// 路由: 前台执行添加收货地址
Route::post('home/geren/doressjia','Home\GerenController@doressjia');

// 路由: 前台执行删除收货地址
Route::get('home/geren/del/{id}','Home\GerenController@destory');
// 路由: 前台修改默认收货地址
Route::get('home/geren/show/{id}','Home\GerenController@show');
// 路由: 前台执行修改默认收货地址
Route::post('home/geren/moren','Home\GerenController@moren');

// 路由: 前台列表
Route::resource('home/list','Home\ListController');

// 路由: 前台商品详情
Route::resource('home/page','Home\PageController');

// -----------------------------------------------------------------
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

	// 路由: 后台修改头像
	Route::get('admin/profile','Admin\LoginController@profile');

	// 路由: 执行头像修改
	Route::post('admin/doprofile','Admin\LoginController@doprofile');

	// 路由: 修改密码
	Route::get('admin/pass','Admin\LoginController@pass');

	// 路由: 执行修改密码
	Route::post('admin/dopass','Admin\LoginController@dopass');

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

	// 路由: 后台商品
	Route::resource('admin/goods','Admin\GoodsController');

	//路由：后台商品 评论
	Route::resource('admin/discuss','Admin\DiscussController');

	// 路由：后天商品图片管理
	Route::resource('admin/goodsimg','Admin\GoodsimgController');

	// 路由：后台秒杀商品管理
	Route::resource('admin/miao','Admin\MiaoController');

	// 路由：后台活动管理
	Route::resource('admin/dong','Admin\HuodongController');

	// 路由: 后台订单列表
	Route::get('admin/order','Admin\OrderController@index');

	// 路由: 后台订单删除
	Route::post('admin/order/del','Admin\OrderController@destory');

	// 路由: 后台订单详情
	Route::get('admin/order/detail/{oid}','Admin\OrderController@detail');

	// 路由: 后台订单状态修改
	Route::post('admin/order/update','Admin\OrderController@update');

	// 路由： 后台友情链接
	Route::resource('admin/link','Admin\LinkController');
	
});





	


	

	

	




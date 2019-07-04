@extends('home.public.header')
<body>

<header id="pc-header">
	<div class="pc-header-nav">
		<div class="pc-header-con">
			@if(!session('home_login'))
			<div class="fl pc-header-link" >您好！，欢迎来云购物 
				<a href="/home/login">请登录</a> 
				<a href="/home/register">免费注册</a>
			</div>
			@else
				<div class="fl pc-header-link" >您好！，欢迎&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:red;">{{ $user->uname }}</span>
				<a href="/home/logout">退出</a> 
	
			</div>
			@endif
			<div class="fr pc-header-list top-nav">
				<ul>
					<li>
						<div class="nav"><i class="pc-top-icon"></i><a href="#">我的订单</a></div>
						<div class="con">
							<dl>
								<dt><a href="">批发进货</a></dt>
								<dd><a href="">已买到货品</a></dd>
								<dd><a href="">优惠券</a></dd>
								<dd><a href="">店铺动态</a></dd>
							</dl>
						</div>
					</li>
					<li>
						<div class="nav"><i class="pc-top-icon"></i><a href="#">我的商城</a></div>
						<div class="con">
							<dl>
								<dt><a href="">批发进货</a></dt>
								<dd><a href="">已买到货品</a></dd>
								<dd><a href="">优惠券</a></dd>
								<dd><a href="">店铺动态</a></dd>
							</dl>
						</div>
					</li>
					<li><a href="#">我的云购</a></li>
					<li><a href="#">我的收藏</a></li>
					@if(!empty(session('home_userinfo')))
						<li><a href="/home/geren/index">个人中心</a></li>
					@else
						<li><a href="/home/login">个人中心</a></li>
					@endif
					<li><a href="#">客户服务</a></li>
					<li><a href="#">帮助中心</a></li>
				</ul>
			</div>
		</div>
	</div>
	<div class="pc-header-logo clearfix">
		<div class="pc-fl-logo fl">
			<h1>
				<a href="/"></a>
			</h1>
		</div>
		<div class="head-form fl">
			<form class="clearfix" action="/home/list/001" method="get">
				{{ csrf_field() }}
				<input class="search-text" style="height:36px;" name="search" id="key" autocomplete="off" placeholder="洗衣机" type="text">
				<button class="button" onclick="search('key');return false;">搜索</button>
			</form>
			<div class="words-text clearfix">
				<a href="#" class="red">1元秒爆</a>
				<a href="#">低至五折</a>
				<a href="#">农用物资</a>
				<a href="#">佳能相机</a>
				<a href="#">服装城</a>
				<a href="#">买4免1</a>
				<a href="#">家电秒杀</a>
				<a href="#">农耕机械</a>
				<a href="#">手机新品季</a>
			</div>
		</div>
		<div class="fr pc-head-car">
			<i class="icon-car"></i>
			<a href="/home/mycar" target="_blank">我的购物车</a>
			<em>{{ $mycarnum }}</em>
		</div>
	</div>
	<!--  顶部    start-->
	<div class="yHeader">
		<!-- 导航   start  -->
		<div class="yNavIndex">
			<ul class="yMenuIndex" style="margin-left:0">
				<li style="background:#d1201e"><a href="/" target="">云购首页</a></li>
				@foreach($cate_data as $k=>$v)
				<li><a href="/home/list/{{ $v->id }}" target="">{{ $v->cname }}</a></li>
				@endforeach
			</ul>
		</div>
		<!-- 导航   end  -->
	</div>

</header>

<section id="member">
	<div class="member-center clearfix">
		<div class="member-left fl">
			<div class="member-apart clearfix">
				<div class="fl"><a href="#"><img src="/uploads/{{ $user->profile }}"></a></div>
				<div class="fl">
					<p>用户名：</p>
					<p><a href="#">{{ $user->uname }}</a></p>
					<p>搜悦号：</p>
					<p>{{ $user->id }}</p>
				</div>
			</div>
			<div class="member-lists">
				<dl>
					<dt>我的商城</dt>
					<dd class="cur"><a href="/home/geren/pass/{{ $user->id }}">账户安全</a></dd>
					<dd class="cur"><a href="/home/order/">我的订单</a></dd>
					<dd class="cur"><a href="/home/geren/ress/{{ $user->id }}">地址管理</a></dd>
				</dl>
			</div>
		</div>
		<div class="member-right fr">
			<div class="member-head">
				<div class="member-heels fl"><h2>评论商品</h2></div>
			</div>
			<div class="member-border">
				<div class="member-return H-over">
					<form action="/home/order/{{ $order->id }}" method="get" enctype="multipart/form-data">
						{{ csrf_field() }}
						@if (count($errors) > 0)
					        <div class="mws-form-message error">
					            <ul>
					                @foreach ($errors->all() as $error)
					                    <li>{{ $error }}</li>
					                @endforeach
					            </ul>
					        </div>
					    @endif


					    @if(session('error'))
						   <script  type="text/javascript">   
						    	
						    	alert('{{ session('error') }}', {icon: 6});
						   </script>
						@endif
						<table>
							<tr>
								<th>商品名称:</th>
								<td><input class="ty"  type="text" value="{{ $goods->gname }}" disabled ></td>
							</tr>
							<tr>
								<th>商品图片:</th>
								<td><img src="/uploads/{{ $goods->url }}" width="200px;"></td>
							</tr>
							<tr>
								<th>分享您的使用体验吧!:</th>
								<td><!-- 加载编辑器的容器 -->
							    <script style="height:150px;width:500px;" id="container" name="content" type="text/plain"></script></td>
							</tr>
							<tr>
								<td></td>
								<td><input type="submit" class="btn" value="提交"></td>
							</tr>
						</table>
					</form>
					<!-- 配置文件 -->
				    <script type="text/javascript" src="/utf8-php/ueditor.config.js"></script>
				    <!-- 编辑器源码文件 -->
				    <script type="text/javascript" src="/utf8-php/ueditor.all.js"></script>
					<!-- 实例化编辑器 -->
				    <script type="text/javascript">
				        var ue = UE.getEditor('container',{toolbars: [
						    ['fullscreen', 'source', 'undo', 'redo', 'bold','snapscreen','emotion','link','justifyleft','justifyright','justifycenter','justifyjustify','music']
						]});
				    </script>
					<div class="main-page" style="display: none;">
				<div class="row calender widget-shadow">
					<h4 class="title">Calender</h4>
					<div class="cal1">
					</div>
				</div>
				<div class="clearfix"> </div>
			</div>
					<div class="member-prompt">
						<p>安全提示：</p>
						<p>1. 注意防范进入钓鱼网站，不要轻信各种即时通讯工具发送的商品或支付链接，谨防网购诈骗。</p>
						<p>2. 建议您安装杀毒软件，并定期更新操作系统等软件补丁，确保账户及交易安全。      </p>
					</div>
					

				</div>
			</div>
		</div>
	</div>
</section>


<div style="height:100px"></div>
<style type="text/css">
		.ty{
			width: 200px;
			height: 30px;
			font-family: '楷体';
		}
		.btn{
			display: inline-block;
		    padding: 6px 12px;
		    margin-bottom: 0;
		    font-size: 14px;
		    font-weight: 400;
		    line-height: 1.42857143;
		    text-align: center;
		    white-space: nowrap;
		    vertical-align: middle;
		    -ms-touch-action: manipulation;
		    touch-action: manipulation;
		    cursor: pointer;
		    -webkit-user-select: none;
		    -moz-user-select: none;
		    -ms-user-select: none;
		    user-select: none;
		    background-image: none;
		    border: 1px solid transparent;
		    border-radius: 4px;
		}
        
    </style>
@extends('home.public.footer')
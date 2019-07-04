<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="Generator" content="EditPlus®">
	<meta name="Author" content="">
	<meta name="Keywords" content="">
	<meta name="Description" content="">
	<meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE">
	<meta name="renderer" content="webkit">
	<title>云购物商城-个人中心</title>
	<link rel="shortcut icon" type="image/x-icon" href="img/icon/favicon.ico">
	<link rel="stylesheet" type="text/css" href="/home/css/base.css">
	<link rel="stylesheet" type="text/css" href="/home/css/home.css">
	<link rel="stylesheet" type="text/css" href="/home/css/member.css">
	<script type="text/javascript" src="/home/js/jquery.js"></script>
	<script type="text/javascript" src="/home/js/index.js"></script>
	<script type="text/javascript" src="/home/js/modernizr-custom-v2.7.1.min.js"></script>
	<script type="text/javascript" src="/home/js/jquery.SuperSlide.js"></script>
	<style type="text/css">
	.ty{
		width: 300px;
		height: 30px;
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
</head>

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
		<!-- 内容 开始 -->
		<div class="member-right fr">
			<div class="member-head">
				<div class="member-heels fl"><h2>添加地址</h2></div>
			</div>
			<div class="member-border">
				
				<div class="member-caution clearfix">
					<form action="/home/geren/moren" method="post" enctype="multipart/form-data">
						{{ csrf_field() }}
						<table>
							<tr>
								<th>收件人:</th>
								<td>
									<input type="hidden" name="uid" value="{{ $address->uid }}">
									<input type="hidden" name="id" value="{{ $address->id }}">
									<input class="ty" type="text" name="name" value="{{ $address->name }}">
								</td>
							</tr>
							<tr>
								<th>联系方式:</th>
								<td><input class="ty" type="text" name="phone" value="{{ $address->phone }}"></td>
							</tr>
							<tr>
								<th>地区:</th>
								<td>
									<select id="Province" runat="server" name="province" style="width: 90px" ></select>
									<select id="Country" runat="server" name="country" style="width: 90px"></select>
									<select id="Town" runat="server" name="town" style="width: 90px"></select>
								</td> 
							</tr>
							<tr>
								<th>详细地址：</th>
								<td><textarea  class="ty" name="addr">{{ $address->province }}</textarea></td>
							</tr>
							<tr>
								<th>邮编:</th>
								<td><input class="ty" type="text" name="bian" value="{{ $address->bian }}"></td>
							</tr>
							<tr>
								<th>默认地址:</th>
								<td>
									@if($address->moren == 1)
									<input class="btn" type="radio" name="moren" checked value="1">默认
									<input class="btn" type="radio" name="moren" value="0">不默认
									@else
									<input class="btn" type="radio" name="moren" value="1">默认
									<input class="btn" type="radio" name="moren" checked value="0">不默认
									@endif
								</td>
							</tr>
							<tr>
								<td></td>
								<td><input type="submit" class="btn" value="修改"></td>
							</tr>
						</table>
					</form>
					<script type="text/javascript" src="/area.js"></script>
					<script language="javascript">
						setup();
				    </script>
					
					<div class="member-prompt">
						<p>安全提示：</p>
						<p>1. 注意防范进入钓鱼网站，不要轻信各种即时通讯工具发送的商品或支付链接，谨防网购诈骗。</p>
						<p>2. 建议您安装杀毒软件，并定期更新操作系统等软件补丁，确保账户及交易安全。      </p>
					</div>
				</div>
			</div>
		</div>
		<!-- 内容 结束 -->
	</div>
</section>


<div style="height:100px"></div>

<footer>
	<div class="pc-footer-top">
		<div class="center">
			<ul class="clearfix">
				<li>
					<span>关于我们</span>
					<a href="#">关于我们</a>
					<a href="#">诚聘英才</a>
					<a href="#">用户服务协议</a>
					<a href="#">网站服务条款</a>
					<a href="#">联系我们</a>
				</li>
				<li class="lw">
					<span>购物指南</span>
					<a href="#">新手上路</a>
					<a href="#">订单查询</a>
					<a href="#">会员介绍</a>
					<a href="#">网站服务条款</a>
					<a href="#">帮助中心</a>
				</li>
				<li class="lw">
					<span>消费者保障</span>
					<a href="#">人工验货</a>
					<a href="#">退货退款政策</a>
					<a href="#">运费补贴卡</a>
					<a href="#">无忧售后</a>
					<a href="#">先行赔付</a>
				</li>
				<li class="lw">
					<span>商务合作</span>
					<a href="#">人工验货</a>
					<a href="#">退货退款政策</a>
					<a href="#">运费补贴卡</a>
					<a href="#">无忧售后</a>
					<a href="#">先行赔付</a>
				</li>
				<li class="lss">
					<span>下载手机版</span>
					<div class="clearfix lss-pa">
						<div class="fl lss-img"><img src="/home/img/icon/code.png" alt=""></div>
						<div class="fl" style="padding-left:20px">
							<h4>扫描下载云购APP</h4>
							<p>把优惠握在手心</p>
							<P>把潮流带在身边</P>
							<P></P>
						</div>
					</div>
				</li>
			</ul>
		</div>
		<div class="pc-footer-lin">
			<div class="center">
				<p>友情链接：
					卡宝宝信用卡
					梦芭莎网上购物
					手游交易平台
					法律咨询
					深圳地图
					P2P网贷导航
					名鞋库
					万表网
					叮当音乐网
					114票务网
					儿歌视频大全
				</p>
				<p>
					京ICP证1900075号  京ICP备20051110号-5  京公网安备110104734773474323  统一社会信用代码 91113443434371298269B  食品流通许可证SP1101435445645645640352397
				</p>
				<p style="padding-bottom:30px">版物经营许可证 新出发京零字第朝160018号  Copyright©2011-2015 版权所有 ZHE800.COM </p>
			</div>
		</div>
	</div>
</footer>

</body>
</html>
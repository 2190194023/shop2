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
	<title>我的购物车-云购物商城</title>
	<link rel="shortcut icon" type="image/x-icon" href="img/icon/favicon.ico">
	<link rel="stylesheet" type="text/css" href="css/base.css">
	<link rel="stylesheet" type="text/css" href="css/home.css">
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/index.js"></script>
	<script type="text/javascript" src="js/modernizr-custom-v2.7.1.min.js"></script>

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
				<input class="search-text" name="search" id="key" autocomplete="off" placeholder="洗衣机" type="text">
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

<section id="pc-jie">
	<div class="center ">
		<ul class="pc-shopping-title clearfix">
			<li><a href="/home/list/000" class="cu">全部商品({{ $num }})</a></li>
			<li><a href="#">限时优惠(7)</a></li>
		</ul>
	</div>
	<div class="pc-shopping-cart center">
		<div class="pc-shopping-tab">
			<table>
				<thead>
					<tr class="tab-0">
						<th class="tab-1"><input type="checkbox" name="s_all" class="s_all tr_checkmr" id="inp"><label for=""> 全选</label></th>
						<th class="tab-2">商品</th>
						<th class="tab-3">商品信息</th>
						<th class="tab-4">单价</th>
						<th class="tab-5">数量</th>
						<th class="tab-6">小计</th>
						<th class="tab-7">操作</th>
					</tr>
				</thead>
				<tbody>
					@php 
						use App\Models\Goods;
					@endphp
					@foreach($mycar as $k=>$v)
					@php
						$goods = Goods::where('id',$v->gid)->first();
						$gnum = $v->num * $goods->gprice;
					@endphp
					<tr>
						<th><input type="checkbox" class="inp" style="margin-left:10px; float:left"></th>
						<th class="tab-th-1">
							<a href="/home/page/{{ $goods->id }}"><img src="/uploads/{{ $goods->url }}" width="100%" alt=""></a>
							<a href="/home/page/{{ $goods->id }}" class="tab-title">{{ $goods->gname }}</a>
						</th>
						<th>
							<p>规格：{{ $goods->size }}</p>
						</th>
						<th>
							<p>{{ $goods->gprice }}</p>
							<!-- <p class="red">299.99</p> -->
						</th>
						<th class="tab-th-2">
							<input type="text" value="{{ $v->num }}" maxlength="3" disabled class="shul">
						</th>
						<th class="red" id="price">{{ $gnum }}</th>
						<th><a title="删除" token="{{ csrf_token() }}" onclick="member_del(this,'{{ $v->id }}')" href="javascript:;">删除</a></th>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
	<script type="text/javascript">
      /*购物车-删除*/
      function member_del(obj,id){
      		let token = $(obj).attr('token');
      		$.ajaxSetup({headers: {'X-CSRF-TOKEN': token}});
			if(!window.confirm('你确定要删除吗?')){
				return false;
			}
      	  // 发送ajax删除
      	  $.post('/home/mycar/destroy',{id:id,_method:"DELETE"},function(res){
      	  	if(res == 'ok'){
				// 删除tr节点
				alert('已成功删除');
				window.location.href = window.location.href;
			}else{
				alert('删除失败')
			}
      	  },'html')
              
        };

        
  		//全选
            //两个函数的绑定 
            var i=0;
            //全选
            $("#inp").on("click",function(){
                if(i==0){
                    //把所有复选框选中
                    $(".inp[type=checkbox]").prop("checked", true);
                    i=1;
                }else{
                    $(".inp[type=checkbox]").prop("checked", false);
                    i=0;
                }
                
            });

        $(function() {
            $(".inp").click(
                function() {
                    var total_price=parseInt($("#total_price").text());
                    var price=parseInt($("#price").text());
                    var mynum=parseInt($("#mynum").text());
                    if($(this).is(':checked')){
                        total_price+=price;
                        mynum += 1;
                    }else{
                        total_price-=price;
                        mynum -= 1;
                    }
                    
                    $("#total_price").text(total_price);
                    $("#mynum").text(mynum);
                }
            );
            $(".red").each(function(){
                $(this).attr("checked",false);
            });
        });

</script>
	<div style="height:10px"></div>
	<div class="center">
		<div class="clearfix pc-shop-go">
			<div class="fr pc-shop-fr">
				<p>共有 <em class="red pc-shop-shu" id="mynum">0</em> 款商品，总计（不含运费）</p>
				<span>元<span id="total_price">0</span></span>
				<a href="/home/order">去付款</a>
			</div>
		</div>
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
						<div class="fl lss-img"><img src="img/icon/code.png" alt=""></div>
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
<script type="text/javascript">
    //hover 触发两个事件，鼠标移上去和移走
    //mousehover 只触发移上去事件
    $(".top-nav ul li").hover(function(){
        $(this).addClass("hover").siblings().removeClass("hover");
        $(this).find("li .nav a").addClass("hover");
        $(this).find(".con").show();
    },function(){
        //$(this).css("background-color","#f5f5f5");
        $(this).find(".con").hide();
        //$(this).find(".nav a").removeClass("hover");
        $(this).removeClass("hover");
        $(this).find(".nav a").removeClass("hover");
    })
</script>
</body>
</html>
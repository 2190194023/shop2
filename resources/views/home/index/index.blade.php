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
			<div class="pullDown">
				<h2 class="pullDownTitle"><i class="icon-class"></i>所有商品分类</h2>					
					<ul class="pullDownList">
						@foreach($common_title as $k=>$v)
						<li class="">
							<i class="list-icon-1"></i>
							 @foreach($v->sub as $kk=>$vv)
							<a href="/home/list/{{ $vv->id }}" target="_self">{{ $vv->cname }}&nbsp;&nbsp;</a>
							@endforeach
						</li>
						@endforeach
					</ul>
					<!-- 下拉详细列表具体分类 -->		
					<div class="yMenuListCon">
						@foreach($common_title as $k=>$v)	
						<div class="yMenuListConin">				
							<div class="yMenuLCinList">						
								 @foreach($v->sub as $kk=>$vv)
								<h3><a href="/home/list/{{ $vv->id }}" class="yListName" target="_self">{{ $vv->cname }}</a></h3>									
								<p>							
									@foreach($vv->sub as $kkk=>$vvv)
									<a href="/home/list/{{ $vvv->id }}" class="ecolor610" target="_self">{{ $vvv->cname }}</a>
									@endforeach							
								</p>
								@endforeach
							</div>
						</div>
						@endforeach
					</div>									
			</div>
			<ul class="yMenuIndex">
				<li><a href="/" target="_self">首页</a></li>
				@foreach($common_title as $k=>$v)
				<li><a href="/home/list/{{ $v->id }}" target="_self">{{ $v->cname }}</a></li>
				@endforeach
			</ul>
		</div>
		<!-- 导航   end  -->
	</div>
	<!--  顶部    end-->

	<!-- banner  -->
	<div class="yBanner">
		<div class="yBannerList">
			<div class="yBannerListIn">

				<div class="pi">

<div class="pike">
	@foreach($slideshow as $k=>$v)

<div>
<img src="/uploads/{{ $v->surl }}" alt="" style="width:820px;height:505px;">
</div>
	@endforeach
</div>

<div class="pike_prev"></div>

<div class="pike_next"></div>

<div class="pike_spot"></div>
</div>
<br>

<script src="https://www.jq22.com/jquery/jquery-1.10.2.js"></script>
<script src="/home/js/pike.min.js"></script>
<script>
       var myPi = new Pike(".pi", {
          type: 1, // 轮播的类型(1渐隐)
          automatic: true, //是否自动轮播 (默认false)
          autoplay: 2000, //自动轮播毫秒 (默认3000)
          hover: true, //鼠标悬停轮播 (默认false)
          arrowColor: "yellow", //箭头颜色 (默认绿色)
          arrowBackgroundType: 2, //箭头背景类型 (1: 方形, 2:圆形)
          arrowBackground: 1, //箭头背景色 (1:白色,2:黑色, 默认:无颜色)
          arrowTransparent: 0.2, //箭头背景透明度 (默认: 0.5)
          spotColor: "white",//圆点颜色 (默认: 白色)
          spotType: 1, //圆点的形状 (默认: 圆形, 1:圆形, 2.矩形)
          spotSelectColor: "red", //圆点选中颜色 (默认绿色)
          spotTransparent: 0.8, //圆点透明度 (默认0.8)
          mousewheel: false, //是否开启鼠标滚动轮播(默认false)
          drag: false, //是否开启鼠标拖动 (默认为: true, 如不需要拖动设置false即可)
          loop: true, //是否循环轮播 (默认为: false)
       });
    </script>

<style>
    body{background-color: #EBEBEB}
    .pi {
      width: 820px;
      height:505px;
      margin:0px 0px;
    }

    </style>

				<div class="yBannerListInRight">
					@foreach($guang as $k=>$v)
					<a href="{{ $v->furl }}"><img src="/uploads/{{ $v->surl }}" value="{{ $v->title}}" width="100%"/></a>
					@endforeach

				</div>
			</div>
		</div>

	<!-- banner end -->
</header>
<section id="">
	<div class="center pc-ad-img clearfix">
		@foreach($goods as $k=>$v)
		<div class="pc-center-img"><a href="/home/page/{{ $v->id }}"><img src="/uploads/{{ $v->url }}"></a></div>
		@endforeach
	</div>
</section>
<section id="s">
	<!-- 秒杀 start -->
	<div class="center">
		<div class="pc-center-he">
			<div class="pc-box-he clearfix">
				<div class="fl"><span style="font-size:20;color:#fff;">今日秒杀</span></div>
				<div class="time-item fr">
					<strong id="hour_show">0时</strong>
					<strong id="minute_show">00分</strong>
					<strong id="second_show">00秒</strong>
					<em style="color:#fff">后结束抢购</em>
				</div>
			</div>
			<div class="pc-list-goods">
				<div class="flashSale_wrap">
					<div class="flashSale area">
						<div class="tab-content">
							<div class="tab-pane active">
								<div class="flashSaleDeals">
									<div class="v_cont" style="width:9648px;overflow: hidden">
										<ul class="flder">
											<li index="0">
											@foreach ($miaosha as $k=>$v)
												<div class="xsq_deal_wrapper">
													<a class="saleDeal" href="/home/page/{{ $v['id'] }}" target="_self">
														<div class="dealCon">
															<img class="dealImg" src="/uploads/{{ $v['url'] }}" alt="">
															<div class="zt2Qrcode overlay">
																<div class="xsqMask"></div>
																<p class="word1">15:00开抢</p>
																<p class="word2">限100件，抢完恢复25.8元</p>
																<p class="word3">查看商品&gt;&gt;</p>
															</div>
															<!--<span class="soldOut xsqIcon"></span>-->
														</div>
														<div class="title_new">

															<p class="word" title="{{ $v['gdescr'] }}">{{ $v['gname'] }}</p>
														</div>
														<div class="dealInfo">
															<span class="price"><strike>￥{{ $v['gprice'] }}</strike><em>{{ $miao[$k]->maney }}</em></span>

															<span class="shop_preferential">数量:{{ $miao[$k]->mouse}}</span>
														</div>
													</a>
												</div>
												
											@endforeach
										</li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>@php 
			use App\Models\Goods;
			@endphp
	@foreach ($huodong as $k=>$v)
	<div class="center pc-top-20">
		<div class="pc-center-he">
			<div class="pc-box-he pc-box-blue clearfix">
				<div class="fl"><span style="font-size:20;color:#fff;">活动商品</span></div>
				<div class="fr pc-box-blue-link">
					<a href="#">{{$v->zhekou }}折商品</a>					
				</div>
			</div>
			<div class="pc-list-goods">
				<div class="xsq_deal_wrapper pc-deal-list clearfix">
					@php $goods = Goods::where('pid',$v->id)->paginate(6);@endphp

					@foreach($goods as $kk=>$vv)
					<a class="saleDeal" href="/home/page/{{ $vv->id }}" target="_self">
						<div class="dealCon"><img class="dealImg" src="/uploads/{{ $vv->url }}" alt=""></div>
						<div class="title_new"><p class="word" title="{{ $vv->gdescr }}"><span class="baoyouText"></span>{{ $vv->gname }}</p></div>
						<div class="dealInfo"><span class="price">¥<em>{{ $vv->gprice }}</em></span>{{ $v->zhekou }}折</div>
					</a>
					@endforeach
				</div>
			</div>
		</div>
	</div>
	@endforeach
	
	<div class="center pc-top-20">
		<div class="pc-center-he">
			<div class="pc-box-he pc-box-ue clearfix">
				<div class="fl"><span style="font-size:20;color:#fff;">猜你喜欢</span></div>
				
			</div>
			<div class="pc-list-goods" style="height:auto">
				
					@foreach($goodss as $k=>$v)
					<a class="saleDeal" href="/home/page/{{ $v->id }}" target="_self">
						<div class="dealCon"><img class="dealImg" src="/uploads/{{ $v->url }}" alt=""></div>
						<div class="title_new"><p class="word" title="{{ $v->gdescr }}"><span class="baoyouText">[包邮]</span>{{ $v->gname }}</p></div>
						<div class="dealInfo"><span class="price">¥<em>{{ $v->gprice }}</em></span></div>
					</a>
					@endforeach
			</div>
		</div>
	</div>
</section>

<div style="height:100px"></div>

@extends('home.public.footer')
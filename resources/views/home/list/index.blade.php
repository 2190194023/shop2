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
                <li style="background:#d1201e"><a href="/" target="_blank">云购首页</a></li>
                @foreach($cate_data as $k=>$v)
                <li><a href="/home/list/{{ $v->id }}" target="_blank">{{ $v->cname }}</a></li>
                @endforeach
            </ul>
        </div>
        <!-- 导航   end  -->
    </div>


</header>



<div class="center" style="background:#fff;">
	<div style="padding:20px">
		<div class="containers clearfix"><div class="pc-nav-item fl"><a href="#" class="pc-title">首页</a> &gt;<a href="#"> 所有货架</a></div> <div class="fr" style="padding-top:20px;"><a href="/home/list" class="reds">所有品牌&gt;</a></div></div>
		<div class="containers">
			<div class="pc-nav-rack clearfix">
				<ul>
					@foreach($cate_res as $k=>$v)
					<li><a href="/home/list/{{ $v->id }}">{{ $v->cname }}</a></li>
					@endforeach
				</ul>
			</div>
			<div>
				<div class="pc-nav-title"><h3>
                    @if(isset($cname->cname))
                        {{ $cname->cname }}
                    @else
                        全部商品
                    @endif
                </h3></div>
				<div class="pc-nav-digit clearfix">
					<ul>
						@foreach($goods_data as $k=>$v)
						<li>
							<div class="digit1"><a href="/home/page/{{ $v->id }}"><img src="/uploads/{{ $v->url }}" width="100%"></a></div>
							<div class="digit2"><a href="#">{{ $v->gname }}</a></div>
						</li>
						@endforeach
						
					</ul>
				</div>
			</div>
			<div style="padding-top:30px;">
				<div class="member-pages clearfix">
					<div class="pull-right">
				            <!-- 显示页码 -->
				            {{ $goods_data->links() }}
				    </div>
				</div>
			</div>
		</div>

	</div>
</div>


<div style="height:100px"></div>
<style type="text/css">
        #pull_right{
            text-align:center;
        }
        .pull-right {
            float: right!important;
        }
        .pagination {
            display: inline-block;
            padding-left: 0;
            margin: 20px 0;
            border-radius: 4px;
        }
        .pagination > li {
            display: inline;
        }
        .pagination > li > a,
        .pagination > li > span {
            position: relative;
            float: left;
            padding: 6px 12px;
            margin-left: -1px;
            line-height: 1.42857143;
            color: #428bca;
            text-decoration: none;
            background-color: #fff;
            border: 1px solid #ddd;
        }
        .pagination > li:first-child > a,
        .pagination > li:first-child > span {
            margin-left: 0;
            border-top-left-radius: 4px;
            border-bottom-left-radius: 4px;
        }
        .pagination > li:last-child > a,
        .pagination > li:last-child > span {
            border-top-right-radius: 4px;
            border-bottom-right-radius: 4px;
        }
        .pagination > li > a:hover,
        .pagination > li > span:hover,
        .pagination > li > a:focus,
        .pagination > li > span:focus {
            color: #2a6496;
            background-color: #eee;
            border-color: #ddd;
        }
        .pagination > .active > a,
        .pagination > .active > span,
        .pagination > .active > a:hover,
        .pagination > .active > span:hover,
        .pagination > .active > a:focus,
        .pagination > .active > span:focus {
            z-index: 2;
            color: #fff;
            cursor: default;
            background-color: #428bca;
            border-color: #428bca;
        }
        .pagination > .disabled > span,
        .pagination > .disabled > span:hover,
        .pagination > .disabled > span:focus,
        .pagination > .disabled > a,
        .pagination > .disabled > a:hover,
        .pagination > .disabled > a:focus {
            color: #777;
            cursor: not-allowed;
            background-color: #fff;
            border-color: #ddd;
        }
        .clear{
            clear: both;
        }
    </style>
@extends('home.public.footer')
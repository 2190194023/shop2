@extends('home.public.header')


<script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
	<script type="text/javascript">

        $(document).ready(function(){
            var $miaobian=$('.Xcontent08>div');
            var $huantu=$('.Xcontent06>img');
            var $miaobian1=$('.Xcontent26>div');
            $miaobian.mousemove(function(){miaobian(this);});
            $miaobian1.click(function(){miaobian1(this);});
            function miaobian(thisMb){
                for(var i=0; i<$miaobian.length; i++){
                    $miaobian[i].style.borderColor = '#dedede';
                }
                thisMb.style.borderColor = '#cd2426';

                $huantu[0].src = thisMb.children[0].src;
            }
            function miaobian1(thisMb1){
                for(var i=0; i<$miaobian1.length; i++){
                    $miaobian1[i].style.borderColor = '#dedede';
                }
//		thisMb.style.borderColor = '#cd2426';
                $miaobian.css('border-color','#dedede');
                thisMb1.style.borderColor = '#cd2426';
                $huantu[0].src = thisMb1.children[0].src;
            }
            var $alink = $('#ak').attr('href');
            $(".Xcontent33").click(function(){
            	var $num = $(".input").val();
            	if($num< {{ $goods['gtock'] }} ){
					var value=parseInt($('.input').val())+1;
		            $('.input').val(value);

		            var $num = $(".input").val();
			    	$alk = $alink+'/'+$num;
			    	$("#ak").attr("href",$alk); 
            	}
               
            })

            $(".Xcontent32").click(function(){
                var $num = $(".input").val()
                if($num>0){
                    $(".input").val($num-1);

                    var $num = $(".input").val();
			    	$alk = $alink+'/'+$num;
			    	$("#ak").attr("href",$alk);
                }

            })    

    	var $alink = $('#ak').attr('href');
    	var $num = $(".input").val();
    	$alk = $alink+'/'+$num;
    	$("#ak").attr("href",$alk);

        })
	</script>
	<style>
		.li-ul-ss l{
			width:200px;
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

<div class="Xcontent">
	<ul class="Xcontent01">

		<div class="Xcontent06"><img src="/uploads/{{ $goods['url'] }}"></div>
		<ol class="Xcontent08">
			@foreach($gimg as $k=>$v)
			<div class="Xcontent07"><img src="/uploads/{{ $v->lujing }}"></div>
			@endforeach
		</ol>
		<ol class="Xcontent13 clearfix">
			<div class="Xcontent14 clearfix"><a href="#"><p>{{ $goods['gname'] }}</p></a></div>
			<div class="Xcontent15 clearfix red fl" style="margin-top:2px">@if($goods['gstatus'] == 1)<td> 新上架</td>@elseif($goods['gstatus'] == 2)<td>在售</td>@else<td>下线</td>@endif</div>
			<div class="Xcontent17">
				<p class="Xcontent18">售价</p>
				<p class="Xcontent19">￥<span>{{ $goods['gprice'] }}</span></p>
				<div class="Xcontent20">
					<p class="Xcontent21">库存</p>
					<p class="Xcontent22">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $goods['gtock'] }}</p>
				</div>
				<div class="Xcontent23">
					<p class="Xcontent24">服务</p>
					<p class="Xcontent25">30天无忧退货&nbsp;&nbsp;&nbsp;&nbsp;       48小时快速退款 &nbsp;&nbsp;&nbsp;&nbsp;        满88元免邮</p>
				</div>
			</div>
			<div class="Xcontent26">
				<p class="Xcontent27">型号</p>
				<div class="Xcontent28"><img  src="/uploads/{{ $goods['url'] }}"></div>
			</div>
			<div class="Xcontent30">
				<p class="Xcontent31">数量</p>
				<div class="Xcontent32"><img src="/home/images/shangpinxiangqing/X15.png"></div>
				<form>
					<input class="input" name="num" value="1" disabled></form>
				<div class="Xcontent33"><img src="/home/images/shangpinxiangqing/16.png"></div>

			</div>
			<div class="Xcontent34"><a href="#">立即购买</a></div>
			<div class="Xcontent35">
				@if($goods['gstatus'] == 1)
					<a id="ak" href="/home/mycar/{{ $goods['id'] }}">加入购物车</a>
				@elseif($goods['gstatus'] == 2)
					<a id="ak" href="/home/mycar/{{ $goods['id'] }}">加入购物车</a>
				@else
					<a href="javascript:;">加入购物车</a>
				@endif
			</div>

		</ol>



	</ul>
</div>
<div class="center" style="background:#fff">
	<div class="tabox">
		<div class="hd">
			<ul class="li-ul-ss">
				<li class=" ">猜您喜欢</li>
			</ul>
		</div>
		<div class="bd">
			
			<ul class="lh" style="display: block;">
				@foreach($goods_data as $k=>$v)
				<li>
					<div class="p-img ld">
						<a href="/home/page/{{ $v->id }}">
							<img src="/uploads/{{ $v->url }}"></a>
					</div>
					<div class="p-name">
						<a href="/home/page/{{ $v->id }}">{{ $v->gname }}</a></div>
					<div class="p-price">京东价：
						<strong>￥{{ $v->gprice }}</strong></div>
				</li>
				@endforeach
			</ul>
		</div>
	</div>

</div>
<div class="containers center clearfix" style="margin-top:20px; background:#fff;">
	<div style="padding-left:10px; padding-top:20px2">
		<div class="pc-overall">
			<ul id="H-table1" class="brand-tab H-table1 H-table-shop clearfix ">
				<li class="cur"><a href="javascript:void(0);">商品介绍</a></li>
				<li><a href="#评价">商品评价<em class="reds">({{ $num }})</em></a></li>
			</ul>
			<div class="pc-term clearfix">
				<div class="H-over1 pc-text-word clearfix">
					<div>
						@foreach($gimg as $k=>$v)
						<div style="text-align:center"><img src="/uploads/{{ $v->lujing }}" width="50%"></div>
						@endforeach
					</div>
				</div>
			</div>
		</div>
		<div class="pc-overall">
			<ul class="brand-tab H-table H-table-shop clearfix " id="H-table" style="margin-left:0;">
				<li class="cur"><a href="javascript:void(0);">全部评价（{{ $num }}）</a></li>
			</ul>
			<div class="pc-term clearfix">
				<div class="pc-column">
					<span class="column1">评价心得</span>
					<span class="column2">评论时间</span>
					<span class="column3">购买信息</span>
					<span class="column4">评论者</span>
					<span class="column4">购买时间</span>
				</div>
				<div class="H-over  pc-comments clearfix">
					<a name="评价"></a>
					<ul class="clearfix">
						@php 
                    		use App\Models\Users
                    	@endphp
						@foreach($discuss_data as $k=>$v)
						<li class="clearfix">
							<div class="column1" style="height:100px;width:480px;">
								<p>{!! $v->content !!}</p>
							</div>
							<div class="column2">{{ $v->addtime }}</div>
							<div class="column3"><img src="/uploads/{{ $goods->url }}" width="120px"></div>
							<div class="column4">
								<p style="line-height: 30px;margin:23px;">
									@php
									$x = Users::where('id',$v->uid)->first();
									echo $x->uname;
									@endphp
								</p>
							</div>
							<div>{{ $v->otime }}</div>
						</li>
						@endforeach
					</ul>
				</div>
			</div>
		</div>
		<div style="padding-top:30px;">
				<div class="member-pages clearfix">
					<div class="pull-right">
				            <!-- 显示页码 -->
				            {{ $discuss_data->links() }}
				    </div>
				</div>
			</div>
	</div>
</div>
<div style="height:100px"></div>
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
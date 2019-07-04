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
				<div class="member-heels fl"><h2>我的订单</h2></div>
				<div class="member-backs member-icons fr"><a href="#">搜索</a></div>
				<div class="member-about fr"><input placeholder="订单号" style="margin:8px;" type="text"></div>
			</div>
			<div class="member-border">
				<div class="member-return H-over">
					<div class="member-cancel clearfix">
						<span class="be1">订单信息</span>
						<span class="be2">收货人</span>
						<span class="be2">订单金额</span>
						<span class="be2">快递单号</span>
						<span class="be2">订单状态</span>
						<span class="be2">订单操作</span>
					</div>
					<div class="member-sheet clearfix">
						<ul>
							@php 
								use App\Models\Goods;
							@endphp
							@foreach($order_data as $k=>$v)
							@php
								$goods = Goods::where('id',$v->good)->first();
								$gnum = $v->num * $goods->gprice;
							@endphp
							<li>
								<div class="member-minute clearfix">
									<span>{{ $v->oaddtime }}</span>
									<span>订单号：<em>{{ $v->oid }}</em></span>
									<span class="member-custom">客服电话：<em>10086</em></span>
								</div>
								<div class="member-circle clearfix">
									<div class="ci1">
										<div class="ci7 clearfix">
											<span class="gr1"><a href="/home/page/{{ $goods->id }}"><img src="/uploads/{{ $goods->url }}" title="" about="" width="60" height="60"></a></span>
											<span class="gr2"><a href="/home/page/{{ $goods->id }}">{{ $goods->gname }}</a></span>
											<span class="gr3">X{{ $v->onum }}</span>
										</div>
									</div>
									<div class="ci2">{{ $v->oname }}</div>
									<div class="ci3"><b>￥{{ $v->ototal }}</b><p>在线支付</p><p class="iphone">网页订单</p></div>
									<div class="ci4"><p>{{ $v->kdd }}</p></div>
									<div class="ci5"><p><a href="/home/order/detail/{{ $v->oid }}">订单详情</a></p></div>
									<div class="ci5 ci8">
										@if($v->ostatus == 0)
											<p><a href="javascript:;" onclick="member_stu(this,'{{ $v->id }}','{{ $v->ostatus }}')" token="{{ csrf_token() }}" class="member-touch">立即支付</a> </p> 
										@elseif($v->ostatus == 1)
											<p><a href="javascript:;" onclick="member_stu(this,'{{ $v->id }}','{{ $v->ostatus }}')" token="{{ csrf_token() }}" class="member-touch">确认收货</a> </p> 
											<form action="/home/order/{{ $v->id }}" method="post">
												{{ csrf_field() }}
												<input type="hidden" name="_method" value="DELETE">
											<p><input type="submit" value="取消订单" class="btn"> </p>
											</form>
										@elseif($v->ostatus == 2)
											<p><a href="javascript:;" onclick="member_stu(this,'{{ $v->id }}','{{ $v->ostatus }}')" token="{{ csrf_token() }}">退货</a> </p>
											<p><a href="/home/order/{{ $v->id }}/edit">评论</a> </p>
										@else
											<p><input type="submit" value="已退货" disabled class="btn"> </p>
										@endif
									</div>
								</div>
							</li>
							@endforeach
						</ul>
					</div>
				</div>
				<script type="text/javascript">
					/*订单-状态修改*/
			      function member_stu(obj,id,status){
			      		if(status>=3 || status<0){
			      			alert('无效订单');
							    return true;
			      		}else{
		    				let token = $(obj).attr('token');
		    	      		$.ajaxSetup({headers: {'X-CSRF-TOKEN': token} });
		    	      		$.ajaxSetup({async:false});
	    	      	  // 发送ajax修改状态
	    	      	  $.post('/home/order/update',{id:id,status:status},function(res){
	    	      	  	if(res == "ok"){
	    					window.location.href = window.location.href;
	    					return true;
	    				}else{
	    					return false;
	    				}
	    	      	  },'html')
	          		}
		        };
		        /*订单-删除*/
		      function member_del(obj,id){
		      		let token = $(obj).attr('token');
		      		$.ajaxSetup({headers: {'X-CSRF-TOKEN': token}});
					if(!window.confirm('你确定要删除吗?')){
						return false;
					}
		      	  // 发送ajax删除
		      	  $.post('/home/order/del',{id:id},function(res){
		      	  	if(res == 'ok'){
						// 刷新页面
		                alert('订单已取消');
						window.location.href = window.location.href;
					}else{
						alert('服务器崩溃了,请稍后...');
					}
		      	  },'html')
		              
		        };
				</script>
				

				<div style="padding-top:30px;">
				<div class="member-pages clearfix">
					<div class="pull-right">
				            <!-- 显示页码 -->
				            {{ $order_data->links() }}
				    </div>
				</div>
			</div>

			</div>
		</div>
	</div>
</section>


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
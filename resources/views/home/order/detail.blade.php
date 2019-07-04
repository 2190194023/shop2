@extends('home.public.header')
<body>

<header id="pc-header">
	<div class="pc-header-nav">
		<div class="pc-header-con">
			<div class="fl pc-header-link" >您好！，欢迎来云购物 <a href="login.html" target="_blank">请登录</a> <a href="register.html" target="_blank"> 免费注册</a></div>
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
					<li><a href="#">会员中心</a></li>
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
			<a href="#">我的购物车</a>
			<em>10</em>
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
				<div class="fl"><a href="#"><img src="img/mem.png"></a></div>
				<div class="fl">
					<p>用户名：</p>
					<p><a href="#">亚里士多德</a></p>
					<p>搜悦号：</p>
					<p>389323080</p>
				</div>
			</div>
			<div class="member-lists">
				<dl>
					<dt>我的商城</dt>
					<dd class="cur"><a href="#">我的订单</a></dd>
					<dd><a href="#">我的收藏</a></dd>
					<dd><a href="#">账户安全</a></dd>
					<dd><a href="#">我的评价</a></dd>
					<dd><a href="#">地址管理</a></dd>
				</dl>
				<dl>
					<dt>客户服务</dt>
					<dd><a href="#">退货申请</a></dd>
					<dd><a href="#">退货/退款记录</a></dd>
				</dl>
				<dl>
					<dt>我的消息</dt>
					<dd><a href="#">商城快讯</a></dd>
					<dd><a href="#">帮助中心</a></dd>
				</dl>
			</div>
		</div>
		<div class="member-right fr">
			<div class="member-head">
				<div class="member-heels fl"><h2>评论商品</h2></div>
			</div>
			<div class="member-border">
				<div class="member-return H-over">
					<form action="/home/order" method="get" enctype="multipart/form-data">
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
						<table style="font-size: 17px;font-family: '楷体';text-align: center;">
							<tr>
								<th>订单号</th>
								<th>用户名</th>
								<th>商品名称</th>
								<th>商品图片</th>
								<th>单价</th>
								<th>总价</th>
								<th>下单时间</th>
								<th>订单操作</th>
							</tr>
							<tr>
								<td>{{ $detail->oid }}</td>
								<td>{{ $uname->uname }}</td>
								<td><a href="/home/page/{{ $goods->id }}">{{ $goods->gname }}</a></td>
								<td><a href="/home/page/{{ $goods->id }}"><img src="/uploads/{{ $goods->url }}" width="100px" title="{{ $goods->gname }}"></a></td>
								<td>{{ $detail->qian }}</td>
								<td>{{ $detail->hou }}</td>
								<td>{{ $detail->otime }}</td>
								<td>
									@if($order->ostatus == 0)
										<p><a href="javascript:;" onclick="member_stu(this,'{{ $order->id }}','{{ $order->ostatus }}')" token="{{ csrf_token() }}" class="member-touch">立即支付</a> </p> 
									@elseif($order->ostatus == 1)
										<p><a href="javascript:;" onclick="member_stu(this,'{{ $order->id }}','{{ $order->ostatus }}')" token="{{ csrf_token() }}" class="member-touch">确认收货</a> </p>
									@elseif($order->ostatus == 2)
										<p><a href="javascript:;" onclick="member_stu(this,'{{ $order->id }}','{{ $order->ostatus }}')" token="{{ csrf_token() }}">退货</a> </p>
										<p><a href="/home/order/{{ $order->id }}/edit">评论</a> </p>
									@else
										<p><input type="submit" value="已退货" disabled class="btn"> </p>
									@endif
								</td>
							</tr>
						</table>
					</form>
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
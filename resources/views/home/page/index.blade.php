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
            $(".Xcontent33").click(function(){
                var value=parseInt($('.input').val())+1;
                $('.input').val(value);
            })

            $(".Xcontent32").click(function(){
                var num = $(".input").val()
                if(num>0){
                    $(".input").val(num-1);
                }

            })

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
				<a href="index.html"></a>
			</h1>
		</div>
		<div class="head-form fl">
			<form class="clearfix">
				<input class="search-text" accesskey="" id="key" autocomplete="off" placeholder="洗衣机" type="text">
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
					<input class="input" value="1"></form>
				<div class="Xcontent33"><img src="/home/images/shangpinxiangqing/16.png"></div>

			</div>
			<div class="Xcontent34"><a href="#">立即购买</a></div>
			<div class="Xcontent35"><a href="#">加入购物车</a></div>

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
	<div class="fl" style="padding-left:10px; padding-top:20px">
		<div class="menu_list" id="firstpane">
			<h2>栏目分类</h2>
			@foreach($cates_data as $k=>$v)
			<h3 class="menu_head current"><a href="/home/list/{{ $v->id }}">{{ $v->cname }}</a></h3>
			@endforeach
		</div>
	</div syu>
	<div class="pc-info fr" style="padding-left:10px; padding-top:20px">
		<div class="pc-overall">
			<ul id="H-table1" class="brand-tab H-table1 H-table-shop clearfix ">
				<li class="cur"><a href="javascript:void(0);">商品介绍</a></li>
				<li><a href="javascript:void(0);">商品评价<em class="reds">(91)</em></a></li>
				<li><a href="javascript:void(0);">售后保障</a></li>
			</ul>
			<div class="pc-term clearfix">
				<div class="H-over1 pc-text-word clearfix">
					<ul class="clearfix">
						<li>
							<p>屏幕尺寸：4.8英寸</p>
							<p>分辨率：1280×720(HD,720P) </p>
						</li>
						<li>
							<p>后置摄像头：800万像素</p>
							<p>分辨率：1280×720(HD,720P) </p>
						</li>
						<li>
							<p>前置摄像头：190万像素</p>
							<p>分辨率：1280×720(HD,720P) </p>
						</li>
						<li>
							<p>3G：电信(CDMA2000)</p>
							<p>2G：移动/联通(GSM)/电信(CDMA </p>
						</li>
					</ul>
					<div class="pc-line"></div>
					<ul class="clearfix">
						<li>
							<p>商品名称：三星I939I</p>
							<p>商品毛重：360.00g </p>
						</li>
						<li>
							<p>商品编号：1089266</p>
							<p>商品产地：中国大陆</p>
						</li>
						<li>
							<p>品牌： 三星（SAMSUNG）</p>
							<p>系统：安卓（Android </p>
						</li>
						<li>
							<p>上架时间：2015-03-30 09:07:18</p>
							<p>机身颜色：白色</p>
						</li>
					</ul>
					<div>
						<div style="text-align:center"><img src="images/shangpinxiangqing/X1.png" width="50%"></div>
						<div style="text-align:center"><img src="images/shangpinxiangqing/X2.png" width="50%"></div>
						<div style="text-align:center"><img src="images/shangpinxiangqing/X3.png" width="50%"></div>
						<div style="text-align:center"><img src="images/shangpinxiangqing/X1.png" width="50%"></div>
					</div>
				</div>
				<div class="H-over1" style="display:none">
					<div class="pc-comment fl"><strong>86<span>%</span></strong><br> <span>好评度</span></div>
					<div class="pc-percent fl">
						<dl>
							<dt>好评<span>(86%)</span></dt>
							<dd><div style="width:86px"></div></dd>
						</dl>
						<dl>
							<dt>中评<span>(86%)</span></dt>
							<dd><div style="width:86px"></div></dd>
						</dl>
						<dl>
							<dt>好评<span>(86%)</span></dt>
							<dd><div style="width:86px"></div></dd>
						</dl>
					</div>
				</div>
				<div class="H-over1 pc-text-title" style="display:none">
					<p>本产品全国联保，享受三包服务，质保期为：一年质保
						如因质量问题或故障，凭厂商维修中心或特约维修点的质量检测证明，享受7日内退货，15日内换货，15日以上在质保期内享受免费保修等三包服务！
						(注:如厂家在商品介绍中有售后保障的说明,则此商品按照厂家说明执行售后保障服务。) 您可以查询本品牌在各地售后服务中心的联系方式，请点击这儿查询......</p>
					<div class="pc-line"></div>
				</div>
			</div>
		</div>
		<div class="pc-overall">
			<ul class="brand-tab H-table H-table-shop clearfix " id="H-table" style="margin-left:0;">
				<li class="cur"><a href="javascript:void(0);">全部评价（199）</a></li>
				<li><a href="javascript:void(0);">好评<em class="reds">（33）</em></a></li>
				<li><a href="javascript:void(0);">中评<em class="reds">（02）</em></a></li>
				<li><a href="javascript:void(0);">差评<em class="reds">（01）</em></a></li>
			</ul>
			<div class="pc-term clearfix">
				<div class="pc-column">
					<span class="column1">评价心得</span>
					<span class="column2">顾客满意度</span>
					<span class="column3">购买信息</span>
					<span class="column4">评论者</span>
				</div>
				<div class="H-over  pc-comments clearfix">
					<ul class="clearfix">
						<li class="clearfix">
							<div class="column1">
								<p class="clearfix"><a href="#">回复<em>（90）</em></a> <a href="#">赞<em>（90）</em></a> </p>
								<p>一次用三星，不是很顺手，但咨询客服后终于上手了，感觉性价比相当不错，值得购买。但最想说的是京东客服更好，产品信得过，正品行货，买的放心。</p>
								<p class="column5">2014-11-25 14:32</p>
							</div>
							<div class="column2"><img src="img/icon/star.png"></div>
							<div class="column3">颜色：云石白</div>
							<div class="column4">
								<p><img src="img/icon/user.png"></p>
								<p>2014-11-23 22:37 购买</p>
							</div>
						</li>
						<li class="clearfix">
							<div class="column1">
								<p class="clearfix"><a href="#">回复<em>（90）</em></a> <a href="#">赞<em>（90）</em></a> </p>
								<p>一次用三星，不是很顺手，但咨询客服后终于上手了，感觉性价比相当不错，值得购买。但最想说的是京东客服更好，产品信得过，正品行货，买的放心。</p>
								<p class="column5">2014-11-25 14:32</p>
							</div>
							<div class="column2"><img src="img/icon/star.png"></div>
							<div class="column3">颜色：云石白</div>
							<div class="column4">
								<p><img src="img/icon/user.png"></p>
								<p>2014-11-23 22:37 购买</p>
							</div>
						</li>
						<li class="clearfix">
							<div class="column1">
								<p class="clearfix"><a href="#">回复<em>（90）</em></a> <a href="#">赞<em>（90）</em></a> </p>
								<p>一次用三星，不是很顺手，但咨询客服后终于上手了，感觉性价比相当不错，值得购买。但最想说的是京东客服更好，产品信得过，正品行货，买的放心。</p>
								<p class="column5">2014-11-25 14:32</p>
							</div>
							<div class="column2"><img src="img/icon/star.png"></div>
							<div class="column3">颜色：云石白</div>
							<div class="column4">
								<p><img src="img/icon/user.png"></p>
								<p>2014-11-23 22:37 购买</p>
							</div>
						</li>
						<li class="clearfix">
							<div class="column1">
								<p class="clearfix"><a href="#">回复<em>（90）</em></a> <a href="#">赞<em>（90）</em></a> </p>
								<p>一次用三星，不是很顺手，但咨询客服后终于上手了，感觉性价比相当不错，值得购买。但最想说的是京东客服更好，产品信得过，正品行货，买的放心。</p>
								<p class="column5">2014-11-25 14:32</p>
							</div>
							<div class="column2"><img src="img/icon/star.png"></div>
							<div class="column3">颜色：云石白</div>
							<div class="column4">
								<p><img src="img/icon/user.png"></p>
								<p>2014-11-23 22:37 购买</p>
							</div>
						</li>
						<li class="clearfix">
							<div class="column1">
								<p class="clearfix"><a href="#">回复<em>（90）</em></a> <a href="#">赞<em>（90）</em></a> </p>
								<p>一次用三星，不是很顺手，但咨询客服后终于上手了，感觉性价比相当不错，值得购买。但最想说的是京东客服更好，产品信得过，正品行货，买的放心。</p>
								<p class="column5">2014-11-25 14:32</p>
							</div>
							<div class="column2"><img src="img/icon/star.png"></div>
							<div class="column3">颜色：云石白</div>
							<div class="column4">
								<p><img src="img/icon/user.png"></p>
								<p>2014-11-23 22:37 购买</p>
							</div>
						</li>
						<li class="clearfix">
							<div class="column1">
								<p class="clearfix"><a href="#">回复<em>（90）</em></a> <a href="#">赞<em>（90）</em></a> </p>
								<p>一次用三星，不是很顺手，但咨询客服后终于上手了，感觉性价比相当不错，值得购买。但最想说的是京东客服更好，产品信得过，正品行货，买的放心。</p>
								<p class="column5">2014-11-25 14:32</p>
							</div>
							<div class="column2"><img src="img/icon/star.png"></div>
							<div class="column3">颜色：云石白</div>
							<div class="column4">
								<p><img src="img/icon/user.png"></p>
								<p>2014-11-23 22:37 购买</p>
							</div>
						</li>
					</ul>
				</div>
				<div style="display:none" class="H-over pc-comments">
					<ul class="clearfix">
						<li class="clearfix">
							<div class="column1">
								<p class="clearfix"><a href="#">回复<em>（90）</em></a> <a href="#">赞<em>（90）</em></a> </p>
								<p>一次用三星，不是很顺手，但咨询客服后终于上手了，感觉性价比相当不错，值得购买。但最想说的是京东客服更好，产品信得过，正品行货，买的放心。</p>
								<p class="column5">2014-11-25 14:32</p>
							</div>
							<div class="column2"><img src="img/icon/star.png"></div>
							<div class="column3">颜色：云石白</div>
							<div class="column4">
								<p><img src="img/icon/user.png"></p>
								<p>2014-11-23 22:37 购买</p>
							</div>
						</li>
						<li class="clearfix">
							<div class="column1">
								<p class="clearfix"><a href="#">回复<em>（90）</em></a> <a href="#">赞<em>（90）</em></a> </p>
								<p>一次用三星，不是很顺手，但咨询客服后终于上手了，感觉性价比相当不错，值得购买。但最想说的是京东客服更好，产品信得过，正品行货，买的放心。</p>
								<p class="column5">2014-11-25 14:32</p>
							</div>
							<div class="column2"><img src="img/icon/star.png"></div>
							<div class="column3">颜色：云石白</div>
							<div class="column4">
								<p><img src="img/icon/user.png"></p>
								<p>2014-11-23 22:37 购买</p>
							</div>
						</li>
						<li class="clearfix">
							<div class="column1">
								<p class="clearfix"><a href="#">回复<em>（90）</em></a> <a href="#">赞<em>（90）</em></a> </p>
								<p>一次用三星，不是很顺手，但咨询客服后终于上手了，感觉性价比相当不错，值得购买。但最想说的是京东客服更好，产品信得过，正品行货，买的放心。</p>
								<p class="column5">2014-11-25 14:32</p>
							</div>
							<div class="column2"><img src="img/icon/star.png"></div>
							<div class="column3">颜色：云石白</div>
							<div class="column4">
								<p><img src="img/icon/user.png"></p>
								<p>2014-11-23 22:37 购买</p>
							</div>
						</li>
						<li class="clearfix">
							<div class="column1">
								<p class="clearfix"><a href="#">回复<em>（90）</em></a> <a href="#">赞<em>（90）</em></a> </p>
								<p>一次用三星，不是很顺手，但咨询客服后终于上手了，感觉性价比相当不错，值得购买。但最想说的是京东客服更好，产品信得过，正品行货，买的放心。</p>
								<p class="column5">2014-11-25 14:32</p>
							</div>
							<div class="column2"><img src="img/icon/star.png"></div>
							<div class="column3">颜色：云石白</div>
							<div class="column4">
								<p><img src="img/icon/user.png"></p>
								<p>2014-11-23 22:37 购买</p>
							</div>
						</li>
						<li class="clearfix">
							<div class="column1">
								<p class="clearfix"><a href="#">回复<em>（90）</em></a> <a href="#">赞<em>（90）</em></a> </p>
								<p>一次用三星，不是很顺手，但咨询客服后终于上手了，感觉性价比相当不错，值得购买。但最想说的是京东客服更好，产品信得过，正品行货，买的放心。</p>
								<p class="column5">2014-11-25 14:32</p>
							</div>
							<div class="column2"><img src="img/icon/star.png"></div>
							<div class="column3">颜色：云石白</div>
							<div class="column4">
								<p><img src="img/icon/user.png"></p>
								<p>2014-11-23 22:37 购买</p>
							</div>
						</li>
						<li class="clearfix">
							<div class="column1">
								<p class="clearfix"><a href="#">回复<em>（90）</em></a> <a href="#">赞<em>（90）</em></a> </p>
								<p>一次用三星，不是很顺手，但咨询客服后终于上手了，感觉性价比相当不错，值得购买。但最想说的是京东客服更好，产品信得过，正品行货，买的放心。</p>
								<p class="column5">2014-11-25 14:32</p>
							</div>
							<div class="column2"><img src="img/icon/star.png"></div>
							<div class="column3">颜色：云石白</div>
							<div class="column4">
								<p><img src="img/icon/user.png"></p>
								<p>2014-11-23 22:37 购买</p>
							</div>
						</li>
					</ul>
				</div>
				<div style="display:none" class="H-over pc-comments">
					<ul class="clearfix">
						<li class="clearfix">
							<div class="column1">
								<p class="clearfix"><a href="#">回复<em>（90）</em></a> <a href="#">赞<em>（90）</em></a> </p>
								<p>一次用三星，不是很顺手，但咨询客服后终于上手了，感觉性价比相当不错，值得购买。但最想说的是京东客服更好，产品信得过，正品行货，买的放心。</p>
								<p class="column5">2014-11-25 14:32</p>
							</div>
							<div class="column2"><img src="img/icon/star.png"></div>
							<div class="column3">颜色：云石白</div>
							<div class="column4">
								<p><img src="img/icon/user.png"></p>
								<p>2014-11-23 22:37 购买</p>
							</div>
						</li>
						<li class="clearfix">
							<div class="column1">
								<p class="clearfix"><a href="#">回复<em>（90）</em></a> <a href="#">赞<em>（90）</em></a> </p>
								<p>一次用三星，不是很顺手，但咨询客服后终于上手了，感觉性价比相当不错，值得购买。但最想说的是京东客服更好，产品信得过，正品行货，买的放心。</p>
								<p class="column5">2014-11-25 14:32</p>
							</div>
							<div class="column2"><img src="img/icon/star.png"></div>
							<div class="column3">颜色：云石白</div>
							<div class="column4">
								<p><img src="img/icon/user.png"></p>
								<p>2014-11-23 22:37 购买</p>
							</div>
						</li>
						<li class="clearfix">
							<div class="column1">
								<p class="clearfix"><a href="#">回复<em>（90）</em></a> <a href="#">赞<em>（90）</em></a> </p>
								<p>一次用三星，不是很顺手，但咨询客服后终于上手了，感觉性价比相当不错，值得购买。但最想说的是京东客服更好，产品信得过，正品行货，买的放心。</p>
								<p class="column5">2014-11-25 14:32</p>
							</div>
							<div class="column2"><img src="img/icon/star.png"></div>
							<div class="column3">颜色：云石白</div>
							<div class="column4">
								<p><img src="img/icon/user.png"></p>
								<p>2014-11-23 22:37 购买</p>
							</div>
						</li>
						<li class="clearfix">
							<div class="column1">
								<p class="clearfix"><a href="#">回复<em>（90）</em></a> <a href="#">赞<em>（90）</em></a> </p>
								<p>一次用三星，不是很顺手，但咨询客服后终于上手了，感觉性价比相当不错，值得购买。但最想说的是京东客服更好，产品信得过，正品行货，买的放心。</p>
								<p class="column5">2014-11-25 14:32</p>
							</div>
							<div class="column2"><img src="img/icon/star.png"></div>
							<div class="column3">颜色：云石白</div>
							<div class="column4">
								<p><img src="img/icon/user.png"></p>
								<p>2014-11-23 22:37 购买</p>
							</div>
						</li>
						<li class="clearfix">
							<div class="column1">
								<p class="clearfix"><a href="#">回复<em>（90）</em></a> <a href="#">赞<em>（90）</em></a> </p>
								<p>一次用三星，不是很顺手，但咨询客服后终于上手了，感觉性价比相当不错，值得购买。但最想说的是京东客服更好，产品信得过，正品行货，买的放心。</p>
								<p class="column5">2014-11-25 14:32</p>
							</div>
							<div class="column2"><img src="img/icon/star.png"></div>
							<div class="column3">颜色：云石白</div>
							<div class="column4">
								<p><img src="img/icon/user.png"></p>
								<p>2014-11-23 22:37 购买</p>
							</div>
						</li>
						<li class="clearfix">
							<div class="column1">
								<p class="clearfix"><a href="#">回复<em>（90）</em></a> <a href="#">赞<em>（90）</em></a> </p>
								<p>一次用三星，不是很顺手，但咨询客服后终于上手了，感觉性价比相当不错，值得购买。但最想说的是京东客服更好，产品信得过，正品行货，买的放心。</p>
								<p class="column5">2014-11-25 14:32</p>
							</div>
							<div class="column2"><img src="img/icon/star.png"></div>
							<div class="column3">颜色：云石白</div>
							<div class="column4">
								<p><img src="img/icon/user.png"></p>
								<p>2014-11-23 22:37 购买</p>
							</div>
						</li>
					</ul>
				</div>
				<div style="display:none" class="H-over pc-comments">
					<ul class="clearfix">
						<li class="clearfix">
							<div class="column1">
								<p class="clearfix"><a href="#">回复<em>（90）</em></a> <a href="#">赞<em>（90）</em></a> </p>
								<p>一次用三星，不是很顺手，但咨询客服后终于上手了，感觉性价比相当不错，值得购买。但最想说的是京东客服更好，产品信得过，正品行货，买的放心。</p>
								<p class="column5">2014-11-25 14:32</p>
							</div>
							<div class="column2"><img src="img/icon/star.png"></div>
							<div class="column3">颜色：云石白</div>
							<div class="column4">
								<p><img src="img/icon/user.png"></p>
								<p>2014-11-23 22:37 购买</p>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="clearfix">
			<div class="fr pc-search-g pc-search-gs">
				<a href="#" class="fl " style="display:none">上一页</a>
				<a class="current" href="#">1</a>
				<a href="javascript:;">2</a>
				<a href="javascript:;">3</a>
				<a href="javascript:;">4</a>
				<a href="javascript:;">5</a>
				<a href="javascript:;">6</a>
				<a href="javascript:;">7</a>
				<span class="pc-search-di">…</span>
				<a href="javascript:;">1088</a>
				<a href="javascript:;" class="" title="使用方向键右键也可翻到下一页哦！">下一页</a>
			</div>
		</div>
	</div>
</div>
<div style="height:100px"></div>
@extends('home.public.footer')
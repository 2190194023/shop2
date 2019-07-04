<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>注册</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta name="format-detection" content="telephone=no">
	<meta name="renderer" content="webkit">
	<meta http-equiv="Cache-Control" content="no-siteapp" />
	<title>登录.云购物商城</title>
	<link rel="stylesheet" type="text/css" href="/home/css/base.css">
	<link rel="stylesheet" type="text/css" href="/home/css/home.css">
	<link rel="stylesheet" type="text/css" href="/home/css/amazeui.min.css" />
	<link rel="stylesheet" type="text/css" href="/home/css/dlstyle.css"  >

	<script src="/home/js/jquery.min.js"></script>
	<script src="/home/js/amazeui.min.js"></script>
	<link href="https://cdn.bootcss.com/twitter-bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdn.bootcss.com/twitter-bootstrap/3.3.2/js/bootstrap.min.js"></script>
</head>
<body>

<header id="pc-header">
	<div class="center">
		<div class="pc-fl-logo">
			<h1>
				<a href="index.html"></a>
			</h1>
		</div>
	</div>
</header>
<section>
	<div class="pc-login-bj">
		<div class="res-main">
			<div class="login-box">
				<div class="am-tabs" id="doc-my-tabs">
					<ul class="am-tabs-nav am-nav am-nav-tabs am-nav-justify">
						<li class="am-active"><a href="">邮箱注册</a></li>
						<li><a href="">手机号注册</a></li>
					</ul>
					<div>
						<!-- 显示错误信息 开始 -->
						@if (count($errors) > 0)
						    <div class="mws-form-message btn-primary" style="text-align: center;">
						        <ul>
						            @foreach ($errors->all() as $error)
						                <li>{{ $error }}</li>
						            @endforeach
						        </ul>
						    </div>
						@endif
						<!-- 显示错误信息 结束 -->
					</div>
						
					<div class="am-tabs-bd">
						<div class="am-tab-panel am-active">
							<form method="post" action="/home/register/insert">
								{{ csrf_field() }}
							   	<div class="user-email">
									<label for="email"><i class="am-icon-envelope-o"></i></label>
									<input type="email" name="email" id="email" placeholder="请输入邮箱账号">
                 				</div>						
			                 	<div class="user-pass">
									<label for="password"><i class="am-icon-lock"></i></label>
									<input type="password" name="password" id="password" placeholder="设置密码">
			                 	</div>										
			                 	<div class="user-pass">
									<label for="passwordRepeat"><i class="am-icon-lock"></i></label>
									<input type="password" name="repass" id="passwordRepeat" placeholder="确认密码">
			                 	</div>
			                 	<hr>
			                 	<div class="am-cf">
									<input type="submit" name="" value="注册" class="am-btn am-btn-primary am-btn-sm am-fl">
								</div>	
         					</form>
						</div>

						<div class="am-tab-panel">
							<form method="post" action="/home/register/store">
								{{ csrf_field() }}
			                 	<div class="user-phone">
									<label for="phone"><i class="am-icon-mobile-phone am-icon-md"></i></label>
									<input type="tel" name="phone" id="phone" placeholder="请输入手机号">
			                 	</div>																			
								<div class="verification">
									<label for="code"><i class="am-icon-code-fork"></i></label>
									<input type="tel" name="code" id="code" placeholder="请输入验证码">
									<a class="btn" href="javascript:void(0);" onClick="sendMobileCode(this);" id="sendMobileCode">
										<span id="dyMobileButton">获取</span>
									</a>
								</div>
				                <div class="user-pass">
									<label for="password"><i class="am-icon-lock"></i></label>
									<input type="password" name="password" id="password" placeholder="设置密码">
				                </div>										
			                 	<div class="user-pass">
									<label for="passwordRepeat"><i class="am-icon-lock"></i></label>
									<input type="password" name="repass" id="passwordRepeat" placeholder="确认密码">
			                 	</div>
			                 	<div class="am-cf">
									<input type="submit" name="" value="注册" class="am-btn am-btn-primary am-btn-sm am-fl">
								</div>	
							</form>	
							<hr>
						</div>
						<script type="text/javascript">
							$(function() {
							    $('#doc-my-tabs').tabs();
							  })
						</script>

						<script type="text/javascript">
							function sendMobileCode(obj)
							{
								// 获取用户的手机号
								let phone = $('#phone').val();
								// 验证格式
								let phone_preg = /^1{1}[3-9]{1}[\d]{9}$/;

								if (!phone_preg.test(phone)) {
									alert('手机号格式不正确')
									return false;
								}


								$(obj).attr('disabled',true);
								$(obj).css('color','#ccc');
								$(obj).css('cursor','no-drop');
								$('#dyMobileButton').css('color','#ccc');// span
 
								let time = null;
								if ($('#dyMobileButton').html() == '获取') {
									let i = 60;
									time = setInterval(function(){
										i--;
										$('#dyMobileButton').html('('+i+')s');
										if (i < 1) {
											$(obj).attr('disabled',false);
											$(obj).css('color','#333');
											$(obj).css('cursor','pointer');
											$('#dyMobileButton').css('color','#333');// span
											$('#dyMobileButton').html('获取');// span
							 				clearInterval(time);
										}
									},1000);

									// 发送ajax 发送验证码
									$.get('/home/register/sendPhone',{phone},function(res){
										if(res.error_code == 0){
											alert('发送成功,验证码10分钟有效');
										}else{
											alert('发送失败');
										}
									},'json');
								}

							}
						</script>
					</div>
				</div>

			</div>
		</div>
	</div>
</section>
<footer>
	<div class="center">
		<div class="pc-footer-login">
			<p>关于我们 招聘信息 联系我们 商家入驻 商家后台 商家社区 ©2017 Yungouwu.com 北京云购物网络有限公司</p>
			<p style="color:#999">营业执照注册号：990106000129004 | 网络文化经营许可证：北网文（2016）0349-219号 | 增值电信业务经营许可证：京2-20110349 | 安全责任书 | 京公网安备 99010602002329号 </p>
		</div>
	</div>
</footer>

</body>
</html>
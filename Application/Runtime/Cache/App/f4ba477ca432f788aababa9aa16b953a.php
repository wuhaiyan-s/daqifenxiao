<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html style="font-size: 37.5px;"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,minimum-scale=1,user-scalable=no">
<meta content="telephone=no" name="format-detection">
<meta name="apple-touch-fullscreen" content="yes">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<title></title>
<link href="<?php echo ($StaticDir); ?>bootstrap/css/bootstrap.min.css" type="text/css" rel="stylesheet">
<link href="<?php echo ($StaticDir); ?>mui/css/mui.min.css" type="text/css" rel="stylesheet">
<link href="<?php echo ($StaticCss); ?>base.css" type="text/css" rel="stylesheet">
<link href="<?php echo ($StaticCss); ?>login.css" type="text/css" rel="stylesheet">
<script src="<?php echo ($StaticDir); ?>mui/js/mui.min.js" language="javascript" type="text/javascript"></script>
<script src="<?php echo ($StaticJs); ?>jquery3.min.js" language="javascript" type="text/javascript"></script>
<script src="<?php echo ($StaticJs); ?>main.js "></script>
<script src="<?php echo ($StaticJs); ?>member.js "></script>
<script language="javascript" type="text/javascript">
	$(function(){
		var fontSize = $(window).width() / 375 * 37.5;
		$('html').css('font-size',fontSize+'px');
	});
</script>
</head>
<body>
	<div class="head">用户登录</div>
	<div class="mlogin">
		<div class="field autoClear">
	        <div class="label">手机号</div>
	        <div class="field-control">
	            <input type="text" class="input-required" name="login" placeholder="手机号" value="" id="username">
	        </div>
	        <div class="icon-clear" style="visibility: hidden;"><i class="iconfont"></i></div>
	    </div>
	    <div class="field autoClear">
	        <div class="label">登录密码</div>
	        <div class="field-control">
	            <input type="password" class="input-required" name="password" placeholder="请输入密码" value="" id="password">
	        </div>
	        <div class="icon-clear" style="visibility: hidden;"><i class="iconfont"></i></div>
	        <div class="pwd pwd-show" id="show-pwd"></div>
	    </div>
		<div class="checkcode-wrap">
			<div id="checkcode"></div>
		</div>
	    <div class="submit">
	        <a type="submit" class="button" id="submit-btn" onclick="login()">登 录</a>
	        <a href="<?php echo U('App/Member/register');?>" class="ft-right reg">免费注册</a>
	        <div class="clearfix"></div>
	    </div>
	    <div class="other-link">
	    	<div class="weixinLogin">
	        	<a href="<?php echo U('App/Index/member');?>">
		        	<span class="icon"></span>
					<span class="txt">微信登录</span>
	        	</a>
	    	</div>
	    </div>
	</div>
</body>
</html>
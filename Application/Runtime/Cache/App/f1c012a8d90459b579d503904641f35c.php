<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html style="font-size: 37.5px;"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,minimum-scale=1,user-scalable=no">
<meta content="telephone=no" name="format-detection">
<meta name="apple-touch-fullscreen" content="yes">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<title>用户注册</title>
<link href="<?php echo ($StaticDir); ?>mui/css/mui.min.css" type="text/css" rel="stylesheet">
<link href="<?php echo ($StaticCss); ?>base.css" type="text/css" rel="stylesheet">
<link href="<?php echo ($StaticCss); ?>login.css" type="text/css" rel="stylesheet">
<script src="<?php echo ($StaticJs); ?>jquery3.min.js" language="javascript" type="text/javascript"></script>
<script type="text/javascript">
    $(function(){
		var fontSize = $(window).width() / 375 * 37.5;
		$('html').css('font-size',fontSize+'px');
	});
</script>
</head>
<body>
	<div class="head"><a class="backBtn" href="<?php echo U('App/Member/login');?>"></a>用户注册</div>
	<form id="regForm"  onSubmit="javascript:return check(formUser);" class="mlogin"  name="userReg" action="" method="post">
		<input type="hidden" name="mid" value="<?php echo ($mid); ?>"/>
	    <div class="field autoClear">
            <div class="label">手机号</div>
            <div class="field-control">
                <input type="text" class="input-required" name="phone" placeholder="请输入11位手机号码" value="" id="username" autocomplete="off">
                <span id="getCode" class="hide">获取验证码</span>
            </div>
        </div>
        <div class="field autoClear hide">
            <div class="label">验证码</div>
            <div class="field-control">
                <input type="text" class="input-required" name="TPL_username" placeholder="" value="" id="checkcode" autocomplete="off">
            </div>
        </div>
        <div class="field autoClear">
            <div class="label">登录密码</div>
            <div class="field-control">
                <input type="password" class="input-required" name="password" placeholder="请输入密码" value="" id="password" autocomplete="off">
            </div>
            <div class="icon-clear" style="visibility: hidden;"><i class="iconfont"></i></div>
            <div class="pwd pwd-show" id="show-pwd"></div>
        </div>
		<div class="checkcode-wrap">
        	<div id="checkcode"></div>
        </div>
    	<div class="submit">
            <a href="javascript:void(0);" onclick="reg();" class="regBtn" id="submit-btn">确定</a>
        </div>
    </form>
</body>
<script src="<?php echo ($StaticDir); ?>mui/js/mui.min.js" language="javascript" type="text/javascript"></script>
<script src="<?php echo ($StaticJs); ?>main.js" language="javascript" type="text/javascript"></script>
<script src="<?php echo ($StaticJs); ?>member.js" language="javascript" type="text/javascript"></script>
</html>
<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>设置</title>
	<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<link href="<?php echo ($StaticDir); ?>mui/css/mui.min.css" type="text/css" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo ($StaticCss); ?>base.css">
	<link rel="stylesheet" href="<?php echo ($StaticCss); ?>setting.css">
	<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
	<script>
	  wx.config({
	      debug: false,
	      appId: '<?php echo ($wxApi['appId']); ?>', // 必填，公众号的唯一标识
		  timestamp: '<?php echo ($wxApi['timestamp']); ?>', // 必填，生成签名的时间戳
		  nonceStr: '<?php echo ($wxApi['noncestr']); ?>', // 必填，生成签名的随机串
		  signature: '<?php echo ($wxApi['signature']); ?>',// 必填，签名
	      jsApiList: [
	        'checkJsApi',
	        'onMenuShareTimeline',
	        'onMenuShareAppMessage',
	        'onMenuShareQQ',
	        'onMenuShareWeibo',
	        'onMenuShareQZone',
	        'hideMenuItems',
	        'showMenuItems',
	        'hideAllNonBaseMenuItem',
	        'showAllNonBaseMenuItem',
	        'translateVoice',
	        'startRecord',
	        'stopRecord',
	        'onVoiceRecordEnd',
	        'playVoice',
	        'onVoicePlayEnd',
	        'pauseVoice',
	        'stopVoice',
	        'uploadVoice',
	        'downloadVoice',
	        'chooseImage',
	        'previewImage',
	        'uploadImage',
	        'downloadImage',
	        'getNetworkType',
	        'openLocation',
	        'getLocation',
	        'hideOptionMenu',
	        'showOptionMenu',
	        'closeWindow',
	        'scanQRCode',
	        'chooseWXPay',
	        'openProductSpecificView'
	      ]
	  });
	  wx.ready(function () {
		    wx.error(function(res){
			    //alert(JSON.stringify(res));
			});
	  });
	</script>
</head>
<body class="mui-fullscreen">
	<!--页面主结构开始-->
	<div id="app" class="mui-views">
		<div class="mui-view">
			<div class="mui-navbar" id="header_with_back">

			</div>

			<div class="mui-pages">

			</div>
		</div>
	</div>
	<!--页面主结构结束-->
	<!--单页面开始-->
	<div id="setting" class="mui-page">

		<!--页面标题栏开始-->
		<div class="mui-navbar-inner mui-bar mui-bar-nav">
			<span class="mui-action-back mui-icon mui-icon-arrowleft"></span>
			<h1 class="mui-center mui-title">设置</h1>
		</div>
		<!--页面标题栏结束-->

		<!--页面主内容区开始-->
		<div class="mui-page-content">
			<div class="mui-scroll-wrapper">
				<div class="mui-scroll">
					<ul class="mui-table-view mui-table-view-chevron">
						<li class="mui-table-view-cell hide">
							<a href="" class="mui-navigate-right">账号管理</a>
						</li>
						<li class="mui-table-view-cell">
							<a href="#info" class="mui-navigate-right">个人资料</a>
						</li>
						<li class="mui-table-view-cell">
							<a href="#changepassword" class="mui-navigate-right">帐号安全</a>
						</li>
					</ul>
					<ul class="mui-table-view mui-table-view-chevron hide">
						<li class="mui-table-view-cell">
							<a href="#about" class="mui-navigate-right">关于我们</a>
						</li>
					</ul>
					<a class="exitBtn redBtn" onclick="logout();">退出登录</a>
				</div>
			</div>
		</div>
		<!--页面主内容区结束-->
	</div>

	<!--单页面结束-->
	<div id="info" class="mui-page">
		<div class="mui-navbar-inner mui-bar mui-bar-nav">
			<span class="mui-action-back mui-icon mui-icon-arrowleft"></span>
			<h1 class="mui-center mui-title">个人资料</h1>
		</div>

		<div class="mui-page-content">
			<div class="mui-scroll-wrapper">
				<div class="mui-scroll">

					<ul class="mui-table-view">
						<li class="mui-table-view-cell">

							<a id="head">头像
								<span class="mui-pull-right head">
									<img class="head-img mui-action-preview" id="head-img1" onclick="chooseImage()" src="<?php echo ($user["head_img"]); ?>" />
								</span>
							</a>
						</li>
					</ul>
					<form id="infoBase">
					<ul class="mui-table-view">
						<li class="mui-table-view-cell">
							<a>手机
								<span class="mui-pull-right" id="mobile"><input type="text" name="phone" value="<?php echo ($user["phone"]); ?>"/></span>
							</a>
						</li>
						<li class="mui-table-view-cell">
							<a>昵称
								<span class="mui-pull-right">
									<input type="text" name="username" value="<?php echo ($user["username"]); ?>"/>
								</span>
							</a>
						</li>
						<li class="mui-table-view-cell">
							<a>我的二维码
								<span class="mui-pull-right">
									<?php if($user['member'] == '1' ): ?><img src="<?php echo ($ticket); ?>" id="ticket_img" class="bigImgFixed" onclick="showImg('<?php echo ($ticket); ?>');"/>
									<?php else: ?>
										购买商品后自动生成推广二维码<i onclick="window.location.href='<?php echo U('Index/index');?>'" class="mui-btn mui-btn-primary mui-btn-outlined toHomeBtn">去首页选购</i><?php endif; ?>
								</span>
							</a>
						</li>
					</ul>
					</form>
				</div>
			</div>

		</div>

	</div>
	
	<!--单页面结束-->
	<div id="changepassword" class="mui-page">
		<div class="mui-navbar-inner mui-bar mui-bar-nav">
			<span class="mui-action-back mui-icon mui-icon-arrowleft"></span>
			<h1 class="mui-center mui-title">帐号安全</h1>
		</div>

		<div class="mui-page-content">
			<div class="mui-scroll-wrapper">
				<div class="mui-scroll">
					<form id="infoAuth">
					<ul class="mui-table-view">
						<li class="mui-table-view-cell">

							<a>旧密码
								<span class="mui-pull-right">
									<input name="oldpassword" id="oldpassword" placeholder="请输入旧密码" />
								</span>
							</a>
							
						</li>
						<li class="mui-table-view-cell">

							<a>新密码
								<span class="mui-pull-right">
									<input name="password"  id="password" placeholder="请输入新密码" />
								</span>
							</a>
						</li>
					</ul>
					<a id="saveBtn" onclick="savePwd()">确定</a>
					</form>
				</div>
			</div>

		</div>

	</div>

	<div id="about" class="mui-page hide">
		<div class="mui-navbar-inner mui-bar mui-bar-nav">

			<button type="button" class="mui-left mui-action-back mui-btn  mui-btn-link mui-btn-nav mui-pull-left">

				<span class="mui-icon mui-icon-left-nav"></span>

			</button>

			<h1 class="mui-center mui-title">关于我们</h1>

		</div>

		<div class="mui-page-content">
			<div class="mui-scroll-wrapper">
			</div>
		</div>
	</div>
	</body>
	<script src="<?php echo ($StaticJs); ?>jquery3.min.js"></script>
	<script src="<?php echo ($StaticJs); ?>main.js"></script>
	<script src="<?php echo ($StaticJs); ?>member.js"></script>
	<script src="<?php echo ($StaticDir); ?>mui/js/mui.min.js "></script>
	<script src="<?php echo ($StaticDir); ?>mui/js/mui.view.js "></script>
	<script>
		mui.init();

		//初始化单页view
		var viewApi = mui('#app').view({
			defaultPage: '#setting'
		});

		var view = viewApi.view;
		(function($) {
			//处理view的后退与webview后退
			var oldBack = $.back;
			$.back = function() {
				if(viewApi.canBack()) { //如果view可以后退，则执行view的后退
					viewApi.back();
				} else { //执行webview后退
					oldBack();
				}
			};
		})(mui);
		
		$(function(){
			$('#infoBase input').change(function(){
				var info = $('#infoBase').serialize();
				var url = base_url + '/index.php?g=Api&m=Member&a=saveInfo';
				$.post(url,info,function(res){
					if( typeof res == 'string' ){
						res = JSON.parse(res);
					}
					if( res.errno == 200 ){
						showMsg(res.errmsg);
					}else{
						showMsg(res.errmsg,'alert');
					}

				});
			});
		});
		
		//选择图片
		function chooseImage()
		{
			wx.chooseImage({
				count: 1, // 默认9
				sizeType: ['compressed'], // 可以指定是原图还是压缩图，默认二者都有
				sourceType: ['album','camera'], // 可以指定来源是相册还是相机，默认二者都有
				success: function (res) {
					uploadImage(res.localIds[0]);
				}
			});
		}
		
		//上传图片
		function uploadImage(localId){
			wx.uploadImage({
				localId: localId, // 需要上传的图片的本地ID，由chooseImage接口获得
				isShowProgressTips: 0, // 默认为1，显示进度提示
				success: function (res) {
					var url = base_url+'/index.php?g=Api&m=Api&a=uploadMedia';
					$.post(url,{media_id:res.serverId,file_name:'head_img'},function(e){
						if( typeof e == 'string' ){
							e = JSON.parse(e);
						}
						if( e.errno == 200 ){
							$('#head-img1').attr('src',e.data.head_img);
							showMsg(e.errmsg);
						}else{
							showMsg(e.errmsg,'alert');
						}
					});
				}
			});
		}	  
	</script>
</html>
<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>设置</title>
	<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<link href="<?php echo ($StaticDir); ?>mui/css/mui.min.css" type="text/css" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo ($StaticCss); ?>setting.css">
	<style>
		.aboutus {
			text-align: justify;
			border: 1px solid #ccc;
			border-radius: 10px;
			background: white;
			padding: 0 10px;
		}
		.aboutus p {
			text-indent: 2rem;
		}
	</style>
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
					<a class="exitBtn redBtn">退出登录</a>
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
									<img class="head-img mui-action-preview" id="head-img1" src="./images/user_headimg.png" />
								</span>
							</a>
						</li>
					</ul>
					<ul class="mui-table-view">
						<li class="mui-table-view-cell">
							<a>手机
								<span class="mui-pull-right" id="mobile"></span>
							</a>
						</li>
						<li class="mui-table-view-cell">
							<a>昵称
								<span class="mui-pull-right">
									<input id="username" placeholder="请输入昵称" />
								</span>
							</a>
						</li>
						<li class="mui-table-view-cell">
							<a>我的二维码
								<span class="mui-pull-right">
									<img src=""/>
								</span>
							</a>
						</li>
					</ul>
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
					<ul class="mui-table-view">
						<li class="mui-table-view-cell">

							<a>旧密码
								<span class="mui-pull-right">
									<input id="oldpwd" placeholder="请输入旧密码" />
								</span>
							</a>
							
						</li>
						<li class="mui-table-view-cell">

							<a>新密码
								<span class="mui-pull-right">
									<input id="newpwd" placeholder="请输入新密码" />
								</span>
							</a>

						</li>
					</ul>
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
	<script src=".<?php echo ($StaticJs); ?>jquery3.min.js"></script>
	<script src="<?php echo ($StaticDir); ?>mui/js/mui.min.js "></script>
	<script src="<?php echo ($StaticDir); ?>mui/js/mui.view.js "></script>
	<script>
		mui.init();
		
		mui.plusReady(function () {
    		
			mui('.mui-scroll').on('tap', '.exitBtn', function(e) {
				//setStore('userinfo','');
				mui.toast('已经退出登录.');
				var vw = plus.webview.currentWebview();
				var vwu = plus.webview.getWebviewById("user.html");
				vwu.reload();
				vw.close();
			});
			
			mui('#head').on('tap', '#head-img1', function(e) {
				//galleryImg();
			});

		});

		//初始化单页view
		var viewApi = mui('#app').view({
			defaultPage: '#setting'
		});

			
		getUserInfo();

		var view = viewApi.view;
		(function($) {
			//处理view的后退与webview后退
			var oldBack = $.back;
			$.back = function() {
				if (viewApi.canBack()) { //如果view可以后退，则执行view的后退
					viewApi.back();
				} else { //执行webview后退
					oldBack();
				}
			};
		})(mui);
		mui('.mui-scroll-wrapper').scroll();
		
		$(function(){

			$('#info select').change(function(){
				saveBaseInfo();
			});

			$('#info input').mouseout(function(){
				saveBaseInfo();
			});

			$('#info input').blur(function(){
				saveBaseInfo();
			});

		});
		
		function getUserInfo()
		{
			
		}
		
		// 从相册中选择图片 
		function galleryImg() {
		    plus.gallery.pick( function(path){
		    	createUpload(path);
		    }, function ( e ) {
		    	console.log( "取消选择图片" );
		    }, {filter:"image"} );
		}
		//上传图片
		function createUpload(path)
		{
			var uuinfo = userinfo;
			if( typeof userinfo == 'string' ){
				uuinfo = JSON.parse(uuinfo);
			}
			var url = api_site+'/index.php?g=Api&a=uploadHeadimg';

			var wt   = plus.nativeUI.showWaiting(); 

			var task = plus.uploader.createUpload( url,{ method:"POST",blocksize:12048000,priority:100,timeout:300 },

				function ( t, status ) {

					alert(JSON.stringify(t));

					if( status != 200 ){

						malert('上传失败，错误码1'+status);

						return;

					}

					var reText = JSON.parse(t.responseText);

					if( reText.code == 200 ){

						uuinfo.userpic = uuinfo.head_img = reText.data.file;

						//if( is_app ){

							setStore('userinfo',JSON.stringify(userinfo));

						//}

						$('#head-img1').attr('src',uuinfo.userpic);

						mtoast('上传成功');

						return;

					}

					malert('上传失败，错误码3'+reText.code);

					wt.close();

				}

			);

			task.addFile( path, {key:"headimg"} );

			task.addData( "userid", uuinfo.userid );

			task.start();

		}
	</script>
</html>
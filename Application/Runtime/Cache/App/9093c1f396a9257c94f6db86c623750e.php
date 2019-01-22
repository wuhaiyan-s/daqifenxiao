<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>佣金提现</title>
	<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<link href="<?php echo ($StaticDir); ?>mui/css/mui.min.css" type="text/css" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo ($StaticCss); ?>base.css">
	<link rel="stylesheet" href="<?php echo ($StaticCss); ?>setting.css">
	<style type="text/css" media="screen">
		.txTitle{
			font-weight: bold;
		}
		#txList{
			font-size: 14px;
			text-align: center;
		}
		#txList dd,#txList dt{
			display: inline-block;
		}
		.txPrice{
			color: #f00;
		}
		.txNo{
			color: #888;
		}
		#submitBtn{
			margin: 1.5rem 1.75rem;
		    height: 4rem;
		    line-height: 4rem;
		    font-size: 1.167rem;
		    display: block;
		    text-align: center;
		    border-radius: 0.5rem;
		    background: #04be02;
		    color: #fff;
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
	<div id="indexPage" class="mui-page">

		<!--页面标题栏开始-->
		<div class="mui-navbar-inner mui-bar mui-bar-nav">
			<span class="mui-action-back mui-icon mui-icon-arrowleft"></span>
			<h1 class="mui-center mui-title">佣金提现</h1>
		</div>
		<!--页面标题栏结束-->

		<!--页面主内容区开始-->
		<div class="mui-page-content">
			<div class="mui-scroll-wrapper">
				<div class="mui-scroll">
					<ul class="mui-table-view mui-table-view-chevron">
						<li class="mui-table-view-cell">
							<a href="#shenqingtixian" class="mui-navigate-right">申请提现</a>
						</li>
						<li class="mui-table-view-cell">
							<a href="#tixianlishi" class="mui-navigate-right">提现历史</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<!--页面主内容区结束-->
	</div>

	<!--单页面结束-->
	<div id="tixianlishi" class="mui-page">
		<div class="mui-navbar-inner mui-bar mui-bar-nav">
			<span class="mui-action-back mui-icon mui-icon-arrowleft"></span>
			<h1 class="mui-center mui-title">提现历史</h1>
		</div>

		<div class="mui-page-content">
			<div class="mui-scroll-wrapper">
				<div class="mui-scroll">
					<ul class="mui-table-view" id="txList">
						 <li class="mui-table-view-cell txTitle">
						 	<dl class="mui-row"><dt class="mui-col-xs-5 mui-col-xm-5">编号</dt><dt class="mui-col-xs-3 mui-col-xm-3">金额</dt><dt class="mui-col-xs-4 mui-col-xm-4">状态</dt></dl>
						 </li>
				         <li class="mui-table-view-cell"><dl class="mui-row"><dd class="mui-col-xs-5 mui-col-xm-5 txNo">TN0001</dd><dd class="mui-col-xs-3 mui-col-xm-3 txPrice">￥200.05</dd><dd class="mui-col-xs-4 mui-col-xm-4">已到账</dd></dl></li>
				         <li class="mui-table-view-cell"><dl class="mui-row"><dd class="mui-col-xs-5 mui-col-xm-5 txNo">TN0002</dd><dd class="mui-col-xs-3 mui-col-xm-3 txPrice">￥250.00</dd><dd class="mui-col-xs-4 mui-col-xm-4">待审核</dd></dl></li>
					     <li class="mui-table-view-cell"><dl class="mui-row"><dd class="mui-col-xs-5 mui-col-xm-5 txNo">TN0003</dd><dd class="mui-col-xs-3 mui-col-xm-3 txPrice">￥100.05</dd><dd class="mui-col-xs-4 mui-col-xm-4">已到账</dd></dl></li>
				         <li class="mui-table-view-cell"><dl class="mui-row"><dd class="mui-col-xs-5 mui-col-xm-5 txNo">TN0004</dd><dd class="mui-col-xs-3 mui-col-xm-3 txPrice">￥20.00</dd><dd class="mui-col-xs-4 mui-col-xm-4">待审核</dd></dl></li>
					     <li class="mui-table-view-cell"><dl class="mui-row"><dd class="mui-col-xs-5 mui-col-xm-5 txNo">TN0005</dd><dd class="mui-col-xs-3 mui-col-xm-3 txPrice">￥500.00</dd><dd class="mui-col-xs-4 mui-col-xm-4">已到账</dd></dl></li>
				         <li class="mui-table-view-cell"><dl class="mui-row"><dd class="mui-col-xs-5 mui-col-xm-5 txNo">TN0006</dd><dd class="mui-col-xs-3 mui-col-xm-3 txPrice">￥180.00</dd><dd class="mui-col-xs-4 mui-col-xm-4">待审核</dd></dl></li>
					</ul>
				</div>
			</div>
		</div>

	</div>
	
	<!--单页面结束-->
	<div id="shenqingtixian" class="mui-page">
		<div class="mui-navbar-inner mui-bar mui-bar-nav">
			<span class="mui-action-back mui-icon mui-icon-arrowleft"></span>
			<h1 class="mui-center mui-title">申请提现</h1>
		</div>

		<div class="mui-page-content">
			<div class="mui-scroll-wrapper">
				<div class="mui-scroll">
					<form id="infoAuth">
					<ul class="mui-table-view">
						<li class="mui-table-view-cell">

							<a>提现金额
								<span class="mui-pull-right">
									<input name="price" id="price" placeholder="请输入提现金额" />
								</span>
							</a>
							
						</li>
					</ul>
					<a id="submitBtn" onclick="tiXian()">确定</a>
					</form>
				</div>
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
			defaultPage: '#indexPage'
		});

			
		//getUserInfo();

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
		 
		//提现 
		function tiXian()
		{
			
		}
	</script>
</html>
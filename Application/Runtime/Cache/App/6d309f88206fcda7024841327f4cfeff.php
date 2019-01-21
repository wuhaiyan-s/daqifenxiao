<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html style="font-size: 100px;">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,minimum-scale=1,user-scalable=no">
<meta content="telephone=no" name="format-detection">
<meta name="apple-touch-fullscreen" content="yes">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<title>我的订单</title>
<link rel="stylesheet" type="text/css" href="<?php echo ($StaticDir); ?>iconfont/iconfont.css">
<link href="<?php echo ($StaticDir); ?>mui/css/mui.min.css" type="text/css" rel="stylesheet">
<link href="<?php echo ($StaticCss); ?>base.css" type="text/css" rel="stylesheet">
<link href="<?php echo ($StaticCss); ?>orderlist.css" type="text/css" rel="stylesheet">
</head>
<body>
<header class="mui-bar mui-bar-nav headerTop">
	<a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left"></a>
	<h1 class="mui-title">我的订单</h1>
</header>
<div class="fixed-top hide">
	<nav class="tab-bar__wrap">
		<ul>
			<li class="acitve-tab">全部</li>
			<li class="">待付款</li>
			<li class="">待发货</li>
			<li class="">待收货</li>
			<li class="">待评价</li>
		</ul>
	</nav>
</div>
<div class="main-layout" id="mainContainer">
	<div id="mainBox">
		<ul class="list-card" style="display: none">
	    <div class="empty-block">
	      <div class="empty-title">您还没有相关的订单</div>
	      <div class="empty-content">可以去看看有哪些想买的</div>
	      <div class="empty-btn" style="display: block;">
	        <span>随便逛逛</span></div>
	    </div>
	  </ul>
	  <ul class="list-card" style="display: none;">
	    <div class="empty-block">
	      <img src="https://img.alicdn.com/tfs/TB1vJ_.vTqWBKNjSZFxXXcpLpXa-330-330.png" alt="empty">
	      <div class="empty-title">您还没有相关的订单</div>
	      <div class="empty-content">可以去看看有哪些想买的</div>
	      <div class="empty-btn" style="display: block;">
	        <span>随便逛逛</span></div>
	    </div>
	  </ul>
	  <ul class="list-card" style="display: none;">
	    <div class="empty-block">
	      <img src="https://img.alicdn.com/tfs/TB1vJ_.vTqWBKNjSZFxXXcpLpXa-330-330.png" alt="empty">
	      <div class="empty-title">您还没有相关的订单</div>
	      <div class="empty-content">可以去看看有哪些想买的</div>
	      <div class="empty-btn" style="display: block;">
	        <span>随便逛逛</span></div>
	    </div>
	  </ul>
	  <ul class="list-card" style="display: none;">
	    <div class="empty-block">
	      <img src="https://img.alicdn.com/tfs/TB1vJ_.vTqWBKNjSZFxXXcpLpXa-330-330.png" alt="empty">
	      <div class="empty-title">您还没有相关的订单</div>
	      <div class="empty-content">可以去看看有哪些想买的</div>
	      <div class="empty-btn" style="display: block;">
	        <span>随便逛逛</span></div>
	    </div>
	  </ul>
	  <ul class="list-card" style="display: none;">
	    <div class="empty-block">
	      <img src="https://img.alicdn.com/tfs/TB1vJ_.vTqWBKNjSZFxXXcpLpXa-330-330.png" alt="empty">
	      <div class="empty-title">您还没有相关的订单</div>
	      <div class="empty-content">可以去看看有哪些想买的</div>
	      <div class="empty-btn" style="display: block;">
	        <span>随便逛逛</span></div>
	    </div>
	  </ul>
	</div>
</div>
<div class="tb-toolbar-container">
  <a class="tab" href="<?php echo U('App/Index/index');?>" data-action="index_index">
    <span class="tb-toolbar-iconfont iconfont tb-icon-homepage"></span>
    <p class="text">首页</p></a>
  <a class="tab" href="<?php echo U('App/Index/cart');?>" data-action="index_cart">
    <span class="tb-toolbar-iconfont iconfont tb-icon-cart"></span>
    <p class="text">购物车</p></a>
  <a class="tab" href="<?php echo U('App/Member/orderlist');?>" data-action="member_orderlist">
    <span class="tb-toolbar-iconfont iconfont tb-icon-activity"></span>
    <p class="text">订单</p></a>
  <a class="tab" href="<?php echo U('App/Member/index');?>" data-action="member_index">
    <span class="tb-toolbar-iconfont iconfont tb-icon-mine"></span>
    <p class="text">我的</p></a>
</div>
<script src="./Public/Static/js/jquery3.min.js" language="javascript" type="text/javascript"></script>
<script language="javascript" type="text/javascript">
	$(function(){
		var a = getParam('a').toLowerCase();
		var m = getParam('m').toLowerCase();
		var action = m + '_' + a;
		$('.tb-toolbar-container a[data-action='+action+']').addClass('active').siblings().removeClass('active');
	});
	
	function getParam(paramName) { 
	    paramValue = "", isFound = !1; 
	    if (this.location.search.indexOf("?") == 0 && this.location.search.indexOf("=") > 1) { 
	        arrSource = unescape(this.location.search).substring(1, this.location.search.length).split("&"), i = 0; 
	        while (i < arrSource.length && !isFound) arrSource[i].indexOf("=") > 0 && arrSource[i].split("=")[0].toLowerCase() == paramName.toLowerCase() && (paramValue = arrSource[i].split("=")[1], isFound = !0), i++ 
	    } 
	    return paramValue == "" && (paramValue = null), paramValue 
	} 
</script>
<script src="<?php echo ($StaticDir); ?>mui/js/mui.min.js "></script>
<script src="<?php echo ($StaticDir); ?>mui/js/mui.view.js "></script>
<script src="<?php echo ($StaticJs); ?>main.js "></script>
<script src="<?php echo ($StaticJs); ?>member.js "></script>
<script language="javascript" type="text/javascript">	
	mui.init({
		keyEventBind: {
			backbutton: true  //开启back按键监听
		}
	});
	
	var UploadDir      = '<?php echo ($UploadDir); ?>',
		GoodsImageDefault = '<?php echo ($GoodsImageDefault); ?>';
		orderTotalPage = <?php echo ($total_page); ?>,
		thisOrderPage  = 1,
		canLoad        = 1;//是否还有数据可加载
		
	var orderBoxH = 0;
	var orderBoxMaxH = $(document).height() - 56 - 45;
	$(function(){
		$('#mainContainer').height(orderBoxMaxH);
		getorders(thisOrderPage);
		
		//下拉加载数据
		$('#mainContainer').scroll(function(){
			var h = $(this).scrollTop();
			if( h > ( orderBoxH - orderBoxMaxH ) && canLoad == 1 ){
				//console.log(h);
				//console.log(orderBoxH);
				getorders(thisOrderPage);
			}
		});
	});
</script>
</body>
</html>
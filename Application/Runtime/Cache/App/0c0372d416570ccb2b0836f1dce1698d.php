<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html style="font-size: 12px;">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,minimum-scale=1,user-scalable=no">
<meta content="telephone=no" name="format-detection">
<meta name="apple-touch-fullscreen" content="yes">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<title></title>
<link rel="stylesheet" type="text/css" href="./Public/Static/iconfont/iconfont.css">
<link href="./Public/Static/css/base.css" type="text/css" rel="stylesheet">
<link href="./Public/Static/css/member_index.css" type="text/css" rel="stylesheet">
</head>
<body id="ucenter">
<div class="page-container">
	<div class="header_con" id="myHeader">
	  <div class="my_header shadow">
	    <div class="user_info">
	      <!---->
	      <div class="avatar_wrap">
	        <div class="avatar">
	          <div class="image_info" style="background: url(&quot;http://storage.360buyimg.com/i.imageUpload/7738687931343735383236363135323935_mid.jpg&quot;) 0px 0px / 100% 100% no-repeat;"></div>
	        </div>
	      </div>
	      <div class="personal_wrap">
	        <div class="name line1">
	          <span class="line1">绿芝麻51</span>
<!-- 	          <span class="my_header_v4_name_edit"></span> -->
	          <span class="my_header_level hide">(一级代理商)</span>
	        </div>
	        <span class="pin line1">销售额<a href="<?php echo U('Member/sale');?>">￥<?php echo ($all_buy_price); ?></a></span>
	      </div>
	      <div class="account_wrap">
	        <a href="<?php echo U('Member/setting');?>" class="account_wrap_content">
	          <span class="iconfont icon-setting-preferences-gear-office-application-structure-define-process-fbaaebdf"></span>账号管理</a>
	      </div>
	    </div>
	  </div>
	</div>
	<div class="uinfolist" id="uinfolist">
		<div class="ublock umember">
			<h2>家族成员<span><i>0</i>人</span><em></em></h2>
			<ul>
				<li>一级会员<span><?php echo ($users["a_cnt"]); ?></span></li>
				<li>二级会员<span><?php echo ($users["b_cnt"]); ?></span></li>
				<li>三级会员<span><?php echo ($users["c_cnt"]); ?></span></li>
			</ul>
		</div>
		<div class="ublock ubuy">
			<h2>家族推广<span><i>5</i>单</span><em></em></h2>
			<ul>
				<li>下单未购买<span><?php echo ($all_over_buy); ?></span></li>
				<li>下单已购买<span><?php echo ($all_buy); ?></span></li>
			</ul>
		</div>
		<div class="ublock">
			<h2>我的佣金<span><i>0.25</i>元</span><em></em></h2>
			<ul>
				<li>未付款定单佣金<span><?php echo ($start_price); ?></span></li>
				<li>已付款定单佣金<span><?php echo ($over_price); ?></span></li>
				<li>已收货定单佣金<span><?php echo ($confirm_price); ?></span></li>
				<li>已完成定单佣金<span><?php echo ($add_over_price); ?></span></li>
				<li>待审核提现佣金<span><?php echo ($get_start_price); ?></span></li>
				<li>已提现佣金<span><?php echo ($get_end_price); ?></span></li>
				<li>可提现佣金<span><?php echo ($users["price"]); ?></span></li>
			</ul>
		</div>
		<div class="ublock">
			<h2>申请提现</h2>
		</div>
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
<script language="javascript" type="text/javascript">
	$(function(){
		$('#uinfolist h2 em').click(function(){
			var showStatus = $(this).parent().hasClass('toShow');
			if( showStatus ){
				$(this).parent().next().slideUp();
				$(this).parent().removeClass('toShow');
			}else{
				$(this).parent().next().slideDown();
				$(this).parent().addClass('toShow');
			}
		});
	});
</script>
</body>
</html>
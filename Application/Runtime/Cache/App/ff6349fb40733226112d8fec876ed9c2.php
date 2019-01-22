<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,minimum-scale=1,user-scalable=no">
<meta content="telephone=no" name="format-detection">
<meta name="apple-touch-fullscreen" content="yes">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<title>首页</title>
<link rel="stylesheet" type="text/css" href="<?php echo ($StaticDir); ?>iconfont/iconfont.css">
<link href="<?php echo ($StaticCss); ?>base.css" type="text/css" rel="stylesheet">
<link href="<?php echo ($StaticCss); ?>carousel.css" type="text/css" rel="stylesheet">
<link href="<?php echo ($StaticCss); ?>index.css" type="text/css" rel="stylesheet">
<script src="<?php echo ($StaticJs); ?>jquery3.min.js" language="javascript" type="text/javascript"></script>
<script src="<?php echo ($StaticDir); ?>bootstrap/js/bootstrap.min.js" language="javascript" type="text/javascript"></script>
<script src="<?php echo ($StaticJs); ?>main.js" language="javascript" type="text/javascript"></script>
<script language="javascript" type="text/javascript">
	$(function(){
		var fontSize = $(window).width() / 375 * 12;
		$('html').css('font-size',fontSize+'px');
	});
</script>
</head>
<body>
<div id="header-wrapper">
	<div id="header" class="">
		<a class="menu icon"><img src="./images/logo.png"/></a>
		<i class="space"></i>
		<a href="<?php echo U('Member/index');?>" id="headLogin">登录</a>
	</div>
</div>
<div class="index-con">
	<div class="top_search m-search--shrink" id="m-search-con">
		<div class="m-search__rect"></div>
		<a class="m-search__link" target="_blank" href="javascript:void(0);">搜索商品</a>
	</div>
	<div id="carousel-example-generic" class="carousel slide m-slider " data-ride="carousel">
	  <!-- Indicators -->
	  <ol class="carousel-indicators">
	    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
	    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
	  </ol>
	
	  <!-- Wrapper for slides -->
	  <div class="carousel-inner" role="listbox">
	    <div class="item active">
	      <img src="./Public/Uploads/a.dpg" alt=>
	      <div class="carousel-caption">
	        图片1
	      </div>
	    </div>
	    <div class="item">
	      <img src="./Public/Uploads/b.dpg" alt="...">
	      <div class="carousel-caption">
	        图2
	      </div>
	    </div>
	  </div>
	
	  <!-- Controls -->
	  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
	    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
	    <span class="sr-only">Previous</span>
	  </a>
	  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
	    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
	    <span class="sr-only">Next</span>
	  </a>
	</div>
	<div class="m-icon-entrance hide">
		<a href="#" data-spm="d77" target="_blank" class="icon-entrance__item"><div class="icon-entrance__img-wrapper"><img class="icon-entrance__img" src="//img.alicdn.com/tfs/TB1YCJYnwHqK1RjSZFgXXa7JXXa-168-168.png_170x120Q90s50.jpg_.webp"></div><span class="icon-entrance__title">生鲜水果</span></a>
		<a href="" data-spm="d78" target="_blank" class="icon-entrance__item"><div class="icon-entrance__img-wrapper"><img class="icon-entrance__img" src="//img.alicdn.com/tfs/TB1lqqWlNTpK1RjSZFKXXa2wXXa-168-168.png_170x120Q90s50.jpg_.webp"></div><span class="icon-entrance__title">休闲零食</span></a>
		<a href="" data-spm="d79" target="_blank" class="icon-entrance__item"><div class="icon-entrance__img-wrapper"><img class="icon-entrance__img" src="//img.alicdn.com/tps/i4/TB1uqxzdb3nBKNjSZFMSuuUSFXa.jpg_170x120Q90s50.jpg_.webp"></div><span class="icon-entrance__title">奶品水饮</span></a>
		<a href="" data-spm="d80" target="_blank" class="icon-entrance__item"><div class="icon-entrance__img-wrapper"><img class="icon-entrance__img" src="//img.alicdn.com/tps/i4/TB1mFaJcnCWBKNjSZFtSuuC3FXa.jpg_170x120Q90s50.jpg_.webp"></div><span class="icon-entrance__title">粮油厨房</span></a>
		<a href="" data-spm="d82" target="_blank" class="icon-entrance__item"><div class="icon-entrance__img-wrapper"><img class="icon-entrance__img" src="//img.alicdn.com/tps/i4/TB14SqehXuWBuNjSspnSut1NVXa.jpg_170x120Q90s50.jpg_.webp"></div><span class="icon-entrance__title">母婴用品</span><i class="icon-entrance__tag icon-entrance__tag--hot"></i></a>
	</div>
	<div class="goods" id="m-social">
		<div class="social-title"><i class="home-left-icon"></i>精选商品<i class="home-right-icon"></i></div>
		<?php if(is_array($goods)): foreach($goods as $key=>$vo): ?><div class="item-list-content-wraper bgtransparent">
			<div class="item-list-content ban-dom">
				<li class="ban-dom">
					<div class="ui-p-r more-today-pic-div">
						<img src="__PUBLIC__/Uploads/<?php echo ($vo["image"]); ?>" alt="图片" class="more-today-pic"></div>
					<div class="more-today-title">
						<div class="ui-nowrap-two ui-word-break more-zhu-title ui-nowrap-one-new"><span><?php echo ($vo["title"]); ?></span></div>
						<div class="ui-nowrap-one-new more-sub-title"><?php echo ($vo["goods_desc"]); ?></div>
					</div>
					<div class="ui-rows-m more-item-info more-price-info">
						<div class="ui-cols ui-cols-75"><em class="more-curr-price">￥<?php echo ($vo["price"]); ?></em><em class="more-pre-price">￥<?php echo ($vo["old_price"]); ?></em></div>
						<a class="more-buy-now-btn ui-cols ui-text-right" href="./index.php?g=App&m=Index&a=detail&id=<?php echo ($vo["id"]); ?>">立即抢购</i></a>
					</div>
				</li>
			</div>
		</div><?php endforeach; endif; ?>
	</div>
	<div class="banPre100 hide"><a href=""><img src="../images/banner03_s.jpg"/></a></div>
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
<script language="javascript" type="text/javascript">
	$(function(){
		renderBar();
	});
	
	//渲染底部菜单的当前项
	function renderBar()
	{
		var a = getParam('a');
		var m = getParam('m');
		if( m == '' || m == null ){
			m = 'Index';
		}
		if( a == '' || a == null ){
			a = 'index';
		}
		var action = m.toLowerCase() + '_' + a.toLowerCase();
		$('.tb-toolbar-container a[data-action='+action+']').addClass('active').siblings().removeClass('active');
	}
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
		user_id = <?php echo ($user_id); ?>;
		var is_login = isLogin();
		if( is_login ){
			$('#headLogin').html('<span class="iconfont icon-icon7"></span>');
		}
	});
</script>
</body>
</html>
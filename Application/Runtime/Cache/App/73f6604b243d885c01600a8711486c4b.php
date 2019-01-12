<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,minimum-scale=1,user-scalable=no">
<meta content="telephone=no" name="format-detection">
<meta name="apple-touch-fullscreen" content="yes">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<title>购物车</title>
<link rel="stylesheet" type="text/css" href="<?php echo ($StaticDir); ?>iconfont/iconfont.css">
<link href="<?php echo ($StaticDir); ?>mui/css/mui.min.css" type="text/css" rel="stylesheet">
<link href="<?php echo ($StaticCss); ?>base.css" type="text/css" rel="stylesheet">
<link href="<?php echo ($StaticCss); ?>cart.css" type="text/css" rel="stylesheet">
<script src="<?php echo ($StaticDir); ?>mui/js/mui.min.js" language="javascript" type="text/javascript"></script>
</head>
<body>
<header class="mui-bar mui-bar-nav headerTop">
	<a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left"></a>
	<h1 class="mui-title">购物车</h1>
</header>
<div class="order-list">
  <div class="grid-shop">
    <div class="grid-bundle grid-bundle-SM_725677994 grid-bundle-shop" id="orderList">
	  <?php if(empty($cartData)): ?><div class="cartHasNone">您的购物车为空.</div>
	  <?php else: ?>
	  	<?php if(is_array($cartData)): $i = 0; $__LIST__ = $cartData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$goods): $mod = ($i % 2 );++$i;?><div class="grid-main">
	        <div class="grid-order" id="grid-order-<?php echo ($goods["id"]); ?>" goodsid="<?php echo ($goods["id"]); ?>"  goodsname="<?php echo ($goods["name"]); ?>" price="<?php echo ($goods["price"]); ?>" lirun="<?php echo ($goods["lirun"]); ?>" num="<?php echo ($goods["num"]); ?>" image="<?php echo ($goods["image"]); ?>">
	          <div class="order-select" id="order-select-<?php echo ($goods["id"]); ?>" goodsid="<?php echo ($goods["id"]); ?>"  goodsname="<?php echo ($goods["name"]); ?>" price="<?php echo ($goods["price"]); ?>" lirun="<?php echo ($goods["lirun"]); ?>" num="<?php echo ($goods["num"]); ?>" image="<?php echo ($goods["image"]); ?>">
	            <div class="icon"></div>
	          </div>
	          <a href="<?php echo U('Index/detail',array('id'=>$goods['id']));?>" class="order-link" target="_blank">
	            <div class="link-mask"></div>
	            <img src="__PUBLIC__/Uploads/<?php echo ($goods["image"]); ?>"></a>
	          <div class="order-des">
	            <a href="<?php echo U('Index/detail',array('id'=>$goods['id']));?>" target="_blank"><?php echo ($goods["name"]); ?></a>
	            <span class="ui-number">
	              <a class="decrease" onclick="addToCart(<?php echo ($goods["id"]); ?>,'decrease')">-</a>
	              <input type="number" class="num" min="1" pattern="[0-9]*" autocomplete="off" id="goods-num-<?php echo ($goods["id"]); ?>" value="<?php echo ($goods["num"]); ?>" onchange="addToCart(<?php echo ($goods["id"]); ?>,'change')">
	              <a class="increase" onclick="addToCart(<?php echo ($goods["id"]); ?>,'increase')">+</a></span>
	          </div>
	          <div class="order-opt">
	            <div class="opt-num">数量 x<span id="opt-num-<?php echo ($goods["id"]); ?>"><?php echo ($goods["num"]); ?></span></div>
	            <p class="price">
	              <span class="ui-price-icon">￥</span><?php echo sprintf('%.2f',$goods['price']);?></p>
	            <a class="opt-delete" onclick="addToCart(<?php echo ($goods["id"]); ?>,'del')"></a>
	          </div>
	        </div>
	      </div><?php endforeach; endif; else: echo "" ;endif; endif; ?>
    </div>
  </div>
</div>
<div class="float-box">
  <div class="tm-mcApart"></div>
  <a class="order-select">
    <div class="icon" goods_count="<?php echo ($goods_count); ?>" id="selectAllBtn" onclick="selectAll($(this));"></div>
  </a>
  <div class="float-sum">
    <p class="fee">
      <span class="total-title">总价：</span>
      <span class="total-fee-box">
        <span class="tc-rmb">￥</span>
        <span class="total-fee" id="total-fee" total_fee="0.00">0.00</span></span>
    </p>
  </div>
  <div class="float-go">
    <a class="go-btn" id="toBuyBtn" goods_selected="0" onclick="toBuy()">结算(<i>0</i>)</a></div>
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
<script language="javascript" type="text/javascript">
	var goods_selected = 0;//加入结算的所有商品的总个数（一个商品买多件算1个）
	var total_price_t  = 0.00;
	var totallirun_t   = 0.00;
	var goods_count    = <?php echo ($goods_count); ?>;
	var total_price    = <?php echo ($total_price); ?>;
	var totallirun     = <?php echo ($totallirun); ?>;
	
	mui.init({
		keyEventBind: {
			backbutton: true  //开启back按键监听
		}
	});
	$(function(){
		//单个商品的选择和取消 小数运算时数值结果可能会有bug
		$('#orderList .order-select .icon').click(function(){
			var parentObj  = $(this).parent().parent();
			var isSelected = parentObj.hasClass('grid-order-selected');
			var price      = parentObj.attr('price');
			if( !isSelected ){
				$(this).addClass('icon-selected');
				parentObj.addClass('grid-order-selected');
				
				goods_selected += 1;
				if( goods_selected == goods_count ){
					$('#selectAllBtn').addClass('icon-selected');//全选
				}
			}else{
				$(this).removeClass('icon-selected');
				$(this).parent().parent().removeClass('grid-order-selected');
				
				goods_selected -= 1;
				$('#selectAllBtn').removeClass('icon-selected');//全不选
			}
			updateCart();
		});
	});
	
	//全选或全不选
	function selectAll(obj)
	{
		goods_selected = 0;
		var isSelected = obj.hasClass('icon-selected');
		if( isSelected ){
			//全不选
			obj.removeClass('icon-selected');
			$('.grid-order').removeClass('grid-order-selected');
			$('#orderList .order-select .icon').removeClass('icon-selected');
		}else{
			goods_selected = goods_count;
			//全选
			obj.addClass('icon-selected');
			$('.grid-order').addClass('grid-order-selected');
			$('#orderList .order-select .icon').addClass('icon-selected');
		}
		updateCart();
	}
	
	//根据选择更新要结算的商品数据
	function updateCart()
	{
		var orders = $('.grid-order-selected'),
			l = orders.length;
		
		buydata = {};
		total_price_t = 0;
		totallirun_t = 0;
		goods_selected = 0;
		if( l > 0 ){
			for( var i = 0;i < l;i++ ){
				var Id      = $(orders[i]).attr('goodsid');
				var goods   = {};
				goods.id    = Id;
				goods.num   = parseInt($(orders[i]).attr('num'));
				goods.price = $(orders[i]).attr('price');
				goods.image = $(orders[i]).attr('image');
				goods.name  = $(orders[i]).attr('goodsname');
				goods.lirun = $(orders[i]).attr('lirun');
				buydata[Id] = goods;
				total_price_t += goods.price * goods.num;
				totallirun_t  += goods.lirun * goods.num;
				goods_selected += 1;
			}
		}
		buyinfo.total_price = toDecimal2(total_price_t);
		buyinfo.totallirun  = toDecimal2(totallirun_t);
		buyinfo.goods_count = goods_selected;
		console.log(buydata);
		console.log(buyinfo);
		$('#toBuyBtn').attr('goods_selected',goods_selected).find('i').html(goods_selected);
		$('#total-fee').html( toDecimal2(total_price_t) );
	}
</script>
</body>
</html>
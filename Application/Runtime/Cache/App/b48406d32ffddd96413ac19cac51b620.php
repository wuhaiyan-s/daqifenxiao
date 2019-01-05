<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,minimum-scale=1,user-scalable=no">
    <meta content="telephone=no" name="format-detection">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <title></title>
    <link rel="stylesheet" type="text/css" href="<?php echo ($StaticDir); ?>iconfont/iconfont.css">
    <link href="<?php echo ($StaticCss); ?>base.css" type="text/css" rel="stylesheet">
    <link href="<?php echo ($StaticCss); ?>buy.css" type="text/css" rel="stylesheet">
  </head>
  <body>
    <header class="mui-bar mui-bar-nav headerTop">
      <a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left"></a>
      <h1 class="mui-title">商品结算</h1>
    </header>
    <div class="order-address mui-flex align-center" id="address_1">
	    <input type="hidden" id="userinfo_name" value="吴海艳"/>
	    <input type="hidden" id="userinfo_phone" value="18510036026"/>
	    <input type="hidden" id="userinfo_province" value="北京"/>
	    <input type="hidden" id="userinfo_city" value="北京市"/>
	    <input type="hidden" id="userinfo_county" value="大兴区"/>
	    <input type="hidden" id="userinfo_address4" value="狼垡"/>
	    <input type="hidden" id="userinfo_address" value="CCC1号楼"/>
      <div class="cell fixed align-center">
        <div class="icon"></div>
      </div>
      <div class="cell content">
        <div class="info">
          <span>收货人：</span>
          <span>吴海艳</span>
          <span></span>
          <span class="tel">18510036026</span></div>
        <div class="detail" id="addressTop">
          <span>收货地址：</span>
          <span></span>
          <span>北京</span>
          <span>北京</span>
          <span>大兴</span>
          <span>黄村</span>
          <span>黄村 狼垡长丰园一区3号楼1单元201</span></div>
      </div>
      <div class="cell fixed align-center">
        <div class="nav"></div>
      </div>
    </div>
    <div class="order-order">
	  <?php if(is_array($goodsList)): $i = 0; $__LIST__ = $goodsList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$goods): $mod = ($i % 2 );++$i;?><div class="order-item">
        <div class="order-itemInfo mui-flex">
          <div class="cell fixed item-pic">
            <div class="img-cell">
              <div class="img" style="background-image:url(__PUBLIC__/Uploads/<?php echo ($goods["image"]); ?>);"></div>
            </div>
          </div>
          <div class="content cell">
            <div class="title"><?php echo ($goods["name"]); ?></div>
            <span></span>
            <div class="sku-info">
              <span></span>
            </div>
            <div class="sku-level-info"></div>
            <div class="icon-ext">
              <div class="item-prepay-tip"><?php echo ($goods["goods_desc"]); ?></div></div>
            <div class="icon-main mui-flex align-center"></div>
            <span></span>
          </div>
          <div class="ext cell fixed item-pay">
            <div class="price">
              <span class="dollar">￥</span>
              <span class="main-price"><?php echo sprintf("%.2f",$goods['price']);?></span>
            </div>
            <div class="quantity">
              <span>X</span>
              <span><?php echo ($goods["num"]); ?></span></div>
            <div class="weight hide">共0.800kg</div></div>
        </div>
      </div><?php endforeach; endif; else: echo "" ;endif; ?>
      <div class="deliverBox">
        <div class="order-deliveryMethod select">
          <label class="buy-single-row mui-flex align-center">
            <div class="title cell fixed">快递费</div>
            <div class="content cell">
              <div class="select-face">￥0.00（包邮）</div>
            </div>
          </label>
        </div>
      </div>
      <div class="order-submitOrder">
		  <div class="mui-flex align-center">
		    <div class="cell realPay">
		      <div class="realPay-wrapper">
		        <span>共</span>
		        <span class="count"><?php echo ($buy_info["goods_count"]); ?></span>
		        <span>件，</span>
		        <span>总金额</span>
		        <span class="price">
		          <span class="dollar">￥</span>
		          <span class="main-price"><?php echo ($buy_info["total_price"]); ?></span>
		        </span>
		      </div>
		    </div>
		    <div class="cell fixed action">
		      <div class="mui-flex align-center">
		        <span title="提交订单" onclick="addOrder()">提交订单</span></div>
		    </div>
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
    <script src="<?php echo ($StaticJs); ?>main.js "></script>
    <script src="<?php echo ($StaticDir); ?>mui/js/mui.min.js "></script>
	<script src="<?php echo ($StaticDir); ?>mui/js/mui.view.js "></script>
    <script language="javascript" type="text/javascript">
    	mui.init({
			keyEventBind: {
				backbutton: true  //开启back按键监听
			}
		});
    </script>
  </body>
</html>
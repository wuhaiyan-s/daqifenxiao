<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,minimum-scale=1,user-scalable=no">
    <meta content="telephone=no" name="format-detection">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <title>商品结算</title>
    <link rel="stylesheet" type="text/css" href="<?php echo ($StaticDir); ?>iconfont/iconfont.css">
    <link rel="stylesheet" type="text/css" href="<?php echo ($StaticDir); ?>mui/css/mui.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo ($StaticDir); ?>mui/css/mui.picker.css" rel="stylesheet" />
	<link rel="stylesheet" type="text/css" href="<?php echo ($StaticDir); ?>mui/css/mui.poppicker.css" rel="stylesheet" />
    <link href="<?php echo ($StaticCss); ?>base.css" type="text/css" rel="stylesheet">
    <link href="<?php echo ($StaticCss); ?>buy.css" type="text/css" rel="stylesheet">
  </head>
  <body>
    <header class="mui-bar mui-bar-nav headerTop">
      <a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left"></a>
      <h1 class="mui-title">商品结算</h1>
    </header>
    <div class="order-address mui-flex align-center" id="address_1">
	    <input type="hidden" id="userinfo_name" value="<?php echo ($user["username"]); ?>"/>
	    <input type="hidden" id="userinfo_phone" value="<?php echo ($user["phone"]); ?>"/>
	    <input type="hidden" id="userinfo_address" value="<?php echo ($user["address"]); ?>"/>
	    <input type="hidden" id="userinfo_postcode" value="<?php echo ($user["postcode"]); ?>"/>
      <div class="cell fixed align-center">
        <div class="icon"></div>
      </div>
      <div class="cell content">
        <div class="info">
          <span>收货人：</span>
          <span id="shouhuoren_txt"><?php echo ($user["username"]); ?></span>
          <span></span>
          <span class="tel" id="phone_txt"><?php echo ($user["phone"]); ?></span>
        </div>
        <div class="detail" id="addressTop">
          <span>收货地址：</span>
          <span id="address_txt"><?php echo ($user["address"]); ?> <?php echo ($user["postcode"]); ?></span>
        </div>
        <?php if(empty($user["address"])): ?><a href="javascript:void(0);" id="addressEditBtn" onclick="editAdress(0)">添加</a>
        <?php else: ?>
        	<a href="javascript:void(0);" id="addressEditBtn" onclick="editAdress(1)">修改</a><?php endif; ?>
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
		        <span onclick="addOrder()">提交订单</span></div>
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
    <div id="addressBox">
	    <header class="mui-bar mui-bar-nav">
			<a class="mui-icon mui-icon-left-nav" href="javascript:void(0);" onclick="backToBuy();"></a>
			<h1 class="mui-title">修改收货人地址</h1>
		</header>
    	<ul class="mui-table-view" id="selectBox">
			<li class="mui-input-row mui-table-view-cell" id="city_s">
				<label class="mui-navigate-right">城市及辖区</label><span id="city_input"><?php echo ($address1); ?></span>
			</li>
			<li class="mui-input-row mui-table-view-cell">
				<label>详细地址</label>
				<input type="text" placeholder="" id="street_input" value="<?php echo ($address2); ?>">
			</li>
			<li class="mui-input-row mui-table-view-cell">
				<label>收货人姓名</label>
				<input type="text" placeholder="" id="shouhuoren_input" value="<?php echo ($user["username"]); ?>">
			</li>
			<li class="mui-input-row mui-table-view-cell">
				<label>收货人手机号</label>
				<input type="text" placeholder="" id="phone_input" value="<?php echo ($user["phone"]); ?>">
			</li>
			<li class="mui-input-row mui-table-view-cell">
				<label>邮编</label>
				<input type="text" placeholder="" id="postcode_input" value="<?php echo ($user["postcode"]); ?>">
			</li>
		</ul>
		<a id="saveBtn" onclick="saveAddress()">确定</a>
    </div>
    <script src="<?php echo ($StaticJs); ?>main.js "></script>
    <script src="<?php echo ($StaticDir); ?>mui/js/mui.min.js "></script>
	<script src="<?php echo ($StaticDir); ?>mui/js/mui.view.js "></script>
	<script src="<?php echo ($StaticDir); ?>mui/js/mui.picker.js "></script>
	<script src="<?php echo ($StaticDir); ?>mui/js/mui.poppicker.js "></script>
	<script src="<?php echo ($StaticJs); ?>city_data.js "></script>
    <script language="javascript" type="text/javascript">
    	mui.init({
			keyEventBind: {
				backbutton: true  //开启back按键监听
			}
		});
		(function($, doc) {
			$.init();
			$.ready(function() {
				//级联示例
				var cityPicker3 = new $.PopPicker({
					layer: 3
				});
				cityPicker3.setData(cityData3);
				var showCityPickerButton = doc.getElementById('city_s');
				var cityResult3 = doc.getElementById('city_input');
				showCityPickerButton.addEventListener('tap', function(event) {
					cityPicker3.show(function(items) {
						cityResult3.innerText = (items[0] || {}).text + "," + (items[1] || {}).text + "," + (items[2] || {}).text;
						//返回 false 可以阻止选择框的关闭
						//return false;
					});
				}, false);
			});
		})(mui, document);
		
		
		$(function(){
			var w = $(document).width(),
				h = $(document).height();
			$('#addressBox').width(w).height(h);
		});
		function editAdress(isEdit)
		{
			$('#addressBox').show();
			if( isEdit == 0 ){
				$('#addressBox h1').html('添加收货人地址');
			}else{
				$('#addressBox h1').html('修改收货人地址');
			}
		}
		
		function saveAddress()
		{
			var userdata = {},
				city_input       = $('#city_input').text(),
				street_input     = $('#street_input').val(),
				shouhuoren_input = $('#shouhuoren_input').val(),
				phone_input      = $('#phone_input').val(),
				postcode_input   = $('#postcode_input').val();
				
			if( shouhuoren_input == '' ){
				showMsg('收货人姓名不能为空','alert');
				return;
			}
			if( phone_input == '' ){
				showMsg('收货人手机号不能为空','alert');
				return;
			}
			if( phone_input.length < 11 ){
				showMsg('收货人手机号格式不正确','alert');
				return;
			}
			if( city_input == ''  ){
				showMsg('请选择城市和辖区','alert');
				return;
			}
			if( street_input == ''  ){
				showMsg('请填写详细地址','alert');
				return;
			}
			if( postcode_input == '' ){
				showMsg('邮编不能为空','alert');
				return;
			}
			if( postcode_input.length < 6 ){
				showMsg('邮编格式不正确','alert');
				return;
			}
			$('#userinfo_name').val(shouhuoren_input);
			$('#shouhuoren_txt').text(shouhuoren_input);
			
			$('#userinfo_phone').val(phone_input);
			$('#phone_txt').text(phone_input);
			
			$('#userinfo_address').val(city_input+','+street_input);
			$('#userinfo_postcode').val(postcode_input);
			$('#address_txt').text(city_input+','+street_input+' '+postcode_input);
			backToBuy();
		}
		
		function backToBuy()
		{
			$('#addressBox').hide();
		}
    </script>
  </body>
</html>
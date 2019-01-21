<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
<meta http-equiv="Content-Type"content="text/html; charset=UTF-8">
<meta name="viewport"content="width=device-width,height=device-height,inital-scale=1.0,maximum-scale=1.0,user-scalable=no;">
<meta name="apple-mobile-web-app-capable"content="yes">
<meta name="apple-mobile-web-app-status-bar-style"content="black">
<meta name="format-detection"content="telephone=no">
<title>订单支付</title>
<link href="<?php echo ($StaticCss); ?>pay.css" rel="stylesheet" type="text/css">
</head>
<body>
<script language="javascript">
document.addEventListener('WeixinJSBridgeReady', function onBridgeReady() {
	WeixinJSBridge.call('hideOptionMenu');
});
function callpay()
{
	WeixinJSBridge.invoke(
		'getBrandWCPayRequest',
		<?php echo ($jsApiObj); ?>,
		function(res){
			WeixinJSBridge.log(res.err_msg);
			if(res.err_msg=='get_brand_wcpay_request:ok')
			{
				document.getElementById('payDom').style.display='none';
				document.getElementById('successDom').style.display='';
				setTimeout("window.location.href = '<?php echo ($returnUrl); ?>'",2000);
			}
			else
			{
				document.getElementById('payDom').style.display='none';
				document.getElementById('failDom').style.display='';
				alert( JSON.stringify(res) );
				document.getElementById('failRt').innerHTML=res.err_code+'|'+res.err_desc+'|'+res.err_msg;
			}
		});
}

</script>
<div class="cpbiaoge">
	<h1>订单支付</h1>
</div>
<div class="cardexplain" style="margin-bottom: 0px;">
	<ul class="round"  style="margin-left:0;margin-right:0;">
		<li class="title mb"><span class="none">收货人信息</span></li>
		<li class="nob">
			<table>
				<tr><td>姓名：<?php echo ($shouhuoname); ?></td></tr>
				<tr><td>电话：<?php echo ($phone); ?></td></tr>
				<tr><td>地址：<?php echo ($address); ?> <?php echo ($postcode); ?></td></tr>
			</table>
		</ul>
</div>
<div class="totalprice">总计：<span><?php echo ($totalprice); ?></span>元</div>
<div id="payDom"class="cardexplain">
	<div class="footReturn"style="text-align:center">
		<a href="javascript:void(0)" onclick="callpay()" class="payBtn submit">微信支付</a>
	</div>
</div>
<div id="failDom"style="display:none"class="cardexplain">
	<ul class="round">
		<li class="title mb"><span class="none">支付结果</span></li>
		<li class="nob">
			<table width="100%"border="0"cellspacing="0"cellpadding="0"class="kuang">
				<tr><th>支付失败</th><td><div id="failRt"></div></td></tr>
			</table>
		</li>
	</ul>
	<div class="footReturn"style="text-align:center">
		<a href="javascript:void(0)" onclick="callpay()" class="payBtn submit">重新进行支付</a>
	</div>
</div>
<div id="successDom"style="display:none"class="cardexplain">
	<ul class="round"><li class="title mb"><span class="none">支付成功</span></li>
	<li class="nob">
		<table width="100%"border="0"cellspacing="0"cellpadding="0"class="kuang">
			<tr><th>您已支付成功，页面正在跳转...</td></tr>
		</table>
		<div id="failRt"></div>
	</li>
	</ul>
</div>
</body>
</html>
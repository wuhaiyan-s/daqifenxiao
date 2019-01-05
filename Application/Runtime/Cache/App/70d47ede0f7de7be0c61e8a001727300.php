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
<link rel="stylesheet" type="text/css" href="./Public/Static/mui/css/mui.min.css">
<link href="./Public/Static/css/base.css" type="text/css" rel="stylesheet">
<link href="./Public/Static/css/sale_top.css" type="text/css" rel="stylesheet">
</head>
<body>
<header class="mui-bar mui-bar-nav headerTop">
	<a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left"></a>
	<h1 class="mui-title">
				<?php $wx_info = json_decode($user['wx_info'],true); $nickname = $wx_info['nickname']; echo $nickname; ?>的销售</h1>
</header>
<nav class="topNav">
	<div class="timeline"><i class="mui-icon mui-icon-arrowleft"></i><span>2018-12</span><i class="mui-icon mui-icon-arrowright"></i></div>
	<strong class="totalget">￥<?php echo ($all_price); ?>7088.00</strong>
	<div class="money_info">
		<li><span>个人销售佣金</span><b>￥1400.00</b></li>
		<li><span>团队贡献佣金</span><b>￥5688.00</b></li>
		<div class="clearfix"></div>
	</div>
</nav>
<div class="sale_info">
	<h3>总销售额<b>￥509888.00</b></h3>
	<ul class="mui-table-view sale_list">
		<?php if(is_array($top_info)): $i = 0; $__LIST__ = $top_info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$top_info): $mod = ($i % 2 );++$i;?><li class="mui-table-view-cell mui-media">
			<a href="javascript:;">
				<?php $wx_info = json_decode($top_info['wx_info'],true); $img = !empty($wx_info['headimgurl'])?$wx_info['headimgurl']:'../Public/Static/images/defult.jpg'; echo "<img src='".$img."' width='40px;' height='40px;' class='mui-media-object mui-pull-left'>"; ?>
				<div class="mui-media-body">
					<p class="mui-ellipsis">
						<span>昵称：<?php echo $wx_info['nickname']; ?></span>
						<span>级别：<?php echo ($top_info["total"]); ?></span>
						<span>销售额：<i><?php echo ($top_info["total"]); ?></i></span>
					</p>
				</div>
			</a>
		</li><?php endforeach; endif; else: echo "" ;endif; ?>
	</ul>
</div>
<script src="./Public/Static/mui/js/mui.min.js "></script>
<script src="./Public/Static/mui/js/mui.view.js "></script>
<script language="javascript" type="text/javascript">
	mui.init({
		keyEventBind: {
			backbutton: true  //开启back按键监听
		}
	});
</script>
</body>
</html>
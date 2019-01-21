<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,minimum-scale=1,user-scalable=no">
<meta content="telephone=no" name="format-detection">
<meta name="apple-touch-fullscreen" content="yes">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<title>我的销售</title>
<link rel="stylesheet" type="text/css" href="<?php echo ($StaticDir); ?>mui/css/mui.min.css">
<link href="<?php echo ($StaticCss); ?>base.css" type="text/css" rel="stylesheet">
<link href="<?php echo ($StaticCss); ?>sale_top.css" type="text/css" rel="stylesheet">
</head>
<body>
<header class="mui-bar mui-bar-nav headerTop">
	<a  href="<?php echo U('Member/index');?>" class="mui-icon mui-icon-left-nav mui-pull-left"></a>
	<h1 class="mui-title">
				<?php $wx_info = json_decode($user['wx_info'],true); $nickname = $wx_info['nickname']; echo $nickname; ?>的销售</h1>
</header>
<nav class="topNav">
	<div class="timeline"><i class="mui-icon mui-icon-arrowleft" onclick="showPreMonthSale()"></i><span id="current_month" m="<?php echo ($currentM); ?>" y="<?php echo ($currentY); ?>"><?php echo ($month); ?></span><i class="mui-icon mui-icon-arrowright" onclick="showNextMonthSale()"></i></div>
	<strong class="totalget">￥<?php echo ($all_sale); ?></strong>
	<div class="money_info">
		<li><span>团队销售总额</span><b>￥<?php echo ($team_sale["team_sale"]); ?></b></li>
		<li><span>团队贡献佣金</span><b>￥<?php echo ($team_sale["yongjin"]); ?></b></li>
		<div class="clearfix"></div>
	</div>
</nav>
<div class="sale_info">
	<h3 class="hide">总销售额<b>￥<?php echo ($all_sale); ?></b></h3>
	<ul class="mui-table-view sale_list">
		<li class="mui-table-view-cell mui-media">
			<a href="javascript:;">
				<?php $wx_info = json_decode($user['wx_info'],true); $img = !empty($wx_info['headimgurl'])?$wx_info['headimgurl']:'./images/user_headimg.png'; echo "<img src='".$img."' width='40px;' height='40px;' class='mui-media-object mui-pull-left'>"; ?>
				<div class="mui-media-body">
					<p class="mui-ellipsis">
						<span>昵称：<?php echo $wx_info['nickname']; ?></span>
						<span>销售额：<i><?php echo ($my_sale); ?></i></span>
					</p>
				</div>
			</a>
		</li>
		<?php if(is_array($top_info)): $i = 0; $__LIST__ = $top_info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$top_info): $mod = ($i % 2 );++$i;?><li class="mui-table-view-cell mui-media">
			<a href="javascript:;">
				<?php $wx_info = json_decode($top_info['wx_info'],true); $img = !empty($wx_info['headimgurl'])?$wx_info['headimgurl']:'./images/user_headimg.png'; echo "<img src='".$img."' width='40px;' height='40px;' class='mui-media-object mui-pull-left'>"; ?>
				<div class="mui-media-body">
					<p class="mui-ellipsis">
						<span>昵称：<?php echo $wx_info['nickname']; ?></span>
						<span>级别：<?php echo $level_type[$top_info['level_type']];?></span>
						<span>销售额：<i><?php echo ($top_info["sale"]); ?></i></span>
					</p>
				</div>
			</a>
		</li><?php endforeach; endif; else: echo "" ;endif; ?>
	</ul>
</div>
<script src="<?php echo ($StaticJs); ?>jquery.min.js "></script>
<script src="<?php echo ($StaticDir); ?>mui/js/mui.min.js "></script>
<script language="javascript" type="text/javascript">
	var maxMonth = <?php echo ($maxMonth); ?>;
	var maxYear  = <?php echo ($maxYear); ?>;
	
	mui.init({
		keyEventBind: {
			backbutton: true  //开启back按键监听
		}
	});
	
	//显示上月的销量
	function showPreMonthSale()
	{
		var current_y = $('#current_month').attr('y');
		var current_m = $('#current_month').attr('m');
		var pre_y = parseInt(current_y);
		var pre_m = parseInt(current_m) - 1;
		if( pre_m < 1 ){
			pre_m = 12;
			pre_y = pre_y - 1;
		}
		if(  pre_y < 2018 ){
			return;
		}
		var pre_month = pre_y + '-' + pre_m;
		window.location.href = "<?php echo U('Member/sale');?>&month="+pre_month;
	}
	
	//显示下月的销量
	function showNextMonthSale()
	{
		var current_y = $('#current_month').attr('y');
		var current_m = $('#current_month').attr('m');
		var next_y = parseInt(current_y);
		var next_m = parseInt(current_m) + 1;
		if( next_m > 12 ){
			next_m = 1;
			next_y = next_y + 1;
		}
		if( next_m >= maxMonth && next_y > maxYear ){
			return;
		}
		var next_month = next_y + '-' + next_m;
		window.location.href = "<?php echo U('Member/sale');?>&month="+next_month;
	}
</script>
</body>
</html>
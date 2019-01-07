<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><?php echo ($info["name"]); ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link href="/Application/Tpl/App/default/Public/Static/css/foods.css?t=333" rel="stylesheet" type="text/css">
<script type="text/javascript" src="/Application/Tpl/App/default/Public/Static/js/jquery.min.js"></script>
<script type="text/javascript" src="/Application/Tpl/App/default/Public/Static/js/wemall.js?222"></script>
<script type="text/javascript" src="/Application/Tpl/App/default/Public/Static/js/alert.js"></script>
<script type="text/javascript" src="/Application/Tpl/App/default/Public/Static/js/area.js"></script>
<script type="text/javascript">
var appurl = '__APP__';
var rooturl = '__ROOT__';
</script>
</head>
<body class="sanckbg mode_webapp">
	<div id="menu-container" style="display: none;">
		<div class="menu_header">
			<div class="menu_topbar">
				<div id="menu" class="sort sort_on">
					<a href=""><?php echo ($info["name"]); ?></a>
					<ul>
						<?php if(is_array($menu)): $i = 0; $__LIST__ = $menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menuid): $mod = ($i % 2 );++$i;?><li><a href="javascript:showProducts('<?php echo ($menuid["id"]); ?>')"><?php echo ($menuid["name"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
						<li><a href="javascript:showAll()">所有商品</a></li>
					</ul>
				</div>
				<a class="head_btn_right" href="javascript:showMenu();"><i class="menu_header_home"></i> </a>
			</div>
		</div>
		<div class="gonggao">
			<div class="hot">
				<strong>公告</strong>
			</div>
			<div class="content"><?php echo ($info["notification"]); ?></div>
		</div>
		<section class="menu">
			<section class="list listimg">
				<dl>
					<!--dt>菜单</dt-->
					<div class="ccbg">
						<dd menu="<?php echo ($goods["menu_id"]); ?>" style="display:none;">
							<div class="tupian">
								<img src="__PUBLIC__/Uploads/<?php echo ($goods["image"]); ?>"
									onclick="showDetail('<?php echo ($goods["id"]); ?>');"> <a
									href="javascript:doProduct('<?php echo ($goods["id"]); ?>','<?php echo ($goods["name"]); ?>','<?php echo ($goods["price"]); ?>','<?php echo ($goods["commision"]); ?>');" class="add"><p
										class="dish2"><?php echo ($goods["name"]); ?></p>
									<p class="price2"><?php echo ($goods["price"]); ?>元/份</p>
									<p>
										<del><?php echo ($goods["old_price"]); ?>元/份</del>
									</p></a>
							</div>
							<a href="javascript:doProduct('<?php echo ($goods["id"]); ?>','<?php echo ($goods["name"]); ?>','<?php echo ($goods["price"]); ?>','<?php echo ($goods["commision"]); ?>');" id="<?php echo ($goods["id"]); ?>" class="reduce" style="display: block;"><b class="ico_reduce">减一份</b></a>
						</dd>
						
						<script>
						window.onload=function(){
							showDetail('<?php echo ($goods["id"]); ?>');
							doProduct('<?php echo ($goods["id"]); ?>','<?php echo ($goods["name"]); ?>','<?php echo ($goods["price"]); ?>','<?php echo ($goods["commision"]); ?>');
							$('#cart').click();
						}
						</script>

						
						
					</div>
				</dl>
			</section>

			
			<div id="mcover" onClick="document.getElementById('mcover').style.display='';">
				<div id="Popup" style="display: block;">
					<div class="imgPopup">
						<img id="detailpic" src="">
						<!--h3 id="detailtitle"></h3-->
						<p class="jianjie" id="detailinfo"></p>
					</div>
				</div>
				<a class="close" onClick="document.getElementById('mcover').style.display='';" style="display: none;">X</a>
			</div>

		</section>
	</div>

	<div id="cart-container" style="display: block;">
		<div class="menu_header">
			<div class="menu_topbar">
				<div id="menu" class="sort">
					<a href="">购买</a>
				</div>
			</div>
		</div>
		
		<img style="width:100%;" src='./Public/Uploads/<?php echo ($goods["image"]); ?>'>

		<section class="order">
			<div class="orderlist">

				<ul id="ullist">
					<dt  style="display:none;">已选购的</dt>
				</ul>
				
				<ul>
					<li class="ccbg2" >今日限购剩余：<span style='color:red'><?php echo ($buy_cnt); ?></span>份</li>
					<?php if($buy_cnt == 0): ?><li class="ccbg2" style='color:red'>很抱歉，今天的货已经卖完了，明天请早吧</li><?php endif; ?>
					<li class="ccbg2" id="emptyLii">原价￥<span><?php echo ($goods["old_price"]); ?></span>元/份；现价￥<span><?php echo ($goods["price"]); ?></span>元/份</li>
				</ul>
				<?php if($buy_cnt != 0): ?><ul id="cartinfo">
					<dt>购物车总计</dt>
					<li class="ccbg2" id="emptyLii">已选：<span id="totalNum">0</span>份　共计：￥<span id="totalPrice">0</span>元</li>
					<li style="display:none"><span id="totalLirun">0</span></li>
				</ul><?php endif; ?>
				<div class="twobtn">
					<div class="footerbtn">
						<a class="del right3" href="./index.php?g=App&m=Index&a=listsp&id=1">返回首页</a>
					</div>
					<div class="footerbtn">
						<a class="submit left3" onClick="clearCache()">清空</a>
					</div>
					<div class="clr"></div>
				</div>
			</div>
<?php if($buy_cnt != 0): ?><form name="infoForm" id="infoForm" method="post" action="">
				<div class="contact-info">
					<ul>
						<li class="title">联系信息</li>
						<li>
							<table style="padding: 0; margin: 0; width: 100%;">
								<tbody>
									<tr>
										<td width="90px"><label for="name" class="ui-input-text"><span style="color:red">*</span>联系人：</label></td>
										<td>
											<div class="ui-input-text">
												<input id="name" name="name" placeholder="" value="<?php echo ($users["username"]); ?>" type="text"
													class="ui-input-text">
											</div></td>
									</tr>

									<tr>
										<td width="90px"><label for="phone" class="ui-input-text"><span style="color:red">*</span>联系电话：</label></td>
										<td>
											<div class="ui-input-text">
												<input id="phone" name="phone" placeholder="" value="<?php echo ($users["phone"]); ?>" type="tel"
													class="ui-input-text">
											</div>
										</td>
									</tr>
									<!--tr>
										<td width="80px"><label for="pay" class="ui-input-text">支付方式：</label></td>
										<td colspan="2"><select name="pay" class="selectstyle"
											id="select1">
												<option value="0">货到付款</option>
												<?php if($alipay == 1): ?><option value="1">支付宝在线支付</option><?php endif; ?>
												<option value="2">微信支付</option>
										</select></td>
									</tr>
									<tr>
										<td width="90px"><label for="weixin" class="ui-input-text">微信号：</label></td>
										<td>
											<div class="ui-input-text">
												<input id="weixin" name="weixin" placeholder="" value="<?php echo ($users["weixin"]); ?>" type="text"
													class="ui-input-text">
											</div></td>
									</tr-->
									<tr>
										<td width="90px"><label for="address"
											class="ui-input-text"><span style="color:red">*</span>联系地址：</label></td>
										<td>
												<select id="s_province" name="s_province"></select>  
												<select id="s_city" name="s_city" ></select>  
												<select id="s_county" name="s_county"></select>
												<script type="text/javascript">_init_area();</script>
												<div id="show"></div>
												
												<textarea id="address" name="address" placeholder=""
												value="" class="ui-input-text"></textarea>
										</td>
									</tr>
									
									<script type="text/javascript">
									var Gid  = document.getElementById ;
									var showArea = function(){
										Gid('show').innerHTML = "<h3>省" + Gid('s_province').value + " - 市" + 	
										Gid('s_city').value + " - 县/区" + 
										Gid('s_county').value + "</h3>"
																}
									Gid('s_county').setAttribute('onchange','showArea()');
									</script>

									<tr>
										<td width="90px"><label for="note" class="ui-input-text">备注：</label></td>
										<td><textarea name="note" placeholder="" class="ui-input-text" value="建议留下您的QQ号、微信号及此次购物的补充说明。"></textarea></td>
									</tr>
								</tbody>
							</table>

							<div class="footReturn">
								<a id="showcard" class="submit" href="javascript:submitOrder();">立即购买</a>
							</div>

						</li>
					</ul>
				</div>
			</form><?php endif; ?>
		</section>
		<!-- 正在提交数据 -->
		<div id="menu-shadow" hidefocus="true"
			style="display: none; z-index: 10;">
			<div class="btn-group"
				style="position: fixed; font-size: 12px; width: 220px; bottom: 80px; left: 50%; margin-left: -110px; z-index: 999;">
				<div class="del" style="font-size: 14px;">
					<img src="/Application/Tpl/App/default/Public/Static/images/ajax-loader.gif" alt="loader">正在提交订单...
				</div>
			</div>
		</div>
	</div>
	<div id="user-container" style="display: none;">

		<div class="menu_header">
			<div class="menu_topbar">
				<div id="menu" class="sort ">
					<a href="">查看我的订单</a>
				</div>
			</div>
		</div>
		<div>
			<ul class="round" style="margin:0;padding:0;border-radius:0;border:0px;border-bottom:1px solid #C6C6C6">
				<table width="100%" border="0" cellpadding="0" cellspacing="0" class="cpbiaoge">
					<tr>
						<td> <span>订单详情</span> <span style='float:right'><a href='./index.php?g=App&m=Index&a=index_info'>继续购物>>></a></span> </td>
					</tr>
				</table>
			</ul>
		</div>
		<div class="cardexplain">
			<div id="page_tag_load" hidefocus="true"
				style="display: none; z-index: 10;">
				<div class="btn-group"
					style="position: fixed; font-size: 12px; width: 220px; bottom: 80px; left: 50%; margin-left: -110px; z-index: 999;">
					<div class="del" style="font-size: 14px;">
						<img src="/Application/Tpl/App/default/Public/Static/images/ajax-loader.gif" alt="loader">正在获取订单...
					</div>
				</div>
			</div>
			<ul class="round"  id="orderlistinsert" style='color:#000;font-size:12px;'>
				<!--插入订单ul-->
			</ul>
		</div>
	</div>
	<div class="footermenu" style='display:none;'>
		<ul>
			<li><a class="active" href="./index.php?g=App&m=Index&a=index_info"> <img
					src="/Application/Tpl/App/default/Public/Static/images/home.png">
					<p>首页</p>
			</a></li>

			<li id="cart"><a href="javascript:void(0);"> <span class="num" id="cartN2"  style="display:none;">0</span> <img
					src="/Application/Tpl/App/default/Public/Static/images/cart.png">
					<p>购买</p>
			</a></li>
			<li id="user"><a href="javascript:void(0);"> <img src="/Application/Tpl/App/default/Public/Static/images/user.png">
					<p>我的</p>
			</a></li>
		</ul>
	</div>
</body>
</html>
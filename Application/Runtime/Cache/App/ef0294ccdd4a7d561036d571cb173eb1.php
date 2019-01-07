<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,minimum-scale=1,user-scalable=no">
<meta content="telephone=no" name="format-detection">
<meta name="apple-touch-fullscreen" content="yes">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<title><?php echo ($goods["name"]); ?></title>
<link href="<?php echo ($StaticCss); ?>base.css" type="text/css" rel="stylesheet">
<link href="<?php echo ($StaticCss); ?>carousel.css" type="text/css" rel="stylesheet">
<link href="<?php echo ($StaticCss); ?>detail.css" type="text/css" rel="stylesheet">
<link href="<?php echo ($StaticDir); ?>mui/css/mui.min.css" type="text/css" rel="stylesheet">
<script src="<?php echo ($StaticJs); ?>jquery3.min.js" language="javascript" type="text/javascript"></script>
<script src="<?php echo ($StaticDir); ?>bootstrap/js/bootstrap.min.js" language="javascript" type="text/javascript"></script>
<script src="<?php echo ($StaticDir); ?>mui/js/mui.min.js" language="javascript" type="text/javascript"></script>
<script src="<?php echo ($StaticJs); ?>main.js" language="javascript" type="text/javascript"></script>
</head>
<body>
<div class="index-con">
	<div id="head" class="header-dom"><div class="mui-flex main-dom"><div class="left-btns"><a href="./index.php?g=App&m=Index&a=index" class="icon-link back-link"><svg t="1516605784224" class="icon" style="" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="1221" xmlns:xlink="http://www.w3.org/1999/xlink" width="200" height="200"><defs><style type="text/css"></style></defs><path d="M393.390114 512.023536l347.948667-336.348468c20.50808-19.85828 20.50808-51.997258 0-71.792093-20.507056-19.826558-53.778834-19.826558-74.28589 0L281.990954 476.135164c-20.476357 19.826558-20.476357 51.981908 0 71.746044l385.061936 372.236839c10.285251 9.91379 23.728424 14.869662 37.173644 14.869662 13.446243 0 26.889417-4.956895 37.112246-14.901385 20.50808-19.826558 20.50808-51.919487 0-71.746044L393.390114 512.023536" p-id="1222"></path></svg> <span>返回</span> </a></div><div class="right-btns"><a href="<?php echo U('Index/cart');?>" class="icon-link cart-link detail-tinycart" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" version="1" viewBox="0 0 1077 1024"><path d="M267 879a70 70 0 1 1 0 139 70 70 0 0 1 0-139zm605 0a70 70 0 1 1 0 139 70 70 0 0 1 0-139zm37-131H255l-50-474h776l-72 474zm145-537a38 38 0 0 0-29-13H197L179 31a38 38 0 0 0-38-34H18v76h89l76 717c2 19 19 34 38 34h720a38 38 0 0 0 38-33l84-549a38 38 0 0 0-9-31z"></path></svg> <span id="cart_num"><?php echo ($cart_num); ?></span> </a>  </div></div></div>
	<div id="carousel-example-generic" class="carousel slide m-slider" data-ride="carousel">
	  <!-- Indicators -->
	  <ol class="carousel-indicators">
	    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
	    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
	  </ol>
	
	  <!-- Wrapper for slides -->
	  <div class="carousel-inner" role="listbox">
	    <div class="item active">
	      <img src="<?php echo ($UploadDir); echo ($goods["image"]); ?>"/>
	      <div class="carousel-caption">
	        1/2
	      </div>
	    </div>
	    <div class="item">
	      <img src="./images/p2.png" alt="">
	      <div class="carousel-caption">
	       	2/2
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
	<div class="module-wrap">   <div class="module-price">  <div class="real-price">  <span class="ui-yen "><i class="price-symbol">¥</i><span class="price"><?php echo ($goods["price"]); ?></span></span>    <span class="icon-text">热销推荐</span>   </div>             </div> </div>
	<div class="module-wrap">
		<div class="module-title">
			<div class="share-warp mui-flex">
			<div class="main cell"><?php echo ($goods["name"]); ?></div>
				<span class="share-div mui-flex share-hidden">
					<div class="share-bd mui-flex">
						<i class="share-icon"></i>
				        <span>分享</span>
	    			</div>
				</span>
			</div>
		</div>
	</div>
	<div class="module-wrap">
		<div class="module-adds">
			<span class="postage"><?php echo ($goods["goods_desc"]); ?></span>
			<span class="sales hide">月销量 5557件</span>
			<span class="delivery desc hide">北京</span>
		</div>
	</div>
	<div class="group-warp">
		<div class="module-desc">
			<div class="scrolltips"><div class="part-title mui-flex align-center"><span class="txt fixed">详情</span></div>
			<div class="container"><?php echo ($goods["detail"]); ?></div>
		</div>
	</div>
	<div id="s-actionBar-container">
		<div class="action-bar-wrap j-bottom-bar  isChaoshi  ">
			<div class="trade isChaoshi">
				<a class="cart" id="addToCart" role="button" onclick="addToCart(<?php echo ($goods["id"]); ?>,'add')">加入购物车</a>
				<a class="tobuy" id="toCart" role="button" onclick="toBuy()">立即购买</a>
			</div>
		</div>
	</div>
</div>
<script language="javascript" type="text/javascript">
	var goods = {};
	goods.id    = <?php echo ($goods["id"]); ?>;
	goods.num   = 1;
	goods.price = "<?php echo ($goods["price"]); ?>";
	goods.image = "<?php echo ($goods["image"]); ?>";
	goods.name  = "<?php echo ($goods["name"]); ?>";
	buydata[<?php echo ($goods['id']); ?>] = goods;
	
	buyinfo.total_price = "<?php echo ($goods['price']); ?>";
	buyinfo.goods_count = 1;	
</script>
</body>
</html>
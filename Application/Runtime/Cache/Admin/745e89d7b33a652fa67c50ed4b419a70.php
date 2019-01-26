<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="cn">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
		<title>直销360微信分销系统后台管理平台</title>
		<meta name="description" content=" 微商城 微信商城" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<!-- basic styles -->
		<link href="__PUBLIC__/Plugin/style/css/bootstrap.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="__PUBLIC__/Plugin/style/css/font-awesome.min.css" />
		<!--[if IE 7]>
		  <link rel="stylesheet" href="__PUBLIC__/Plugin/style/css/font-awesome-ie7.min.css" />
		<![endif]-->
		<!-- ace styles -->
		<link rel="stylesheet" href="__PUBLIC__/Plugin/style/css/ace.min.css" />
		<link rel="stylesheet" href="__PUBLIC__/Plugin/style/css/ace-rtl.min.css" />
		<link rel="stylesheet" href="__PUBLIC__/Plugin/style/css/ace-skins.min.css" />
		<!--[if lte IE 8]>
		  <link rel="stylesheet" href="__PUBLIC__/Plugin/style/css/ace-ie.min.css" />
		<![endif]-->
		<!-- ace settings handler -->
		<script src="__PUBLIC__/Plugin/style/js/ace-extra.min.js"></script>
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		<script src="__PUBLIC__/Plugin/style/js/html5shiv.js"></script>
		<script src="__PUBLIC__/Plugin/style/js/respond.min.js"></script>
		<![endif]-->
		<!-- javascript footer -->
		<!--[if !IE]> -->
		<script type="text/javascript">
			window.jQuery || document.write("<script src='__PUBLIC__/Plugin/style/js/jquery-2.0.3.min.js'>"+"<"+"/script>");
		</script>
		<!-- <![endif]-->
		<!--[if IE]>
		<script type="text/javascript">
		 	window.jQuery || document.write("<script src='__PUBLIC__/Plugin/style/js/jquery-1.10.2.min.js'>"+"<"+"/script>");
		</script>
		<![endif]-->
		<script type="text/javascript">
			if("ontouchend" in document) document.write("<script src='__PUBLIC__/Plugin/style/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="__PUBLIC__/Plugin/style/js/bootstrap.min.js"></script>
		<script src="__PUBLIC__/Plugin/style/js/typeahead-bs2.min.js"></script>
		<!-- page specific plugin scripts -->
		<!--[if lte IE 8]>
		  <script src="__PUBLIC__/Plugin/style/js/excanvas.min.js"></script>
		<![endif]-->
		<script src="__PUBLIC__/Plugin/style/js/jquery-ui-1.10.3.custom.min.js"></script>
		<script src="__PUBLIC__/Plugin/style/js/jquery.ui.touch-punch.min.js"></script>
		<script src="__PUBLIC__/Plugin/style/js/jquery.slimscroll.min.js"></script>
		<script src="__PUBLIC__/Plugin/style/js/jquery.easy-pie-chart.min.js"></script>
		<script src="__PUBLIC__/Plugin/style/js/jquery.sparkline.min.js"></script>
		<script src="__PUBLIC__/Plugin/style/js/flot/jquery.flot.min.js"></script>
		<script src="__PUBLIC__/Plugin/style/js/flot/jquery.flot.pie.min.js"></script>
		<script src="__PUBLIC__/Plugin/style/js/flot/jquery.flot.resize.min.js"></script>
		<!-- ace scripts -->
		<script src="__PUBLIC__/Plugin/style/js/ace-elements.min.js"></script>
		<script src="__PUBLIC__/Plugin/style/js/ace.min.js"></script>
	</head>
	<body>
<link href="<?php echo ($StaticCss); ?>public.css" type="text/css" rel="stylesheet">
<div class="col-sm-12 widget-container-span">
	<div class="widget-box transparent">
		<div class="widget-header">
			<div class="widget-toolbar no-border">
				<ul class="nav nav-tabs" id="myTab">
					<li><a href="<?php echo U('Ad/index');?>">广告管理</a></li>
					<li class="active"><a href="javascript:void(0);">添加/修改广告</a></li>
				</ul>
			</div>
		</div>

		<div class="widget-body">
			<div class="widget-main padding-12 no-padding-left no-padding-right">
				<div class="tab-content padding-4">
					<div id="home1" class="tab-pane in active">
						<form class="form-horizontal J_ajaxForm" enctype="multipart/form-data" id="myform" action="<?php echo U('Admin/Ad/edit');?>" method="post">
							<input type="hidden" name="id" value="<?php echo ($ad["id"]); ?>"/>
							<div class="tabbable">
								<div class="tab-content">
									<div class="tab-pane active">
										<table cellpadding="2" cellspacing="2" width="100%">
											<tbody>
												<tr>
													<td>广告标题:</td>
													<td><input type="text" class="input col-sm-6" name="title" value="<?php echo ($ad["title"]); ?>"></td>
												</tr>
												<tr>
													<td>跳转网址:</td>
													<td><input type="text" class="input col-sm-6" name="url" value="<?php echo ($ad["url"]); ?>"></td>
												</tr>
												<tr>
													<td>广告排序:</td>
													<td><input type="text" class="input col-sm-2" name="sort" value="<?php echo ($ad["sort"]); ?>"></td>
												</tr>
												<tr>
													<td>广告图片:</td>
													<td>
														<li class="imageLi">
															<input multiple="multiple" type="file" name="imagefile" class="imagefile">
															<input type="hidden" value="<?php echo ($ad["image"]); ?>" name="image[imageContent]" class="imagesrc"/>
															<input type="hidden" value="" name="image[imageType]" class="imagetype"/>
															<img src="<?php  if($ad['image']) echo $UploadDir.$ad['image']; else './Public/Uploads/goods_default.png';?>" class="imageimg"/>
														</li>
														<p class="help-block">允许的附件文件类型: jpg,png,jpeg并且图片大小小于200k。</p>
													</td>
												</tr>
												<tr>
													<td>广告状态:</td>
													<td>
														<select name="status">
															<option <?php if($ad['status'] == 1) echo 'selected';?>"  value="1">显示</option>
															<option <?php if($ad['status'] == 0) echo 'selected';?>" value="0">隐藏</option>
														</select>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<div class="form-actions">
								<button class="btn btn-primary btn_submit J_ajax_submit_btn"
									type="submit">提交</button>
								<a class="btn" href="">返回</a>
							</div>
						</form>
					</div>                 
				</div>
			</div>
		</div>
		
		<script type="text/javascript">
			//html5实现图片预览功能
	        $(function () {
	            $(".imagefile").change(function (e) {
		            var fileObj = $(this);
	                var file = e.target.files[0] || e.dataTransfer.files[0];
	                if (file) {
	                    var reader = new FileReader();
	                    reader.readAsDataURL(file);
	                    reader.onload = function () {
		                    fileObj.parent().find('.imageimg').attr('src',this.result);
		                    fileObj.parent().find('.imagesrc').val(this.result);
		                    fileObj.parent().find('.imagetype').val(file.type);
	                    }
	                }
	            });
	        });
		</script>
	</div>
</div>
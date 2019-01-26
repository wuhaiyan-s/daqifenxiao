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
<script type="text/javascript">
var UEURL = '__ROOT__/Public/Plugin/umeditor/';
</script>
<link href="__PUBLIC__/Plugin/umeditor/themes/default/css/umeditor.css" type="text/css" rel="stylesheet">
<script type="text/javascript" src="__PUBLIC__/Plugin/umeditor/third-party/jquery.min.js"></script>
<script type="text/javascript" charset="utf-8" src="__PUBLIC__/Plugin/umeditor/umeditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="__PUBLIC__/Plugin/umeditor/umeditor.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/Plugin/umeditor/lang/zh-cn/zh-cn.js"></script>
<link href="<?php echo ($StaticCss); ?>public.css" type="text/css" rel="stylesheet">
<div class="col-sm-12 widget-container-span">
	<div class="widget-box transparent">
		<div class="widget-header">
			<div class="widget-toolbar no-border">
				<ul class="nav nav-tabs" id="myTab">
					<li class="active"><a data-toggle="tab" href="#home1">商品管理</a></li>
					<li><a data-toggle="tab" href="#home2">添加/修改商品</a></li>
					<li><a data-toggle="tab" href="#home3">重复购买折扣</a></li>
					<li><a data-toggle="tab" href="#home4">分销佣金</a></li>
					<li><a data-toggle="tab" href="#home5">收货/提现</a></li>
				</ul>
			</div>
		</div>

		<div class="widget-body">
			<div class="widget-main padding-12 no-padding-left no-padding-right">
				<div class="tab-content padding-4">
					<div id="home1" class="tab-pane in active">
						<div class="row">
							<div class="col-xs-12 no-padding-right">
								<div class="table-responsive">
									<table id="sample-table-1"
										class="table table-striped table-bordered table-hover">
										<thead>
											<tr>
												<th class="center"><label> <input
														type="checkbox" class="ace"> <span class="lbl"></span>
												</label></th>
												<th>ID</th>
												<th>商品名称</th>
												<th>商品分类</th>
												<th>商品价格</th>
												<th>时间</th>
												<th>操作</th>
											</tr>
										</thead>

										<tbody>
										<?php if(is_array($result)): $i = 0; $__LIST__ = $result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$result): $mod = ($i % 2 );++$i;?><tr>
												<td class="center"><label> <input
														type="checkbox" class="ace"> <span class="lbl"></span>
												</label></td>

												<td><?php echo ($result["id"]); ?></td>
												<td><?php echo ($result["name"]); ?></td>
												<td><?php echo ($result["menu"]); ?></td>
												<td><?php echo ($result["price"]); ?></td>
												<td><?php echo ($result["time"]); ?></td>
												<td><a href="javascript:void(0);" onclick="reGood(<?php echo ($result["id"]); ?>);" class="btn btn-white btn-sm">修改</a><a class="J_ajax_del btn btn-white btn-sm" href="<?php echo U('Admin/Good/delgood',array('id'=>$result['id']));?>">删除</a></td>
											</tr><?php endforeach; endif; else: echo "" ;endif; ?>
										</tbody>
									</table>
									<div class="pagination" style="margin:0px;">
									    <?php echo ($page); ?>
									</div>
								</div>
							</div>
						</div>
					</div>
					
					<div id="home2" class="tab-pane in">
						<form class="form-horizontal J_ajaxForm" enctype="multipart/form-data" id="myform" action="<?php echo U('Admin/Good/addgood');?>" method="post">
							<input type="hidden" name="goodid"/>
							<div class="tabbable">
								<div class="tab-content">
									<div class="tab-pane active">
										<table cellpadding="2" cellspacing="2" width="100%">
											<tbody>
												<tr>
													<td>商品分类:</td>
													<td><select class="select_2" name="addmenuid">
															<?php if(is_array($addmenu)): $i = 0; $__LIST__ = $addmenu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$addmenu): $mod = ($i % 2 );++$i;?><option value="<?php echo ($addmenu["id"]); ?>"><?php echo ($addmenu["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
													</select></td>
												</tr>
												<tr>
													<td>商品名称:</td>
													<td><input type="text" class="input col-sm-6" name="addname" value=""></td>
												</tr>
												<tr>
													<td>促销描述:</td>
													<td><input type="text" class="input col-sm-6" name="goods_desc" value=""></td>
												</tr>
												<tr>
													<td>商品价格:</td>
													<td><input type="text" class="input col-sm-2" name="addprice" value=""></td>
												</tr>
												<tr>
													<td>商品原价:</td>
													<td><input type="text" class="input col-sm-2" name="add_old_price" value=""></td>
												</tr>
												<tr>
													<td>商品佣金:</td>
													<td><input type="text" class="input col-sm-2" name="add_commision" value=""></td>
												</tr>
												<tr>
													<td>商品排序:</td>
													<td><input type="text" class="input col-sm-2" name="addsort" value=""></td>
												</tr>
												<tr>
													<td>商品图片:</td>
													<td>
														<li class="imageLi"><b>图片1</b>
															<input multiple="multiple" type="file" name="goodsimage[0][file]" class="imagefile">
															<input type="hidden" value="" name="goodsimage[0][imageContent]" class="imagesrc"/>
															<input type="hidden" value="" name="goodsimage[0][imageType]" class="imagetype"/>
															<img src="./Public/Uploads/goods_default.png" class="imageimg"/>
															<input type="hidden" value="" name="goodsimage[0][isCover]" class="imagesort"/>
															<span onclick="setCover(0)" class="setCover">设为封面</span><span class="delImg" onclick="delImg(1)">删除图片</span>
														</li>
														<li class="imageLi"><b>图片2</b>
															<input multiple="multiple" type="file" name="goodsimage[1][file]" class="imagefile">
															<input type="hidden" value="" name="goodsimage[1][imageContent]" class="imagesrc"/>
															<input type="hidden" value="" name="goodsimage[1][imageType]" class="imagetype"/>
															<img src="./Public/Uploads/goods_default.png" class="imageimg"/>
															<input type="hidden" value="" name="goodsimage[1][isCover]" class="imagesort"/>
															<span onclick="setCover(1)" class="setCover">设为封面</span><span class="delImg" onclick="delImg(1)">删除图片</span>
														</li>
														<li class="imageLi"><b>图片3</b>
															<input multiple="multiple" type="file" name="goodsimage[2][file]" class="imagefile">
															<input type="hidden" value="" name="goodsimage[2][imageContent]" class="imagesrc"/>
															<input type="hidden" value="" name="goodsimage[2][imageType]" class="imagetype"/>
															<img src="./Public/Uploads/goods_default.png" class="imageimg"/>
															<input type="hidden" value="" name="goodsimage[2][isCover]" class="imagesort"/>
															<span onclick="setCover(2)" class="setCover">设为封面</span><span class="delImg" onclick="delImg(2)">删除图片</span>
														</li>
														<li class="imageLi"><b>图片4</b>
															<input multiple="multiple" type="file" name="goodsimage[3][file]" class="imagefile">
															<input type="hidden" value="" name="goodsimage[3][imageContent]" class="imagesrc"/>
															<input type="hidden" value="" name="goodsimage[3][imageType]" class="imagetype"/>
															<img src="./Public/Uploads/goods_default.png" class="imageimg"/>
															<input type="hidden" value="" name="goodsimage[3][isCover]" class="imagesort"/>
															<span onclick="setCover(3)" class="setCover">设为封面</span><span class="delImg" onclick="delImg(3)">删除图片</span>
														</li>
														<li class="imageLi"><b>图片5</b>
															<input multiple="multiple" type="file" name="goodsimage[4][file]" class="imagefile">
															<input type="hidden" value="" name="goodsimage[4][imageContent]" class="imagesrc"/>
															<input type="hidden" value="" name="goodsimage[4][imageType]" class="imagetype"/>
															<img src="./Public/Uploads/goods_default.png" class="imageimg"/>
															<input type="hidden" value="" name="goodsimage[4][isCover]" class="imagesort"/>
															<span onclick="setCover(4)" class="setCover">设为封面</span><span class="delImg" onclick="delImg(4)">删除图片</span>
														</li>
														<p class="help-block">允许的附件文件类型: jpg,png,jpeg并且图片大小小于200k，图片宽高比例为1:1，第一张图片作为封面图片。</p>
													</td>
												</tr>
												<tr>
													<td>商品状态:</td>
													<td><select name="addstatus"><option value="1">出售</option>
														<option value="0">下架</option></select></td>
												</tr>
												<tr>
													<td>商品详情:</td>
													<td><!--style给定宽度可以影响编辑器的最终宽度-->
														<div type="text/plain" id="myEditor" style="width:660px;height:240px;">
														</div>
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
					
					
					<div id="home3" class="tab-pane in">						
						<div class="row">							
						<div class="col-xs-12 no-padding-right">								
						<form class="form-horizontal" role="form" action="<?php echo U('Admin/Good/setzhekou');?>" method="post">									
						<div class="form-group">										
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 第二次购买以后的折扣： </label>										
						<div class="col-sm-9">											
						<input type="text" id="form-field-1" value="<?php echo ($zhekou); ?>" name="zhekou" class="col-xs-10 col-sm-6">（%，0为没有折扣）										
						</div>									
						</div>									
						<div class="space-4"></div>									
						<div class="clearfix form-actions">										
						<div class="col-md-offset-3 col-md-9">											
						<button class="btn btn-info" type="submit">												
						<i class="icon-ok bigger-110"></i> 提交	</button>&nbsp; &nbsp; &nbsp;<button class="btn" type="reset"><i class="icon-undo bigger-110"></i> 取消</button>
						</div>									
						</div>								
						</form>							
						</div>						
						</div>					
					</div>
					
					<div id="home4" class="tab-pane in">						
						<div class="row">							
						<div class="col-xs-12 no-padding-right">								
						<form class="form-horizontal" role="form" action="<?php echo U('Admin/Good/setyongjin');?>" method="post">									
						<div class="form-group">										
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 一级分销商佣金： </label>										
						<div class="col-sm-9">											
						<input type="text" id="form-field-1" value="<?php echo ($yongjin["yongjin_1"]); ?>" name="yongjin_1" class="col-xs-10 col-sm-6">（%）										
						</div>									
						</div>									
						<div class="space-4"></div>		

						<div class="form-group">										
						<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 二级分销商佣金： </label>										
						<div class="col-sm-9">											
						<input type="text" id="form-field-2" value="<?php echo ($yongjin["yongjin_2"]); ?>" name="yongjin_2" class="col-xs-10 col-sm-6">（%）										
						</div>									
						</div>									
						<div class="space-4"></div>		

						<div class="form-group">										
						<label class="col-sm-3 control-label no-padding-right" for="form-field-3"> 三级分销商佣金： </label>										
						<div class="col-sm-9">											
						<input type="text" id="form-field-3" value="<?php echo ($yongjin["yongjin_3"]); ?>" name="yongjin_3" class="col-xs-10 col-sm-6">（%）										
						</div>									
						</div>									
						<div class="space-4"></div>		

						
						<div class="clearfix form-actions">										
						<div class="col-md-offset-3 col-md-9">											
						<button class="btn btn-info" type="submit">												
						<i class="icon-ok bigger-110"></i> 提交	</button>&nbsp; &nbsp; &nbsp;<button class="btn" type="reset"><i class="icon-undo bigger-110"></i> 取消</button>
						</div>									
						</div>								
						</form>							
						</div>						
						</div>					
					</div>
				
					<div id="home5" class="tab-pane in">						
						<div class="row">							
						<div class="col-xs-12 no-padding-right">								
						<form class="form-horizontal" role="form" action="<?php echo U('Admin/Good/settixian');?>" method="post">									
						<div class="form-group">										
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 发货后多少天自动收货： </label>										
						<div class="col-sm-9">											
						<input type="text" id="form-field-1" value="<?php echo ($tixianinfo["shouhuo"]); ?>" name="shouhuo" class="col-xs-10 col-sm-6">（天）										
						</div>									
						</div>									
						<div class="space-4"></div>		

						<div class="form-group">										
						<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 收货后多少天可提现： </label>										
						<div class="col-sm-9">											
						<input type="text" id="form-field-2" value="<?php echo ($tixianinfo["tixian"]); ?>" name="tixian" class="col-xs-10 col-sm-6">（天）										
						</div>									
						</div>									
						<div class="space-4"></div>		

						<div class="form-group">										
						<label class="col-sm-3 control-label no-padding-right" for="form-field-3"> 多少金额可提现： </label>										
						<div class="col-sm-9">											
						<input type="text" id="form-field-3" value="<?php echo ($tixianinfo["jine"]); ?>" name="jine" class="col-xs-10 col-sm-6">（元）										
						</div>									
						</div>									
						<div class="space-4"></div>		

						<div class="form-group">										
						<label class="col-sm-3 control-label no-padding-right" for="form-field-4"> 每日订单限额： </label>										
						<div class="col-sm-9">											
						<input type="text" id="form-field-4" value="<?php echo ($tixianinfo["dingdan"]); ?>" name="dingdan" class="col-xs-10 col-sm-6">（单）										
						</div>									
						</div>
						
						<div class="clearfix form-actions">										
						<div class="col-md-offset-3 col-md-9">											
						<button class="btn btn-info" type="submit">												
						<i class="icon-ok bigger-110"></i> 提交	</button>&nbsp; &nbsp; &nbsp;<button class="btn" type="reset"><i class="icon-undo bigger-110"></i> 取消</button>
						</div>									
						</div>								
						</form>							
						</div>						
						</div>					
					</div>
				
				</div>
			</div>
		</div>
		
		<script type="text/javascript">
			var flag = true;
			function reGood(goodsId) {
				$.post("<?php echo U('Admin/Good/getgoodid');?>",{"id":goodsId},function(data){
					var json = eval(data);
					$('input[name="goodid"]').val(goodsId);
					$('select[name="addmenuid"]').val(json.menu_id);
					$('input[name="addname"]').val(json.name);
					$('input[name="goods_desc"]').val(json.goods_desc);
					$('input[name="addprice"]').val(json.price);
					$('input[name="add_old_price"]').val(json.old_price);
					$('input[name="add_commision"]').val(json.commision);
					$('input[name="addsort"]').val(json.sort);
					$('select[name="addstatus"]').val(json.status);
					$('#myEditor').html(json.detail);
					var images = JSON.parse(json.images);
					for( var i = 0; i < images.length;i++ ){
						$('.imageimg').eq(i).attr('src',"<?php echo ($UploadDir); ?>"+images[i].src);
						$('.imagetype').eq(i).val(images[i].type);
						$('.imagesrc').eq(i).val(images[i].src);
					}
				});
				$('#myTab li').removeClass("active");
				$('#myTab li').eq(1).addClass("active");
				$('#home1').removeClass("active");
				$('#home2').addClass("active");
			}
		</script>
		<script type="text/javascript">
	    //实例化编辑器
	    var um = UM.getEditor('myEditor');
	    um.addListener('blur',function(){
	        $('#focush2').html('编辑器失去焦点了')
	    });
	    um.addListener('focus',function(){
	        $('#focush2').html('')
	    });
	    
	    //设置为封面
	    function setCover(imgSort)
	    {
		    if( $('.imagesrc').eq(imgSort).val() == '' ){
			    alert('请先上传图片')
			    return;
		    }
		    $('.imagesort').val(0);
		    $('.imagesort').eq(imgSort).val(1);
	    }
	    
	    //删除图片
	    function delImg(imgSort)
	    {
		    $('.imagesrc').eq(imgSort).val(0);
		    $('.imagetype').eq(imgSort).val(0);
		    $('.imageimg').eq(imgSort).attr('src',"<?php echo ($UploadDir); ?>goods_default.png");
	    }
	    
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
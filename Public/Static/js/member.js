var base_url = '';
function login()
{
	var param = {};
	param.username    = $('#username').val();
	param.password = $('#password').val();
	var url = base_url+'/index.php?g=Api&m=Member&a=login';
	$.post(url,param,function(res){
		if( typeof res == 'string' ){
			res = JSON.parse(res);
		}
		if( res.errno == 200 ){
			showMsg(res.errmsg);
			setTimeout(function(){
				window.location.href = base_url+'/index.php?g=App&m=Member&a=index';
			}, 1500);
		}else{
			showMsg(res.errmsg,'alert');
		}
	});
}

//微信授权登录
function wxlogin()
{
	
}

function logout()
{
	var url = base_url+'/index.php?g=Api&m=Member&a=logout';
	$.post(url,function(res){
		if( typeof res == 'string' ){
			res = JSON.parse(res);
		}
		if( res.errno == 200 ){
			showMsg(res.errmsg);
			setTimeout(function(){
				window.location.href = base_url+'/index.php?g=App&m=Member&a=login';
			}, 1000);
		}else{
			showMsg(res.errmsg,'alert');
		}
	});
}

//获取订单
var thisOrderPage  = 1;
var orderTotalPage = 0;
var canLoad        = 1;
function getorders(page)
{
	if( thisOrderPage > orderTotalPage || canLoad == 0 ){
		canLoad = 0;
		showMsg('已经到底了');
		return;
	}
	var url = base_url+'/index.php?g=Api&m=Api&a=getorders&p='+thisOrderPage;
	$.ajax({  
        type : "post",  
        url : url,    
        async : false,  
        success : function(res){  
            var html = '';
			if( typeof res == 'string' ){
				res = JSON.parse(res);
			}
			thisOrderPage++;
			
			if( res.data.length < 1 ){
				if( thisOrderPage == 1 ){
					html += '<ul class="list-card" style="display: block">\
						<div class="empty-block">\
							<div class="empty-title">您还没有相关的订单</div>\
							<div class="empty-content">可以去看看有哪些想买的</div>\
							<div class="empty-btn" style="display: block;"><span>随便逛逛</span></div>\
						</div>\
					</ul>';
				}
				canLoad == 0;
			}else{
				html += '<ul class="list-card" style="display: block;">';
				for( var i = 0; i < res.data.length;i++ ){
					var order = res.data[i];
					var cartdata = order.cartdata;
					if( order.pay_status == 0 ){
						html += '<li class="item-card">\
						<div class="tpl-wrapper orderlist_head">\
					    	<i class="iconfont icon-shangjia shop_icon hide"></i>\
							<span class="shop_name">'+order.orderid+'</span>\
							<span class="order_time">'+order.time+'</span>\
							<span class="order_status"><a href="'+order.pay_url+'">'+order.status+'</a></span>\
					  	</div>';
					}else{
						html += '<li class="item-card">\
						<div class="tpl-wrapper orderlist_head">\
					    	<i class="iconfont icon-shangjia shop_icon hide"></i>\
							<span class="shop_name">'+order.orderid+'</span>\
							<span class="order_time">'+order.time+'</span>\
							<span class="order_status">'+order.status+'</span>\
					  	</div>';
					}
					for( var ci in order.cartdata){
						var cart = order.cartdata[ci];
						var image = cart.image ? UploadDir+cart.image : GoodsImageDefault;
						html += '<div class="orderlist_sub">\
					  		<div class="TImage"><img src="'+image+'"/></div>\
					  		<div class="TText">\
						  		<div class="Ttitle">'+cart.name+'</div>\
						  		<div class="Tdesc"></div>\
						  	</div>\
					  		<div class="TInfo">\
					  			<span class="price">￥'+toDecimal2(cart.price)+'</span>\
					  			<span class="qt">x'+cart.num+'</span>\
					  		</div>\
					  	</div>';
					}
					html += '<div class="orderlist_pay">\
						  		<span class="qt_desc">共'+order.goods_count+'件商品</span>\
						  		<span class="total_price">合计:￥'+order.totalprice+'</span>\
						  	</div>\
						  	<div class="orderlist_btns hide">\
							  	<a href="" class="red_btn fr ml10">确认收货</a>\
						  		<a href="" class="gray_btn fr">物流信息</a>\
						  		<div class="clearfix"></div>\
						  	</div>';
				    html += '</li>';
				}
				html += '</ul>';
			}
			$('#mainBox').append(html);
			orderBoxH = $('#mainBox').height();
        }  
    });
}

//修改密码
function savePwd()
{
	if( $('#oldpassword').val().length < 1 ){
		showMsg('旧密码不能为空','alert');
		return;
	}
	if( $('#password').val().length < 6 ){
		showMsg('新密码长度不得少于6位','alert');
		return;
	}
	var info = $('#infoAuth').serialize();
	var url = base_url + '/index.php?g=Api&m=Member&a=saveInfo';
	$.post(url,info,function(res){
		if( typeof res == 'string' ){
			res = JSON.parse(res);
		}
		if( res.errno == 200 ){
			showMsg(res.errmsg);
			$('#infoAuth input').val('');
		}else{
			showMsg(res.errmsg,'alert');
		}

	});
}
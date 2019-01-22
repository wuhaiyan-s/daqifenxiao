var base_url = '';
var user_id = '';
function isLogin()
{
	return (user_id > 0) ? 1 : 0;
}

//获取根据url获取url中参数值
function getParam(paramName) { 
    paramValue = "", isFound = !1; 
    if (this.location.search.indexOf("?") == 0 && this.location.search.indexOf("=") > 1) { 
        arrSource = unescape(this.location.search).substring(1, this.location.search.length).split("&"), i = 0; 
        while (i < arrSource.length && !isFound) arrSource[i].indexOf("=") > 0 && arrSource[i].split("=")[0].toLowerCase() == paramName.toLowerCase() && (paramValue = arrSource[i].split("=")[1], isFound = !0), i++ 
    } 
    return paramValue == "" && (paramValue = null), paramValue 
}

function toDecimal2(x) { 
	var f = parseFloat(x); 
	if (isNaN(f)) { 
	return false; 
	} 
	var f = Math.round(x*100)/100; 
	var s = f.toString(); 
	var rs = s.indexOf('.'); 
	if (rs < 0) { 
	rs = s.length; 
	s += '.'; 
	} 
	while (s.length <= rs + 2) { 
	s += '0'; 
	} 
	return s; 
} 
  
function showMsg(msg,type,gourl)
{
	switch(type){
		case 'alert':
			mui.alert(msg);
		break;
		default:
			mui.toast(msg);
		break;
	}
	if( gourl != '' && gourl != undefined ){
		setTimeout(function(){
			window.location.href = gourl;
		}, 1500);
	}
}

var buydata = {};//加入结算的所有商品的id
var buyinfo = {};//订单总金额 商品总数量
function toBuy()
{
	if( buyinfo.goods_count  < 1 ){
		showMsg('请先选择要购买的商品.');
		return;
	}

	var url = base_url+'/index.php?g=Api&m=Api&a=addBuyData';
	var param     = {};
	param.buydata = buydata;
	param.buyinfo = buyinfo;
	$.post(url,param,function(res){
		if( typeof res == 'string' ){
			res = JSON.parse(res);
		}
		if( res.errno == 200 ){
			window.location.href = base_url+'/index.php?g=App&m=Member&a=buy';
		}else{
			showMsg(res.errmsg,'alert');
		}
	});
}

//添加新订单-结算
function addOrder()
{
	var url = base_url+'/index.php?g=Api&m=Api&a=addOrder';
	
	var userdata = {},
		userinfo_address = $('#userinfo_address').val();
		
	userdata.name     = $('#userinfo_name').val();
	userdata.phone    = $('#userinfo_phone').val();
	userdata.address  = $('#userinfo_address').val();
	userdata.postcode = $('#userinfo_postcode').val();
	if( userdata.name == '' ){
		showMsg('收货人姓名不能为空','alert');
		return;
	}
	if( userdata.phone.length < 11 ){
		showMsg('收货人手机号格式不正确','alert');
		return;
	}
	if( userdata.address == '' ){
		showMsg('请填写完整的收货人地址','alert');
		return;
	}
	if( userdata.postcode.length == '' ){
		showMsg('邮编不能为空','alert');
		return;
	}
	$.post(url,userdata,function(res){
		if( typeof res == 'string' ){
			res = JSON.parse(res);
		}
		if( res.errno == 200 ){
			window.location.href = res.data;
		}else{
			showMsg(res.errmsg,'alert');
		}
	});
}

//加入购物车
function addToCart(goodsId,type)
{
	if( type == 'add' ){
		//从商品详情页加入购物车
		var num = 1;
	}else{
		var numInput = $('#goods-num-'+goodsId),
			num = parseInt( numInput.val() ),
			goodsBox = $('#grid-order-'+goodsId);
		//增
		if( type === 'increase' ){
			num += 1;
		}
		//减
		if( type === 'decrease' ){
			num -= 1;
		}
		//删
		if( type === 'del' ){
			num = 0;
		}
		if( num == 0 ){//删除购物车中的某一商品
/*
			if( !showMsg('您确定要删除商品吗？','confirm') ){
				//删除商品 
				return;
			}
*/
		}
		
	}
	var param   = {};
	param.id    = goodsId;
	param.num   = num;
	var url = base_url+"/index.php?g=Api&m=Api&a=addToCart";
	$.post(url,param,function(res){
		if( typeof res == 'string' ){
			res = JSON.parse(res);
		}
		if( res.errno != 200 ){
			showMsg(res.errmsg,'alert');
		}else{
			if( num == 0 ){
				$('#grid-order-'+goodsId).remove();
				goods_count -= 1;
			}
			if( type == 'add' ){
				$('#cart_num').html( res.data.goods_count );
				showMsg('添加成功');
			}else{
				$('#grid-order-'+goodsId).attr('num',num);
				$('#order-select-'+goodsId).attr('num',num);
				$('#goods-num-'+goodsId).val(num);
				$('#opt-num-'+goodsId).html(num);
				updateCart();
			}
		}
	});
}

//显示大图
function showImg(imgurl)
{
	var html = '<div id="bigImgBg" onclick="hideImg()"></div><img src="'+imgurl+'" id="bigImgFixed" onclick="hideImg()"/>';
	$('body').append(html);
}

//隐藏大图
function hideImg()
{
	$('#bigImgBg').remove();
	$('#bigImgFixed').remove();
}
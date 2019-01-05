<?php
class ApiAction extends Action {
	public $uid = 0;
	public $ERROR_LIST = array();
	
	public function _initialize()
	{
		$this->uid = $_SESSION['uid'];
		$this->ERROR_LIST = C('ERROR_LIST');
	}
	
	//加入购物车 修改购物车
	public function addToCart()
	{
		$cartData = $_COOKIE['cartData'];
		$cartData = json_decode($cartData,true);
		
		$goodsId  = $_POST['id'];
		$num      = $_POST['num'];
		if( isset($cartData[$goodsId]) ){
			if( $num == 0  ){
				unset($cartData[$goodsId]);
			}else{
				$cartData[ $goodsId ]['num'] = $num;
			}
		}else{
			$goods                = D('Goods')->getOne($goodsId,'id,name,image,price');
			$goods['num']         = $num;
			$cartData[ $goodsId ] = $goods;
		}
		$goods_count = count($cartData);
		$cartData = json_encode($cartData,JSON_UNESCAPED_UNICODE);
		setcookie('cartData',$cartData,time()+2592000);//cookie默认保存1个月
		showMsg(200,'操作成功',array('goods_count'=>$goods_count) );
	}
	
	//将商品加入结算
	public function addBuyData()
	{
		setcookie('buyData','',-1);
		setcookie('buyInfo','',-1);
		$buyData = $_POST['buydata'];
		$buyInfo = $_POST['buyinfo'];
		$ERROR_LIST = $this->ERROR_LIST;
		if( empty($buyData) ){
			showMsg(50109,$ERROR_LIST[50109]);
		}
		$_SESSION['buyData'] = $buyData;
		$_SESSION['buyInfo'] = $buyInfo;
		showMsg(200,'操作成功');
	}
	
	//新增订单
	public function addOrder()
	{
		$uid = $this->uid;
		$order_info = $_SESSION['buyInfo'];
		$totalprice = $order_info['total_price'];//商品总金额
		$goodscount = $order_info['goods_count'];//商品总数
		$ERROR_LIST = $this->ERROR_LIST;
		if( $totalprice <= 0 )
		{
			showMsg(50101,$ERROR_LIST[50101]);
		}
		
		$shouhuoren = $_POST['name'];//收货人姓名
		$phone      = $_POST['phone'];
		$address    = $_POST['address'];
		if( empty($shouhuoren) )
		{
			showMsg(50102,$ERROR_LIST[50102]);
		}
		if( empty($phone) )
		{
			showMsg(50103,$ERROR_LIST[50103]);
		}
		if( empty($address) )
		{
			showMsg(50104,$ERROR_LIST[50104]);
		}
		$now        = time();
		$orderid    = C('ORDER_PREFIX').date("YmdHis",$now).mt_rand(100,999);
		$totallirun = $order_info['totalLirun'];
		$cartdata   = json_encode($_SESSION ['buyData'],JSON_UNESCAPED_UNICODE);
		
		$time       = date ( "Y/m/d H:i:s",$now );
		$pay_style  = '微信支付';
		
		$data["orderid"]      = $orderid;
		$data["totalprice"]   = $totalprice;
		$data["goods_count"]  = $goodscount;
		$data["pay_style"]    = $pay_style;
		$data["pay_status"]   = 0;
		$data["note"]         = $_POST['note'];
		$data["order_status"] = 0;
		$data["time"]         = $time;
		$data["cartdata"]     = $cartdata;
		$data["phone"]        = $phone;
		$data["address"]      = $address;
		$data["shouhuoname"]  = $shouhuoren;
		$data["user_id"]      = $uid;
		//var_dump($data);
		
		//把地址、电话保存到用户信息中
		$userdata = M('User')->find($uid);
		$user = array();
		if( empty($userdata['address']) ){
			$user['address'] = $address;
		}
		if( empty($userdata['username']) ){
			$user['username'] = $shouhuoren;
		}
		if( empty($userdata['phone']) ){
			$user['phone'] = $phone;
		}
		if( !empty($userdata) && !empty($user) ){
			$user['id'] = $uid;
			M( "User" )->save( $user );
		}
		
		//保存订单信息
		$oid = M( "Order" )->add( $data );
		
		//把已购买的商品从购物车移除
		$cartData = json_decode($_COOKIE['cartData'],true);
		$cartdata = $_SESSION ['buyData'];
		foreach( $cartdata as $Id=>$g ){
			unset( $cartData[$Id] );
		}
		if( empty($cartData) ){
			setcookie('cartData','',-1);
		}else{
			$cartData = json_encode($cartData,JSON_UNESCAPED_UNICODE);
			setcookie('cartData',$cartData,time()+2592000);//cookie默认保存1个月
		}
		unset($_SESSION['buyData']);
		unset($_SESSION['buyInfo']);

		$url = U('App/Member/pay/',array('oid'=>$oid));
		showMsg(200,'',$url);
	}
	
	//获取订单列表
	public function getorders()
	{
		$uid      = $this->uid;
		$page     = $_GET['p'] ? intval($_GET['p']) : 1;
		$pageSize = C('ORDER_PAGESIZE');
		$limit    = ($page - 1) * $pageSize .','.$pageSize;
		$orders   = M('Order')->where( array('user_id'=>$uid) )->limit($limit)->order('id desc')->field('id,orderid,pay_status,order_status,time,cartdata,totalprice,goods_count')->select();
		if( empty($orders) ){
			showMsg(200,'',array());
		}
		foreach( $orders as $k=>$o ){
			$cartData = json_decode($o['cartdata'],true);
			$orders[$k]['cartdata'] = $cartData;
			$orders[$k]['time'] = date('Y-m-d H:i',strtotime($orders[$k]['time']));
			$order_status = $o['order_status'];
			$pay_status   = $o['pay_status'];
			$status = '未付款';
			if( $pay_status > 0 ){
				if( $order_status == 0 ){
					$status = '待商家发货';
				}elseif( $order_status == 1 ){
					$status = '已发货';
				}elseif( $order_status == 2 ){
					$status = '已收货';
				}elseif( $order_status == 3 ){
					$status = '已完成';
				}elseif( $order_status == 4 ){
					$status = '已退款';
				}
			}
			$orders[$k]['status'] = $status;
		}
		showMsg(200,'',$orders);
	}

	public function get_user_pic($uid,$ticket)
	{
		//$user_pic = "./imgpublic/user_".$uid.".jpg";
		$ticket = "./imgpublic/ticket_".$uid.".png";
		//if(!file_exists($user_pic))
		if(!file_exists($ticket))
		{
/*
			$pic = 'https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket='.$ticket;
			$data = file_get_contents($pic);
			$fp = @fopen($filepath.$filename,"w");
			@fwrite($fp,$data); 
			fclose($fp);
			$ticket = $filepath.$filename;
*/
			$filepath = "./imgpublic/";
			$site_url = M ( "Info" )->where ( "id = 1" )->getField('site_url');
			$usersresult = R ( "Api/Api/getuser", array (
					$uid
			) );
			$url = trim($site_url,'/').'/index.php?g=App&m=Member&a=register&mid='.$usersresult['id'];
			$filename = "ticket_".$uid.".png";
			$ticket = $filepath.$filename;
			$this->createQrcode($url,$ticket);
/*
			if(!empty($logo)){
				$pic = $logo;
				$data = file_get_contents($pic);
				$filepath = "./imgpublic/";
				$filename = "logo_".$uid.".jpg";
				$fp = @fopen($filepath.$filename,"w");
				@fwrite($fp,$data);
				fclose($fp);
				$logo = $filepath.$filename;
			}
			import ( 'ThinkImage', APP_PATH . 'Common/ThinkImage', '.class.php' );

			$img = new ThinkImage(THINKIMAGE_GD, './card.jpg'); 
			
			$img->open($ticket)->thumb(250, 250)->save($ticket);
			if(!empty($logo)){$img->open($logo)->thumb(70, 70)->save($logo);}
			
			
			if(!empty($logo)){
				$img->open('./card.jpg')->water($ticket, THINKIMAGE_WATER_SOUTHEAST)->water($logo, THINKIMAGE_WATER_NORTHWEST)->text($name,'./hei.ttf','25','#000000', THINKIMAGE_WATER_NORTHWEST)->save($user_pic);
			}
			else
			{
				$img->open('./card.jpg')->water($ticket, THINKIMAGE_WATER_SOUTHEAST)->text($name,'./hei.ttf','25','#000000', THINKIMAGE_WATER_NORTHWEST)->save($user_pic);
			}
*/
		
		}
		//return $user_pic;
		return $ticket;
	}
	
	public function ticket($usersresult)
	{
		//推荐人
		$result_l = M("User")->where(array('id'=>$usersresult['l_id']))->find();
			
		//二维码
		if($usersresult['member']==1)
		{
			$ticket = $usersresult['ticket'];
/*
			$wx_info = json_decode($usersresult['wx_info'],true);
			$logo = $wx_info['headimgurl'];
			$name = $wx_info['nickname'];
*/
			$ticket = $this->get_user_pic($usersresult['uid'],$ticket); 
			//$pic = 'user_'.$usersresult['uid'].'.jpg';
		}
		elseif(!empty($result_l))
		{
			$ticket = $result_l['ticket'];
/*
			$wx_info = json_decode($result_l['wx_info'],true);
			$logo = $wx_info['headimgurl'];
			$name = $wx_info['nickname'];
*/
			$ticket = $this->get_user_pic($result_l['uid'],$ticket); 
			//$pic = 'user_'.$result_l['uid'].'.jpg';
		}
		else
		{
			$ticket = "./imgpublic/hongmeiqi.jpg";
			//$pic = 'hongmeiqi.jpg';
		}
		
		$returnValue['ticket'] = $ticket;
		//$returnValue['pic'] = $pic;
		return $returnValue;
	}
	
	public function login($username, $password) {
		$where ["username"] = $username;
		$where ["password"] = md5 ( $password );
		$result = M ( "Admin" )->where ( $where )->find ();
		if ($result) {
			return $result ["username"];
		}
	}
	public function getsetting() {
		$result = M ( "Info" )->find ();
		if ($result) {
			return $result;
		}
	}
	public function setting() {
		$model      = M( "Info" );
		$data       = $_POST;
		$data['id'] = 1;
		$result     = $model->save ( $data );
		if ($result) {
			return $result;
		}
	}
	public function getalipay() {
		$result = M ( "Alipay" )->find ();
		if ($result) {
			return $result;
		}
	}
	public function setalipay($alipayname, $partner, $key) {
		$select = M("Alipay")->select();
		if ($select) {
			$data ["id"] = 1;
			$data ["alipayname"] = $alipayname;
			$data ["partner"] = $partner;
			$data ["key"] = $key;
			
			$result = M ( "Alipay" )->save ( $data );
		}else{
			$data ["alipayname"] = $alipayname;
			$data ["partner"] = $partner;
			$data ["key"] = $key;
			
			$result = M ( "Alipay" )->add ( $data );
		}
		
		if ($result) {
			return $result;
		}
	}
	public function getarraymenu() {
		$result = M ( "Menu" )->select ();
		
		import ( 'Tree', APP_PATH . 'Common', '.php' );
		$tree = new Tree (); // new 之前请记得包含tree文件!
		$tree->tree ( $result ); // 数据格式请参考 tree方法上面的注释!
		                         
		// 如果使用数组, 请使用 getArray方法
		$result = $tree->getArray ();
		
		// 下拉菜单选项使用 get_tree方法
		// $tree->get_tree();
		if ($result) {
			return $result;
		}
	}
	public function getmenu() {
		$result = M ( "Menu" )->select ();
		if ($result) {
			return $result;
		}
	}
	public function addmenu($parent, $name, $addmenu) {
		if ($addmenu == 0) {
			$data ["name"] = $name;
			$data ["pid"] = $parent;
			$result = M ( "Menu" )->add ( $data );
			if ($result) {
				return $result;
			}
		} else {
			$data ["id"] = $addmenu;
			$data ["name"] = str_replace ( "│ ", "", $name );
			$data ["pid"] = $parent;
			$result = M ( "Menu" )->save ( $data );
			if ($result) {
				return $result;
			}
		}
	}
	public function delmenu($id) {
		$result = M ( "Menu" )->where ( array (
				'id' => $id 
		) )->delete ();
		if ($result) {
			return $result;
		}
	}
	public function getmenuvalue($menu_id) {
		$result = M ( "Menu" )->where ( array (
				"id" => $menu_id 
		) )->find ();
		if ($result) {
			return $result ["name"];
		}
	}
	public function getgood() {
		$result = M ( "Good" )->select ();
		//echo M ( "Good" )->getLastSql();
		//print_r($result);
		if ($result) {
			return $result;
		}
	}
	public function addgood($data) {
		if ($data["id"]) {
			$result = M ( "Good" )->save($data);
		}else{
			$result = M ( "Good" )->add($data);
		}
		//echo M ( "Good" )->getLastSql();
		
		if ($result) {
			return $result;
		}
	}
	public function delgood($id) {
		$result = M ( "Good" )->where ( array (
				"id" => $id 
		) )->delete ();
		if ($result) {
			return $result;
		}
	}
	public function getorder() {
	}
	public function gettheme() {
		$m = M ( "Info" );
		$result = $m->find ();
		if ($result) {
			return $result;
		}
	}
	public function delorder($id) {
		$reuslt = M ( "Order" )->where ( array (
				"id" => $id 
		) )->delete ();
		if ($reuslt) {
			return $reuslt;
		}
	}
	public function deltx($id) {
		$reuslt = M ( "Tx_record" )->where ( array (
				"id" => $id 
		) )->delete ();
		if ($reuslt) {
			return $reuslt;
		}
	}
	
	public function txpublish($id) {
		$result = M ( "Order" )->where ( array('id'=>$id) )->find();

		if(!empty($result))
		{
			$data ["id"] = $id;
			$data ["order_status"] = 4;
			M ( "Order" )->save ( $data );
			M ( "Order_level" )->where(array('order_id'=>$result['orderid']))->save ( array('status'=>4) );
			M ( "Order_level" )->where(array('level_id'=>$result['user_id']))->save ( array('status'=>4) );
			
			$userd_id = $result['user_id'];
			$data = array();
			$data['member'] = 0;
			$data['ticket'] = '';
			$data['url'] = '';
			$data['l_id'] = 0;
			$data['l_b'] = 0;
			$data['l_c'] = 0;
			$data['c_cnt'] = 0;
			$data['b_cnt'] = 0;
			$data['a_cnt'] = 0;
			$user_info = M('User')->where(array('id'=>$userd_id))->find();
			if(!empty($user_info))
			{
				//下一级关系都断掉
				M('User')->where(array('id'=>$userd_id))->save($data);
				$a_cnt = M('User')->where(array('l_id'=>$userd_id))->save(array('l_id'=>0,'l_b'=>0,'l_c'=>0));
				$b_cnt = M('User')->where(array('l_b'=>$userd_id))->save(array('l_b'=>0,'l_c'=>0));
				$c_cnt = M('User')->where(array('l_c'=>$userd_id))->save(array('l_c'=>0));
				
				//上级数量减去
				if($user_info['l_id'])
				{
					M('User')->where(array('id'=>$user_info['l_id']))->setDec('a_cnt',1);
					if($a_cnt>0){M('User')->where(array('id'=>$user_info['l_id']))->setDec('b_cnt',$a_cnt);};
					if($b_cnt>0){M('User')->where(array('id'=>$user_info['l_id']))->setDec('c_cnt',$b_cnt);};
				}
				
				if($user_info['l_b'])
				{
					M('User')->where(array('id'=>$user_info['l_b']))->setDec('b_cnt',1);
					if($a_cnt>0){M('User')->where(array('id'=>$user_info['l_b']))->setDec('c_cnt',$a_cnt);};
				}
				
				if($user_info['l_c'])
				{
					M('User')->where(array('id'=>$user_info['l_c']))->setDec('c_cnt',1);
				}
			}
			
		}
	}
	
	/**
	 * 根据url/其他内容 生成二维码
	 * @param string $value
	 * @param string $path 二维码图片保存地址
	 */
	public function createQrcode($value,$path)
	{
		include (APP_PATH.'Common/phpqrcode/qrlib.php');  //引入phpqrcode类文件
		$errorCorrectionLevel = 'L';//容错级别
		$matrixPointSize = 6;//生成图片大小
		$res = QRcode::png($value, $path, $errorCorrectionLevel, $matrixPointSize, 2);
	}
	
	public function publish($id) {
		
		$result = M ( "Order" )->where ( array('id'=>$id) )->find();

		if(!empty($result))
		{
			$data ["id"] = $id;
			$data ["order_status"] = 1;
			$data ["time"] = date('Y-m-d H:i:s');
			M ( "Order" )->save ( $data );
			
			$user_info = M ( "User" )->where ( array('id'=>$result['user_id']) )->find();

			if(!empty($user_info))
			{
				$order_info = json_decode($result['order_info'],true);
				$data = array();
				$data['touser'] = $user_info['uid'];
				$data['msgtype'] = 'text';
				$data['text']['content'] = '您的订单（'.$result['orderid'].'）已经发货，快递单号:'.$order_info['num'].',快递公司：'.$order_info['name'].'，请注意查收，客服热线：400-0899-512，微信查询：gtsactos ';
				
				
				import ( 'Wechat', APP_PATH . 'Common/Wechat', '.class.php' );
				$config = M ( "Wxconfig" )->where ( array (
						"id" => "1" 
				) )->find ();
				
				$options = array (
						'token' => $config ["token"], // 填写你设定的key
						'encodingaeskey' => $config ["encodingaeskey"], // 填写加密用的EncodingAESKey
						'appid' => $config ["appid"], // 填写高级调用功能的app id
						'appsecret' => $config ["appsecret"], // 填写高级调用功能的密钥
						'partnerid' => $config ["partnerid"], // 财付通商户身份标识
						'partnerkey' => $config ["partnerkey"], // 财付通商户权限密钥Key
						'paysignkey' => $config ["paysignkey"]  // 商户签名密钥Key
						);
				$weObj = new Wechat ( $options );
				
				$weObj->sendCustomMessage($data);
			}
		}
							
		if ($reuslt) {
			return $reuslt;
		}
	}
	public function payComplete($id) {
		$data ["id"] = $id;
		$data ["pay_status"] = 1;
		$result = M ( "Order" )->save ( $data );
		if ($reuslt) {
			return $reuslt;
		}
	}
	public function txpayComplete($id) {
		$data ["id"] = $id;
		$data ["status"] = 1;
		$result = M ( "Tx_record" )->save ( $data );
		if ($reuslt) {
			return $reuslt;
		}
	}
	public function getuser($uid) {
		$m = M ( "User" );
		$where["uid"] = $uid;
		$result = $m->where($where)->find ();
		if ($result) {
			return $result;
		}
	}
}
<?php
class IndexAction extends BaseAction {
	public function _initialize() {
		parent::_initialize();
		$this->init();
	}
	
	//分销相关的操作和判断
	public function init()
	{
		if( $this->userinfo ){
			$userinfo = $this->userinfo;
			//更新我的可提现金额
			$where = array();
			$where ["level_id"] = $userinfo['id'];
			$where ["status"] = 2;
			$where ["active_time"] = array('elt',date('Y-m-d H:i:s'));
			$result = M ( "Order_level" )->where($where)->select();
			
			foreach($result as $info)
			{
				$level_id = $info['level_id'];
				$price = $info['price'];
				
				M ("User")->where(array('id'=>$level_id))->setInc('price',$price);
				M ( "Order_level" )->where(array('id'=>$info['id']))->save(array('status'=>3));
				M ( "Order" )->where(array('orderid'=>$info['order_id']))->save(array('order_status'=>3));
			}
			
			//7天未确认的，自动收获
			$where = array();
			$where ["order_status"] = 1;
			$where ["pay_status"] = 1;
			
			$tixianinfo = array();
			$tixianinfo['shouhuo'] = 7;
			$tixianinfo['tixian'] = 7;
			$tixianinfo['jine'] = 50;
			if(file_exists('./Public/Conf/tixianinfo.php'))
			{
				require './Public/Conf/tixianinfo.php';
				$tixianinfo = json_decode($tixianinfo,true); 
			}
		
			$date = strtotime("-$tixianinfo[shouhuo] days");
			
			$date = date('Y-m-d H:i:s',$date);
			
			$where ["time"] = array('elt',$date);
			$result = M ( "Order" )->where($where)->select();

			foreach($result as $info)
			{
				$out_trade_no = $info['orderid'];
				$this->confirm_order_status($out_trade_no);
			}
			
			//分销保持资格
			$this->fenxiao_zige($userinfo);
		}
	}
	
	//重写display方法
	public function display($template = '')
	{
		$action_name = ACTION_NAME;
		if( $template == '' ){
			$template = $action_name;
		}
		$template = "default/Index/".$template;
		parent::display($template);
	}
	
	//新首页
	public function index() {
		$cartData = json_decode($_COOKIE['cartData'],true);
		$this->assign( "cart_num", count($cartData) );
		
		$goodsArr = D('Goods')->getGoods( array('status'=>1),'id,name,price,old_price,image,goods_desc' );
		$this->assign ( "goods", $goodsArr );
		$this->assign("users", $this->$userinfo );
		$this->display();
	}
	
	//商品详情页
	public function detail()
	{
		$id = intval($_GET['id']);
		$goods = D('Goods')->getOne( $id );
		if( empty($goods) ){
			showMsg(404,'商品已下架','','html');
		}
		
		//重复折扣
		$zhekou = 0;
		if(file_exists('./Public/Conf/zhekou.php'))
		{
			require './Public/Conf/zhekou.php';
		}
		if( $zhekou > 0 && $this->uid > 0 )
		{
			$order = M ( "Order" )->where ( array (
				"user_id" => $this->uid,
				"pay_status" => 1
			) )->find ();
			
			if( !empty($order) )
			{
				$goods['price'] = $goods['price'] * ($zhekou/100);
			}
		}
			
		$cartData = json_decode($_COOKIE['cartData'],true);
		$this->assign( "cart_num", count($cartData) );
		$this->assign( "goods", $goods );
		$this->display();
	}
	
	//购物车
	public function cart()
	{
		$cartData = json_decode($_COOKIE['cartData'],true);
		$this->assign ( "cartData", $cartData );
		$total_price = 0;
		$totallirun = 0;
		foreach( $cartData as $goods ){
			$total_price += $goods['price'] * $goods['num'];
			$totallirun  += $goods['lirun'] * $goods['num'];
			$goods['price'] = sprintf('%.2f',$goods['price']);
			$goods['lirun'] = sprintf('%.2f',$goods['lirun']);
		}
		$total_price = sprintf('%.2f',$total_price);
		$totallirun = sprintf('%.2f',$totallirun);
		$this->assign( "goods_count", count($cartData) );
		$this->assign( "total_price", $total_price );
		$this->assign( "totallirun", $totallirun );
		$this->display();
	}
	
	public function addorder() {
		//$uid = htmlspecialchars ( $_POST ['uid'] );
		$uid = $_SESSION['uid'];
		
		$username = $_POST ['userData'] [0] [value];
		$phone = $_POST ['userData'] [1] [value];
		//$pay = $_POST ['userData'] [2] [value];
		$agent = $_SERVER['HTTP_USER_AGENT']; 
		if( strpos($agent,"icroMessenger") ) {
			$pay=2;
		}
		else
		{
			$pay=1;
		}
		
		
		//$weixin = $_POST ['userData'] [2] [value];
		//$address = $_POST ['userData'] [2] [value];
		$address = $_POST ['user_address'];
		$note = $_POST ['userData'] [6] [value];
		$totalprice = $_POST ['totalPrice'];
		$totallirun = $_POST ['totalLirun'];
		$cartdata = stripslashes ( $_POST ['cartData'] );
		
		if($totalprice<=0)
		{
			exit();
		}
		
		$buy_cnt = $this->get_day_buy();
		if($buy_cnt<=0)
		{
			$msg['msg']='抱歉，今天已经没有货了，请明天再来买';
			$this->ajaxReturn($msg);die;
		}
		
		if(empty($address))
		{
			$msg['msg']='请选择地市';
			$this->ajaxReturn($msg);die;
		}
		
		$orderid = date ( "YmdHis" ).mt_rand ( 1, 9 );
		$time = date ( "Y/m/d H:i:s" );
		switch ($pay) {
			case 0 :
				$pay_style = "货到付款";
				break;
			case 1 :
				$pay_style = "支付宝";
			case 2 :
				$pay_style = "微信支付";
				break;
		}
		
		$data["orderid"] = $orderid;
		$data["totalprice"] = $totalprice;
		$data["pay_style"] = $pay_style;
		$data["pay_status"] = "0";
		$data["note"] = $note;
		$data["order_status"] = '0';
		$data["time"] = $time;
		$data["cartdata"] = $cartdata;
		$data["phone"] = $phone;
		$data["address"] = $address;
		$data["shouhuoname"] = $username;
		
		$userdata = M ( "User" )->where ( array (
				"uid" => $uid 
		) )->find ();
		if ($userdata) {
			$user_id = $userdata ["id"];
			$user ["id"] = $user_id;
			$user ["username"] = $username;
			$user ["phone"] = $phone;
			$user ["address"] = $address;
			$user ["weixin"] = $weixin;

			M ( "User" )->save ( $user );
			
			$data["user_id"] = $user_id;
			M ( "Order" )->add ( $data);
			
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
			
			$wx_info = json_decode($userdata['wx_info'],true);
			
			
			$yongjin = array();
			$yongjin['yongjin_1'] = 28;
			$yongjin['yongjin_2'] = 13;
			$yongjin['yongjin_3'] = 9;
			if(file_exists('./Public/Conf/yongjin.php'))
			{
				require './Public/Conf/yongjin.php';
				$yongjin = json_decode($yongjin,true); 
			}
		
			
			if($userdata['l_id']>0)
			{
				$user_order_level = array();
				$user_order_level['order_id'] = $orderid;
				$user_order_level['status'] = 0;
				$user_order_level['level_id'] = $userdata['l_id'];
				$user_order_level['level_type'] = 1;
				//$my_price = $user_order_level['price'] = $totalprice*($yongjin['yongjin_1']/100);
				$my_price = $user_order_level['price'] = $totallirun*($yongjin['yongjin_1']/100);
				M ( "Order_level" )->add ( $user_order_level );
				
				$l_id_info = M ( "User" )->where(array('id'=>$userdata['l_id']))->find();
				
				if(strlen($l_id_info['uid'])>10)
				{
					$data= array();
					$data['touser'] = $l_id_info['uid'];
					$data['msgtype'] = 'text';
					$data['text']['content'] = '您的一级会员【'.$wx_info['nickname'].'】在'.$time.'下单，订单号为：'.$orderid.'；订单金额为：'.$totalprice.'元；您将获得的佣金为：'.$my_price.'元。';
					$weObj->sendCustomMessage($data);
				}
				
			}
			
			if($userdata['l_b']>0)
			{
				$user_order_level = array();
				$user_order_level['order_id'] = $orderid;
				$user_order_level['status'] = 0;
				$user_order_level['level_id'] = $userdata['l_b'];
				$user_order_level['level_type'] = 2;
				//$my_price = $user_order_level['price'] = $totalprice*($yongjin['yongjin_2']/100);
				$my_price = $user_order_level['price'] = $totallirun*($yongjin['yongjin_2']/100);
				M ( "Order_level" )->add ( $user_order_level );
				
				$l_b_info = M ( "User" )->where(array('id'=>$userdata['l_b']))->find();
				
				if(strlen($l_b_info['uid'])>10)
				{
					$data= array();
					$data['touser'] = $l_b_info['uid'];
					$data['msgtype'] = 'text';
					$data['text']['content'] = '您的二级会员【'.$wx_info['nickname'].'】在'.$time.'下单，订单号为：'.$orderid.'；订单金额为：'.$totalprice.'元；您将获得的佣金为：'.$my_price.'元。';
					$weObj->sendCustomMessage($data);
				}
			}
			
			if($userdata['l_c']>0)
			{
				$user_order_level = array();
				$user_order_level['order_id'] = $orderid;
				$user_order_level['status'] = 0;
				$user_order_level['level_id'] = $userdata['l_c'];
				$user_order_level['level_type'] = 3;
				//$my_price = $user_order_level['price'] = $totalprice*($yongjin['yongjin_3']/100);
				$my_price = $user_order_level['price'] = $totallirun*($yongjin['yongjin_3']/100);
				M ( "Order_level" )->add ( $user_order_level );
				
				$l_c_info = M ( "User" )->where(array('id'=>$userdata['l_c']))->find();
				
				if(strlen($l_c_info['uid'])>10)
				{
					$data= array();
					$data['touser'] = $l_c_info['uid'];
					$data['msgtype'] = 'text';
					$data['text']['content'] = '您的三级会员【'.$wx_info['nickname'].'】在'.$time.'下单，订单号为：'.$orderid.'；订单金额为：'.$totalprice.'元；您将获得的佣金为：'.$my_price.'元。';
					$weObj->sendCustomMessage($data);
				}
			}
			
		} else {
			/*$user ["uid"] = $uid;
			$user ["username"] = $username;
			$user ["phone"] = $phone;
			$user ["address"] = $address;
			$user_id = M ( "User" )->add ( $user );
			$data["user_id"] = $user_id;
			M ( "Order" )->add ( $data);*/
			exit('请先关注该公众号');
		}
		
		$alipay = M ( "Alipay" )->find ();
		if ($pay == 1 && $alipay) {
			echo 'http://' . $_SERVER ['SERVER_NAME'] . __ROOT__ . '/api/wapalipay/alipayapi.php?WIDseller_email=' . $alipay ['alipayname'] . '&WIDout_trade_no=' . $orderid . '&WIDsubject=' . $orderid . '&WIDtotal_fee=' . $totalprice;
		}
		else if($pay==2)
		{
			$cartdata = json_decode($cartdata,true);
			echo 'http://' . $_SERVER ['SERVER_NAME']. U('App/Index/pay',array('totalprice'=>$totalprice,'cart_name'=>$cartdata[0]['name'],'uid'=>$uid,'orderid'=>$orderid));
		}
	}
	
	public function pay(){
		
		$totalprice = $_GET['totalprice'];
		$cart_names = $_GET['cart_name'];
		//$openid = $_GET['uid'];
		$openid = $this->openid;
		$orderid = $_GET['orderid'];
		
		$agent = $_SERVER['HTTP_USER_AGENT']; 
		if(!strpos($agent,"icroMessenger")) {
			$alipay = M ( "Alipay" )->find ();
			$url = 'http://' . $_SERVER ['SERVER_NAME'] . __ROOT__ . '/api/wapalipay/alipayapi.php?WIDseller_email=' . $alipay ['alipayname'] . '&WIDout_trade_no=' . $orderid . '&WIDsubject=' . $orderid . '&WIDtotal_fee=' . $totalprice;
		
			header("Location: $url");
			exit();
		}
		
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
		
		$order_info = M('Order')->where(array('orderid'=>$orderid))->find();
		
		if(empty($order_info))
		{
			exit('订单信息错误');
		}
		
		$cartdata = json_decode($order_info['cartdata'],true);
		$cart_name = $cartdata[0]['name'];
		$cart_num = $cartdata[0]['num'];
		$cart_price = $cartdata[0]['price'];
		
		$userdata = M ( "User" )->where ( array (
				"uid" => $_SESSION['uid']
		) )->find ();
		
		if(empty($userdata))
		{
			exit('用户信息错误');
		}
		
		$username = $userdata['username'];
		$phone = $userdata['phone'];
		$address = $userdata['address'];
		
		$this->assign ( "username", $username );
		$this->assign ( "phone", $phone );
		$this->assign ( "address", $address );
		$this->assign ( "cart_name", $cart_name );
		$this->assign ( "cart_num", $cart_num );
		$this->assign ( "cart_price", $cart_price );
		
		$appid = $options['appid'];
		$mch_id = $options['partnerid'];
		$out_trade_no = $orderid;
		$body = $cart_names;
		$total_fee = $cart_price*$cart_num*100;
		$notify_url = 'http://' . $_SERVER ['SERVER_NAME'];
		$spbill_create_ip = $_SERVER["REMOTE_ADDR"];
		$nonce_str = $weObj->generateNonceStr();
		
		$pay_xml = $weObj->createPackageXml($appid,$mch_id,$nonce_str,$body,$out_trade_no,$total_fee,$spbill_create_ip,$notify_url,$openid);
		
		$pay_xml =  $weObj->get_pay_id($pay_xml);
		if($pay_xml['err_code']=="ORDERPAID")
		{
			$this->redirect('App/Index/payover', array('out_trade_no'=>$out_trade_no,'uid'=>$_SESSION['uid'])); 
			eixt();
		}
		
		$prepay_id = $pay_xml['prepay_id'];
		
		$jsApiObj["appId"] = $appid;
		$timeStamp = time();
	    $jsApiObj["timeStamp"] = "$timeStamp";
	    $jsApiObj["nonceStr"] = $nonce_str;
		$jsApiObj["package"] = "prepay_id=$prepay_id";
	    $jsApiObj["signType"] = "MD5";
	    $jsApiObj["paySign"] = $weObj->getPaySignature($jsApiObj);

		$url = json_encode($jsApiObj);
		$returnUrl = 'http://' . $_SERVER ['SERVER_NAME']. U('App/Index/payover',array('out_trade_no'=>$out_trade_no,'uid'=>$_SESSION['uid']));

		$this->assign ( "price", $cart_price*$cart_num );
		$this->assign ( "url", $url );
		$this->assign ( "returnUrl", $returnUrl );
		$this->display ();
	}
	
	public function payover()
	{
		$uid = $this->uid;
		if(empty($uid))
		{
			exit('请先关注该公众号');
		}
		$out_trade_no = $_GET['out_trade_no'];

		$order_info = M ("Order")->where(array('orderid'=>$out_trade_no))->find();
		if(empty($order_info))
		{
			exit('未找到订单信息');
		}
		
		$userdata = D( "Member" )->getOne($uid);
		
		$Order_level_info = M ("Order_level")->where(array('order_id'=>$out_trade_no))->select();
		if(!empty($Order_level_info))
		{
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
			
			
			foreach($Order_level_info as $info)
			{
				if($info['level_type']==1)
				{
					$level_text = '一';
				}
				
				if($info['level_type']==2)
				{
					$level_text = '二';
				}
				
				if($info['level_type']==3)
				{
					$level_text = '三';
				}
				
				$level_id = $info['level_id'];
				$wx_info = json_decode($userdata['wx_info'],true);
				
				$user_info = M('User')->where(array('id'=>$level_id))->find();
				//$ketixian_price = $user_info['price'] + $info['price'];
				//M("User")->where( array ("id" => $level_id) )->save( array('price'=>$ketixian_price) );
				
				if(strlen($user_info['uid'])>10)
				{
					$data= array();
					$data['touser'] = $user_info['uid'];
					$data['msgtype'] = 'text';
					$data['text']['content'] = '您的'.$level_text.'级会员【'.$wx_info['nickname'].'】在'.date('Y-m-d H:i:s').'已付款，订单号为：'.$out_trade_no.'；订单金额为：'.$order_info['totalprice'].'元；您已获得的佣金为：'.$info['price'].'元。';
					$weObj->sendCustomMessage($data);

					$cartdata = json_decode($order_info['cartdata'],true);
					$data= array();
					$data['touser'] = $userdata['uid'];
					$data['msgtype'] = 'text';
					$data['text']['content'] = '您的'.$cartdata[0]['name'].'已付款成功，等待卖家发货。';
					$weObj->sendCustomMessage($data);
				}
			}
			
		}
		if($userdata["member"]!=1)
		{
			$user_id = $userdata ["id"];
			$member_obj = D( "Member" );
			$result = $member_obj->add_meber($user_id);

			//生成分享图片
			$url = 'http://' . $_SERVER ['SERVER_NAME']. U('App/Index/get_pic',array('id'=>$this->uid));
		
			$oCurl = curl_init();
			curl_setopt($oCurl, CURLOPT_URL, $url);
			curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1 );
			curl_setopt($oCurl, CURLOPT_TIMEOUT,1);
			$sContent = curl_exec($oCurl);
			$aStatus = curl_getinfo($oCurl);
			curl_close($oCurl);
		
		}
		
		$data['id']=$userdata['id'];
		$data['jifen']=$order_info['totalprice'];
		$userdata = M ( "User" )->save($data);
		
		if (! empty ( $out_trade_no )) {
			M ("Order")->where(array('orderid'=>$out_trade_no))->save (array('pay_status'=>1));
			
			M ("Order_level")->where(array('order_id'=>$out_trade_no))->save (array('status'=>1));
		}
		$this->redirect('App/Member/orderlist'); 
	}
	
	public function addtxorder()
	{
		//$uid = htmlspecialchars ( $_POST ['uid'] );
		$uid = $_SESSION['uid'];
		
		$price = $_POST ['userData'] [0] [value];
		$bank_name = $_POST ['userData'] [1] [value];
		$bank_num = $_POST ['userData'] [2] [value];
		$name = $_POST ['userData'] [3] [value];
		$tel = $_POST ['userData'] [4] [value];
		
		if(empty($uid) || empty($price) || empty($bank_name) || empty($bank_num) || empty($name) || empty($tel))
		{
			$result['error'] = true;
			$result['msg'] = '请完善提现信息';
			$this->ajaxReturn ( $result );
		}
		
		$tixianinfo = array();
		$tixianinfo['shouhuo'] = 7;
		$tixianinfo['tixian'] = 7;
		$tixianinfo['jine'] = 50;
		if(file_exists('./Public/Conf/tixianinfo.php'))
		{
			require './Public/Conf/tixianinfo.php';
			$tixianinfo = json_decode($tixianinfo,true); 
		}
		
		if($price<$tixianinfo['jine'])
		{
			$result['error'] = true;
			$result['msg'] = '提现金额必须大于'.$tixianinfo['jine'];
			$this->ajaxReturn ( $result );
		}
		
		$userdata = M ( "User" )->where ( array (
				"uid" => $uid 
		) )->find ();
		
		if ($userdata) {
			if(!$userdata['member'])
			{
				$result['error'] = true;
				$result['msg'] = '只有成为东家才能完成提现';
				$this->ajaxReturn ( $result );
			}
			
			if($userdata['price']<$price)
			{
				$result['error'] = true;
				$result['msg'] = '余额不足，无法申请提现';
				$this->ajaxReturn ( $result );
			}
			else
			{
				$data= array();
				$data["uid"] = $userdata['id'];
				$data["price"] = $price;
				$data["bank_name"] = $bank_name;
				$data["bank_num"] = $bank_num;
				$data["name"] = $name;
				$data["tel"] = $tel;
				
				M ( "Tx_record" )->add ( $data);
				
				
				$data= array();
				$data["id"] = $userdata['id'];
				$data["price"] = $userdata['price']-$price;
				M ( "User" )->save ( $data);
				
				$result['error'] = false;
				$result['msg'] = '恭喜您已经提现成功，正提交系统审核';
				$this->ajaxReturn ( $result );
			}
		}
		else
		{
			$result['error'] = true;
			$result['msg'] = '系统繁忙，请重新提交提现申请';
			$this->ajaxReturn ( $result );
		}
	}
	
	public function fenxiao_zige($usersresult)
	{
		//分销保持资格
		$this->dongjia_time = '';
		if($usersresult['member']==1)
		{
			if(file_exists('./Public/Conf/buyday.php'))
			{
				require './Public/Conf/buyday.php';

				if($buyday>0)
				{
					$where = array();
					$where ["user_id"] = $usersresult['id'];
					$where ["pay_status"] = 1;
					$date = strtotime("-$buyday days");
					$date = date('Y-m-d H:i:s',$date);
					$where ["time"] = array('egt',$date);

					$result = M ( "Order" )->where($where)->find();

					if(empty($result))
					{
						M ("User")->where(array('id'=>$usersresult['id']))->save(array('member'=>0));
					}
					else
					{
						$this->dongjia_time = ceil((strtotime($result['time'])+($buyday*60*60*24) - time())/(60*60*24));
					}
				}
			}
		}
	}
	
	public function member_info()
	{
		if ($_GET ['id'] && $_GET ['type']) {
			
			$type = $_GET ['type'];
			import ( 'ORG.Util.Page' );
			
			$id = $_GET ["id"];
			
			$user = htmlspecialchars($_GET ["user"]);
			
			$where = array('id'=>$id);
			$usersresult = M ("User")->where($where)->find();
			
			if(empty($usersresult))
			{
				exit('未查到该用户信息');
			}
			
			//分销保持资格
			$this->fenxiao_zige($usersresult);
			
			$this->assign ( "users", $usersresult );
		
			
			$count_desc="我的分销：";
			
			if($type==1)
			{
				$where = array('l_id'=>$id);
			}
			else if ($type==2)
			{
				$where = array('l_b'=>$id);
			}
			else if($type==3)
			{
				$where = array('l_c'=>$id);
			}
			if(!empty($user)){$where['id'] = $user;}
			
			$count = M ("User")->where($where)->count();
			
			if($type==1)
			{
				$count_desc .= "部分会员($count)人";
			}
			else if ($type==2)
			{
				$count_desc .= "二级会员($count)人";
			}
			else if($type==3)
			{
				$count_desc .= "三级会员($count)人";
			}
			
			$Page = new Page ( $count, 10 ); 
			
			$Page -> setConfig('header', '人');
			$Page -> setConfig('theme', '<li><a>%totalRow% %header%</a></li> <li>%upPage%</li> <li>%downPage%</li> <li>%first%</li>  <li>%prePage%</li> <li>%end%</li> ');//(对thinkphp自带分页的格式进行自定义)
		
			$show = $Page->show (); // 分页显示输出
			
			$result = M ("User")->where($where)->limit ( $Page->firstRow . ',' . $Page->listRows )->select();
			$this->assign ( "result", $result );
			$this->assign ( "page", $show ); 
			$this->assign ( "count_desc", $count_desc ); 

			$this->assign ( "dongjia_time", $this->dongjia_time );
			$this->display ();
		}
	}
	
	public function get_user_dianpu_info($users)
	{
		$dianpu_info = array();
		if($users['member']==1)
		{
			$wx_info = json_decode($users['wx_info'],true);
			$img = !empty($wx_info['headimgurl'])?$wx_info['headimgurl']:'../Public/Static/images/defult.jpg';
			$dianpu_info['headimgurl'] = $img;
			$dianpu_info['nickname'] = $wx_info['nickname'];
		}
		else
		{
			$result_l = M("User")->where(array('id'=>$users['l_id']))->find();
			
			
			$dianpu_info = $this->get_l_info($users['l_id']);
		}
		
		return $dianpu_info;
	}
	
	public function get_l_info($l_id)
	{
		$result_l = M("User")->where(array('id'=>$l_id))->find();
		if(!empty($result_l))
		{
			$wx_info = json_decode($result_l['wx_info'],true);
			$l_name = $wx_info['nickname'];
			$img = !empty($wx_info['headimgurl'])?$wx_info['headimgurl']:'../Public/Static/images/defult.jpg';
			$headimgurls = $img;
		}
		
		include dirname(dirname(dirname(dirname(dirname(__FILE__))))).'/Public/Conf/button_config.php'; 
		
		$l_name = !empty($l_name) ? $l_name : ''.$message_name.'';
		$headimgurl = !empty($headimgurls) ? $headimgurls : $headimgurl;
		
		$headimgurl = !empty($headimgurl)?$headimgurl:'../Public/Static/images/defult.jpg';
		
		$info['headimgurl'] = $headimgurl;
		$info['nickname'] = $l_name;
		
		return $info;
	}
	
	public function index_info() {
		$usersresult = array();
		$menuresult = R ( "Api/Api/getmenu" );
		$this->assign ( "menu", $menuresult );
		
		$goodsresult = R ( "Api/Api/getgood" );
		$this->assign ( "goods", $goodsresult );
		
		if ($_GET ['uid']) {
			$uid = $_GET ["uid"];
			$usersresult = R ( "Api/Api/getuser", array (
					$uid 
			) );
		} 

		$this->assign ( "users", $usersresult );

		//新增 2015-4-23
		$id = $_GET ["id"];
		$goodinfo = M ( "Good" )->where ( array (
				"id" => $id 
		) )->find ();
		$this->assign ( "goodinfo", $goodinfo );
		//新增 2015-4-23
		
		
		include dirname(dirname(dirname(dirname(dirname(__FILE__))))).'/Public/Conf/button_config.php'; 
		$this->assign ( "message_name", $message_name );
		$this->assign ( "link_config", $link_config );
		
		$dianpu_info = $this->get_user_dianpu_info($usersresult);
		$this->assign ( "dianpu_info", $dianpu_info );

		
		$this->display ();
	}


	public function fenlei() {
		$usersresult = array();
		$menuresult = R ( "Api/Api/getmenu" );
		$this->assign ( "menu", $menuresult );
		//print_r($menuresult);exit;
		$goodsresult = R ( "Api/Api/getgood" );
		$this->assign ( "goods", $goodsresult );
		
		if ($_GET ['uid']) {
			$uid = $_GET ["uid"];
			$usersresult = R ( "Api/Api/getuser", array (
					$uid 
			) );
		} 

		$this->assign ( "users", $usersresult );
		
		
		include dirname(dirname(dirname(dirname(dirname(__FILE__))))).'/Public/Conf/button_config.php'; 
		$this->assign ( "message_name", $message_name );
		$this->assign ( "link_config", $link_config );
		
		$dianpu_info = $this->get_user_dianpu_info($usersresult);
		$this->assign ( "dianpu_info", $dianpu_info );
		
		$this->display ();
	}


	public function listsp() {
		$usersresult = array();
		$menuresult = R ( "Api/Api/getmenu" );
		$this->assign ( "menu", $menuresult );
		//print_r($menuresult);exit;
		//$goodsresult = R ( "Api/Api/getgood" );
		//$this->assign ( "goods", $goodsresult );
		//$result = M ( "Good" )->where ( array('menu_id'=>'1') )->find();
		$goodsresult = M ( "Good" )->where(array('menu_id'=>$_GET['id'],'status'=>'1'))->select();
		$this->assign ( "goods", $goodsresult );
		//print_r($goodsresult);exit;//
		if ($_GET ['uid']) {
			$uid = $_GET ["uid"];
			$usersresult = R ( "Api/Api/getuser", array (
					$uid 
			) );
		} 

		$this->assign ( "users", $usersresult );
		
		
		include dirname(dirname(dirname(dirname(dirname(__FILE__))))).'/Public/Conf/button_config.php'; 
		$this->assign ( "message_name", $message_name );
		$this->assign ( "link_config", $link_config );
		
		$dianpu_info = $this->get_user_dianpu_info($usersresult);
		$this->assign ( "dianpu_info", $dianpu_info );
		
		$this->display ();
	}

	
	public function index2() {
		$this->init();
		$uid = $this->uid;
		if( $uid > 0 ) {
			$menuresult = R ( "Api/Api/getmenu" );
			$this->assign ( "menu", $menuresult );
			
			$goodsresult = R ( "Api/Api/getgood" );
			
			
			$uid = $_GET ["uid"];
			$usersresult = R ( "Api/Api/getuser", array (
					$uid 
			) );
			if (empty($usersresult)) {
				$usersresult = M("user")->where(array("uid"=>$_GET['uid']))->find();
			}
			$alipay = M ( "Alipay" )->find ();
			if ($alipay) {
				$this->assign ( "alipay", 1 );
			}
			
			//查询是否第一次购买
			$zhekou = 0;
			if(file_exists('./Public/Conf/zhekou.php'))
			{
				require './Public/Conf/zhekou.php';
			}

			if(intval($_GET['id'])==0)
			{
				$_GET['id']=1;
			}

			$goodsresult = M("good")->where(array("id"=>$_GET['id']))->find();
			
			if($zhekou>0)
			{
				$order = $result = M ( "Order" )->where ( array (
					"user_id" => $usersresult["id"],
					"pay_status" => 1
				) )->find ();
				if(!empty($order))
				{
					//foreach($goodsresult as $info)
					//{
						$goodsresult['price'] = $goodsresult['price'] * ($zhekou/100);
					//}
				}
			}//print_r($goodsresult);
		
			$this->assign ( "goods", $goodsresult );
			
			$this->assign ( "users", $usersresult );
			
			$buy_cnt = $this->get_day_buy();
			$this->assign ( "buy_cnt", $buy_cnt );
			include dirname(dirname(dirname(dirname(dirname(__FILE__))))).'/Public/Conf/button_config.php'; 
			$this->assign ( "config_good_pic", $config_good_pic );
			$this->display ();
		} else {
			echo '请先登录!';
		}
	}
	
	public function get_day_buy()
	{
		$tixianinfo = array();			
		$tixianinfo['dingdan'] = 20000;		
		if(file_exists('./Public/Conf/tixianinfo.php'))		
		{			
			require './Public/Conf/tixianinfo.php';			
			$tixianinfo = json_decode($tixianinfo,true); 		
		}
		
		$buy_cnt = $tixianinfo['dingdan'];
		
		//今日支付数量
		$where = array();
		$where ["pay_status"] = 1;
		
		$date = date('Y-m-d 00:00:00');
		
		$where ["time"] = array('egt',$date);
		$count = M ( "Order" )->where($where)->count();
		
		return $can_buycnt = $count>=$buy_cnt ? 0 : $buy_cnt-$count;
	}
	
	
	
	public function fetchgooddetail() {
		$where ["id"] = $_POST ["id"];
		$result = M ( "Good" )->where ( $where )->find ();
		if ($result) {
			$this->ajaxReturn ( $result );
		}
	}
	
	public function confirm_order()
	{
		$out_trade_no = $_GET['id'];
		if(!empty($out_trade_no))
		{
			$this->confirm_order_status($out_trade_no);
		}
		$this->redirect('App/Index/member', array('page_type'=>'order')); 
	}
	
	public function confirm_order_status($out_trade_no)
	{
		M ("Order")->where(array('orderid'=>$out_trade_no))->save (array('order_status'=>2));
		$tixianinfo = array();
		$tixianinfo['shouhuo'] = 7;
		$tixianinfo['tixian'] = 7;
		$tixianinfo['jine'] = 50;
		if(file_exists('./Public/Conf/tixianinfo.php'))
		{
			require './Public/Conf/tixianinfo.php';
			$tixianinfo = json_decode($tixianinfo,true); 
		}
			
		$active_time = date('Y-m-d H:i:s',strtotime("+$tixianinfo[tixian] days"));
		M ("Order_level")->where(array('order_id'=>$out_trade_no))->save (array('status'=>2,'active_time'=>$active_time));
	}
	
	public function getorders() {
		//$uid = $_POST ['uid'];
		$uid = $_SESSION['uid'];
		$user_id = M ( "User" )->where ( array (
				"uid" => $uid 
		) )->find ();
		$result = M ( "Order" )->where ( array (
				"user_id" => $user_id ["id"] 
		) )->order ( 'id desc' )->select ();
		
		foreach($result as $key=>$info)
		{
			if($info['pay_status']==0 && $info['pay_style']=='微信支付')
			{
				$orderid = $info['orderid'];
				$totalprice = $info['totalprice'];
				$cartdata = json_decode($info['cartdata'],true);
				$result[$key]['pay_url'] = 'http://' . $_SERVER ['SERVER_NAME']. U('App/Index/pay',array('totalprice'=>$totalprice,'cart_name'=>$cartdata[0]['name'],'uid'=>$uid,'orderid'=>$orderid));
			}
			
			$order_info = json_decode($info['order_info'],true);
			$result[$key]['order_info_num'] = !empty($order_info['num']) ? $order_info['num'] : '';
			$result[$key]['order_info_name'] = !empty($order_info['name']) ? $order_info['name'] : '';
			
			$result[$key]['time'] = date('Y-m-d H:i:s',strtotime(substr($info['orderid'],0,14)));
		}
		
		$this->ajaxReturn ( $result );
	}
	
	public function get_pic()
	{
		//$uid = $this->uid;
		$uid = intval($_GET['uid']);
		$usersresult = D('Member')->getOne($uid);
		$ticket = R ( "Api/Api/ticket", array (
				$usersresult 
		) );
	}
}
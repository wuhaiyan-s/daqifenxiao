<?php
class MemberAction extends BaseAction {
	function _initialize() {
		parent::_initialize();
		$this->userAuth();
	}
	
	public function display($template = '')
	{
		$action_name = ACTION_NAME;
		if( $template == '' ){
			$template = "member_".$action_name;
		}
		$template = "default/Index/".$template;
		parent::display($template);
	}
	
	//会员中心首页
	public function index()
	{
		if($this->uid > 0) {
			$uid = $this->uid;
			$usersresult = R ( "Api/Api/getuser", array (
					$uid 
			) );
			
			$where = array();
			$where ["status"] = 0;
			$where ["level_id"] = $usersresult['id'];
			$start_price = M ( "Order_level" )->where($where)->sum('price');
			
			$where = array();
			$where ["status"] = 1;
			$where ["level_id"] = $usersresult['id'];
			$over_price = M ( "Order_level" )->where($where)->sum('price');
			
			$where = array();
			$where ["status"] = 2;
			$where ["level_id"] = $usersresult['id'];
			$confirm_price = M ( "Order_level" )->where($where)->sum('price');
			
			$where = array();
			$where ["status"] = 3;
			$where ["level_id"] = $usersresult['id'];
			$add_over_price = M ( "Order_level" )->where($where)->sum('price');
			
			$where = array();
			$where ["status"] = 0;
			$where ["uid"] = $usersresult['id'];
			$get_start_price = M ( "Tx_record" )->where($where)->sum('price');
			
			$where = array();
			$where ["status"] = 1;
			$where ["uid"] = $usersresult['id'];
			$get_end_price = M ( "Tx_record" )->where($where)->sum('price');
			
			$start_price = $start_price>0 ? $start_price : 0;
			$over_price = $over_price>0 ? $over_price : 0;
			$confirm_price = $confirm_price>0 ? $confirm_price : 0;
			$add_over_price = $add_over_price>0 ? $add_over_price : 0;
			$get_end_price = $get_end_price>0 ? $get_end_price : 0;
			$get_start_price = $get_start_price>0 ? $get_start_price : 0;
			
			$all_price = $start_price+$over_price+$confirm_price+$add_over_price;
			$all_price = bcadd($start_price, $over_price, 2);
			$all_price = bcadd($all_price, $confirm_price, 2);
			$all_price = bcadd($all_price, $add_over_price, 2);
			
			$this->assign ( "start_price", $start_price );
			$this->assign ( "over_price", $over_price );
			$this->assign ( "confirm_price", $confirm_price );
			$this->assign ( "add_over_price", $add_over_price );
			$this->assign ( "get_start_price", $get_start_price );
			$this->assign ( "get_end_price", $get_end_price );
			$this->assign ( "all_price", $all_price );
			$this->assign ( "users", $usersresult );
			$this->assign ( "wx_info", json_decode($usersresult['wx_info'],true) );
			
			$type_a_url = 'http://' . $_SERVER ['SERVER_NAME']. U('App/Index/member_info',array('type'=>1,'id'=>$usersresult['id']));
			$type_b_url = 'http://' . $_SERVER ['SERVER_NAME']. U('App/Index/member_info',array('type'=>2,'id'=>$usersresult['id']));
			$type_c_url = 'http://' . $_SERVER ['SERVER_NAME']. U('App/Index/member_info',array('type'=>3,'id'=>$usersresult['id']));
			$this->assign ( "type_a_url", $type_a_url );
			$this->assign ( "type_b_url", $type_b_url );
			$this->assign ( "type_c_url", $type_c_url );
			
			$all_cnt = $usersresult['a_cnt']+$usersresult['b_cnt']+$usersresult['c_cnt'];
			$this->assign ( "all_cnt", $all_cnt );
			
			$where = array();
			$where ["uid"] = $usersresult['id'];
			$tx_record = M ( "Tx_record" )->where($where)->select();

			$this->assign ( "tx_record", $tx_record );
			
			$member_obj = D ( "Member" );
			if($usersresult['member']==1 && (empty($usersresult['ticket']) || empty($usersresult['url'])))
			{
				$member_obj->add_meber($usersresult['id'],$usersresult['uid']);
			}
			
			$where = array();
			$where ["level_id"] = $usersresult['id'];
			$all_buy = M ( "Order_level" )->where($where)->count();
			
			$where = array();
			$where ["status"] = 0;
			$where ["level_id"] = $usersresult['id'];
			$all_over_buy = M ( "Order_level" )->where($where)->count();
			
			$all_start_buy = $all_buy - $all_over_buy;//已付款
			
			$this->assign ( "all_buy", $all_start_buy );//已付款
			$this->assign ( "all_over_buy", $all_over_buy );//未付款
			$this->assign ( "all_count_buy", $all_buy );//总付款
			
			//营业额
			/*$result = M ( "Good" )->find ();
			$all_buy_price = $result['price']*$all_buy;
			$this->assign ( "all_buy_price", $all_buy_price );*/
			$db = new Model();
			$sql = "SELECT sum(`totalprice`) as total FROM `wemall_order_level` inner join `wemall_order` on `wemall_order_level`.`order_id` =  `wemall_order`.`orderid` where `level_id`=$usersresult[id]";
            $ALL_COUNT = $db->query($sql);
			$all_buy_price = empty($ALL_COUNT[0]['total']) ? 0 : $ALL_COUNT[0]['total'];
			$this->assign ( "all_buy_price", $all_buy_price );
			
			//推荐人
			$l_name = $this->get_l_info($usersresult['l_id']);
			$l_name = $l_name['nickname'];
			$l_name = !empty($l_name) ? $l_name : ''.$message_name.'';
			$this->assign ( "l_name", $l_name );
			
			
			$ticket = R ( "Api/Api/ticket", array (
					$usersresult 
			) );
			
			$this->assign ( "ticket", $ticket['ticket'] );
			$this->assign ( "dongjia_time", $this->dongjia_time );
			$url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.'g=App&m=Member&a=register&mid='.$usersresult['id'];
			$this->assign ( "member_url", $url );
			$this->display();
		}else{
			$this->redirect('Member/login');
		}
	}
	
	public function index2()
	{
		if($this->uid > 0) {
			$uid = $this->uid;
			$usersresult = R ( "Api/Api/getuser", array (
					$uid 
			) );
			
			$where = array();
			$where ["status"] = 0;
			$where ["level_id"] = $usersresult['id'];
			$start_price = M ( "Order_level" )->where($where)->sum('price');
			
			$where = array();
			$where ["status"] = 1;
			$where ["level_id"] = $usersresult['id'];
			$over_price = M ( "Order_level" )->where($where)->sum('price');
			
			$where = array();
			$where ["status"] = 2;
			$where ["level_id"] = $usersresult['id'];
			$confirm_price = M ( "Order_level" )->where($where)->sum('price');
			
			$where = array();
			$where ["status"] = 3;
			$where ["level_id"] = $usersresult['id'];
			$add_over_price = M ( "Order_level" )->where($where)->sum('price');
			
			$where = array();
			$where ["status"] = 0;
			$where ["uid"] = $usersresult['id'];
			$get_start_price = M ( "Tx_record" )->where($where)->sum('price');
			
			$where = array();
			$where ["status"] = 1;
			$where ["uid"] = $usersresult['id'];
			$get_end_price = M ( "Tx_record" )->where($where)->sum('price');
			
			$start_price = $start_price>0 ? $start_price : 0;
			$over_price = $over_price>0 ? $over_price : 0;
			$confirm_price = $confirm_price>0 ? $confirm_price : 0;
			$add_over_price = $add_over_price>0 ? $add_over_price : 0;
			$get_end_price = $get_end_price>0 ? $get_end_price : 0;
			$get_start_price = $get_start_price>0 ? $get_start_price : 0;
			
			$all_price = $start_price+$over_price+$confirm_price+$add_over_price;
			$all_price = bcadd($start_price, $over_price, 2);
			$all_price = bcadd($all_price, $confirm_price, 2);
			$all_price = bcadd($all_price, $add_over_price, 2);
			
			$this->assign ( "start_price", $start_price );
			$this->assign ( "over_price", $over_price );
			$this->assign ( "confirm_price", $confirm_price );
			$this->assign ( "add_over_price", $add_over_price );
			$this->assign ( "get_start_price", $get_start_price );
			$this->assign ( "get_end_price", $get_end_price );
			$this->assign ( "all_price", $all_price );
			$this->assign ( "users", $usersresult );
			
			$type_a_url = 'http://' . $_SERVER ['SERVER_NAME']. U('App/Index/member_info',array('type'=>1,'id'=>$usersresult['id']));
			$type_b_url = 'http://' . $_SERVER ['SERVER_NAME']. U('App/Index/member_info',array('type'=>2,'id'=>$usersresult['id']));
			$type_c_url = 'http://' . $_SERVER ['SERVER_NAME']. U('App/Index/member_info',array('type'=>3,'id'=>$usersresult['id']));
			$this->assign ( "type_a_url", $type_a_url );
			$this->assign ( "type_b_url", $type_b_url );
			$this->assign ( "type_c_url", $type_c_url );
			
			$all_cnt = $usersresult['a_cnt']+$usersresult['b_cnt']+$usersresult['c_cnt'];
			$this->assign ( "all_cnt", $all_cnt );
			
			$where = array();
			$where ["uid"] = $usersresult['id'];
			$tx_record = M ( "Tx_record" )->where($where)->select();

			$this->assign ( "tx_record", $tx_record );
			
			$member_obj = D ( "Member" );
			if($usersresult['member']==1 && (empty($usersresult['ticket']) || empty($usersresult['url'])))
			{
				$member_obj->add_meber($usersresult['id'],$usersresult['uid']);
			}
			
			$where = array();
			$where ["level_id"] = $usersresult['id'];
			$all_buy = M ( "Order_level" )->where($where)->count();
			
			$where = array();
			$where ["status"] = 0;
			$where ["level_id"] = $usersresult['id'];
			$all_over_buy = M ( "Order_level" )->where($where)->count();
			
			$all_start_buy = $all_buy - $all_over_buy;//已付款
			
			$this->assign ( "all_buy", $all_start_buy );//已付款
			$this->assign ( "all_over_buy", $all_over_buy );//未付款
			$this->assign ( "all_count_buy", $all_buy );//总付款
			
			//营业额
			/*$result = M ( "Good" )->find ();
			$all_buy_price = $result['price']*$all_buy;
			$this->assign ( "all_buy_price", $all_buy_price );*/
			$db = new Model();
			$sql = "SELECT sum(`totalprice`) as total FROM `wemall_order_level` inner join `wemall_order` on `wemall_order_level`.`order_id` =  `wemall_order`.`orderid` where `level_id`=$usersresult[id]";
            $ALL_COUNT = $db->query($sql);
			$all_buy_price = empty($ALL_COUNT[0]['total']) ? 0 : $ALL_COUNT[0]['total'];
			$this->assign ( "all_buy_price", $all_buy_price );
			
			//推荐人
			$l_name = $this->get_l_info($usersresult['l_id']);
			$l_name = $l_name['nickname'];
			$l_name = !empty($l_name) ? $l_name : ''.$message_name.'';
			$this->assign ( "l_name", $l_name );
			
			
			$ticket = R ( "Api/Api/ticket", array (
					$usersresult 
			) );
			$this->assign ( "ticket", $ticket['ticket'] );
			$this->assign ( "dongjia_time", $this->dongjia_time );
			$url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.'g=App&m=Member&a=register&mid='.$usersresult['id'];
			$this->assign ( "member_url", $url );
			$this->display();
		}else{
			$this->redirect('Member/login');
		}
	}
	
	//销售榜单
	public function sale()
	{
		$id = $this->uid;
		if ($id > 0) {
			$usersresult = D('Member')->getOne( array('id'=>$id) );
			
			if(empty($usersresult))
			{
				exit('未查到该用户信息');
			}
			
			$db = new Model();
			$top_info = $db->query("SELECT level_id, SUM( totalprice ) AS total, wx_info
			FROM (
			SELECT level_id, totalprice
			FROM  `wemall_order_level` 
			INNER JOIN  `wemall_order` ON  `wemall_order_level`.`order_id` =  `wemall_order`.`orderid`
			) AS t1
			INNER JOIN  `wemall_user` ON  `wemall_user`.id = level_id
			GROUP BY level_id
			ORDER BY `total` DESC , `t1`.`level_id` DESC 
			LIMIT 0 , 100");

			
			$ALL_COUNT = $db->query("SELECT sum(`totalprice`) as total FROM `wemall_order_level` inner join `wemall_order` on `wemall_order_level`.`order_id` =  `wemall_order`.`orderid` where `level_id`=$usersresult[id]");
			$all_buy_price = empty($ALL_COUNT[0]['total']) ? 0 : $ALL_COUNT[0]['total'];
				
			$query_info = $db->query("SELECT  SUM( totalprice ) AS total
			FROM (
			SELECT level_id, totalprice
			FROM  `wemall_order_level` 
			INNER JOIN  `wemall_order` ON  `wemall_order_level`.`order_id` =  `wemall_order`.`orderid`
			) AS t1
			GROUP BY level_id
	having total>$all_buy_price");

			$my_top = count($query_info)+1;
			
			$this->assign ( "top_info", $top_info );
			$this->assign ( "user", $usersresult );
			$this->assign ( "my_top", $my_top );
			$this->display();
		}
	}
	
	//结算
	public function buy()
	{
		$uid = $this->uid;
		$goodsList = $_SESSION['buyData'];
		$buy_info = $_SESSION['buyInfo'];
		$total_price = 0;
		foreach( $goodsList as $goods ){
			$goods['price'] = sprintf('%.2f',$goods['price']);
			$total_price += $goods['price'] * $goods['num'];
		}
		$total_price = sprintf('%.2f',$total_price);
		$this->assign( "goodsList", $goodsList );
		$this->assign( "buy_info", $buy_info );
		$this->display();
	}
	
	//支付
	public function pay()
	{
		$openid     = $this->openid;
		$oid        = $_GET['oid'];
		$ERROR_LIST = $this->ERROR_LIST;
		$agent = $_SERVER['HTTP_USER_AGENT']; 
/*
		if( !strpos($agent,"icroMessenger") ) {
			showMsg(50105,$ERROR_LIST[50105],'','html');
		}
*/
		
		$order_info = M('Order')->find($oid);
		if(empty($order_info))
		{
			showMsg(50106,$ERROR_LIST[50106],'','html');
		}
		if( $order_info['user_id'] != $this->uid ){
			showMsg(50107,$ERROR_LIST[50107],'','html');
		}
		if( $order_info['pay_status'] == 1 ){
			showMsg(50108,$ERROR_LIST[50108],'','html');
		}
		$out_trade_no = $order_info['orderid'];
		$returnUrl    = 'http://' . $_SERVER ['SERVER_NAME']. U('App/Index/payover',array('out_trade_no'=>$out_trade_no));
		
		$totalprice   = $order_info['totalprice'];
		$shouhuoname  = $order_info['shouhuoname'];
		$phone        = $order_info['phone'];
		$address      = $order_info['address'];
		$cartdata     = json_decode($order_info['cartdata'],true);
		$cartnames    = '购买商品：';
		foreach($cartdata as $cart){
			$cartnames .= $cart['name'].',';
		}
		$cartnames = trim($cartnames,",");

		$this->assign ( "shouhuoname", $shouhuoname );
		$this->assign ( "phone", $phone );
		$this->assign ( "address", $address );
		$this->assign ( "totalprice", $totalprice );
		
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
		$weObj            = new Wechat ( $options );
		$appid            = $options['appid'];
		$mch_id           = $options['partnerid'];
		$body             = $cartnames;
		$total_fee        = $totalprice * 100;
		$notify_url       = 'http://' . $_SERVER ['SERVER_NAME'];
		$spbill_create_ip = $_SERVER["REMOTE_ADDR"];
		$nonce_str = $weObj->generateNonceStr();
		
		$pay_xml = $weObj->createPackageXml($appid,$mch_id,$nonce_str,$body,$out_trade_no,$total_fee,$spbill_create_ip,$notify_url,$openid);
		
		$pay_xml =  $weObj->get_pay_id($pay_xml);
		if($pay_xml['err_code']=="ORDERPAID")
		{
			$this->redirect( $returnUrl ); 
			eixt();
		}
		
		$prepay_id = $pay_xml['prepay_id'];
		$jsApiObj["appId"] = $appid;
	    $jsApiObj["timeStamp"] = time();
	    $jsApiObj["nonceStr"] = $nonce_str;
		$jsApiObj["package"] = "prepay_id=$prepay_id";
	    $jsApiObj["signType"] = "MD5";
	    $jsApiObj["paySign"] = $weObj->getPaySignature($jsApiObj);
		$jsApiObj = json_encode($jsApiObj);
		$this->assign ( "jsApiObj", $jsApiObj );
		$this->assign( "returnUrl", $returnUrl );
		$this->display();
	}
	
	public function sale_top_()
	{
		$id = $this->uid;
		if ($id > 0) {
			$usersresult = D('Member')->getOne( array('id'=>$id) );
			
			if(empty($usersresult))
			{
				exit('未查到该用户信息');
			}
			
			$db = new Model();
			$top_info = $db->query("SELECT level_id, SUM( totalprice ) AS total, wx_info
			FROM (
			SELECT level_id, totalprice
			FROM  `wemall_order_level` 
			INNER JOIN  `wemall_order` ON  `wemall_order_level`.`order_id` =  `wemall_order`.`orderid`
			) AS t1
			INNER JOIN  `wemall_user` ON  `wemall_user`.id = level_id
			GROUP BY level_id
			ORDER BY `total` DESC , `t1`.`level_id` DESC 
			LIMIT 0 , 100");

			
			$ALL_COUNT = $db->query("SELECT sum(`totalprice`) as total FROM `wemall_order_level` inner join `wemall_order` on `wemall_order_level`.`order_id` =  `wemall_order`.`orderid` where `level_id`=$usersresult[id]");
			$all_buy_price = empty($ALL_COUNT[0]['total']) ? 0 : $ALL_COUNT[0]['total'];
				
			$query_info = $db->query("SELECT  SUM( totalprice ) AS total
			FROM (
			SELECT level_id, totalprice
			FROM  `wemall_order_level` 
			INNER JOIN  `wemall_order` ON  `wemall_order_level`.`order_id` =  `wemall_order`.`orderid`
			) AS t1
			GROUP BY level_id
	having total>$all_buy_price");

			$my_top = count($query_info)+1;
			
			$this->assign ( "top_info", $top_info );
			$this->assign ( "users", $usersresult );
			$this->assign ( "my_top", $my_top );
			$this->display("sale_top_");
		}
	}
	
	//订单列表
	public function orderlist()
	{
		$uid = $this->uid;
		$count = M('Order')->where( array('user_id'=>$uid) )->count();
		$total_page = ceil($count / C('ORDER_PAGESIZE'));
		$this->assign("total_page",$total_page);
		$this->display();
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
	
	//修改用户基本信息
	public function setting()
	{
		$uid = $this->uid;
		$users = D('Member')->getOne( array('uid'=>$uid) );
		
		$this->assign("users",$users);
		if ( empty($users) ) {
			exit('未查到该用户信息');
		}
		if ( IS_POST ) {
			if (!$_POST['login']) {
				$this->error("请输入用户名");
				exit;
			}else {
				$map['login'] = $_POST['login'];
				$map['uid'] = array('neq',$_GET['uid']);
				$check = M("User")->where($map)->find();
				if (!empty($check)) {
					$this->error("该用户名已存在！请重新输入");
					exit;
				}
			}

			if (!$_POST['password']) {
				unset($_POST['password']);
			}else {
				$_POST['password'] = md5($_POST['password']);
			}

			import ( 'ORG.Net.UploadFile' );
			$upload = new UploadFile (); // 实例化上传类
			$upload->maxSize = 3145728; // 设置附件上传大小
			$upload->allowExts = array (
					'jpg',
					'gif',
					'png',
					'jpeg',
					'xlsx',
					'xls'
			); // 设置附件上传类型
			$upload->savePath = './Public/Uploads/';
			$wx_info = array();
			$wx_info = json_decode($users['wx_info'],true);
			if (! $upload->upload ()) { // 上传错误提示错误信息
				$wx_info['nickname'] = $_POST['login'];
				$_POST['wx_info'] = json_encode($wx_info);
			} else { 
				$info = $upload->getUploadFileInfo ();
				$path = $upload->savePath.$info[0]['savename'];
				$wx_info['nickname'] = $_POST['login'];
				$wx_info['headimgurl'] = $path;
				$_POST['wx_info'] = json_encode($wx_info);
			}
			M("User")->where($where)->save($_POST);
			$this->success("保存成功！",U('App/Index/member',array("uid"=>$users['uid'])) );
			exit;
		}

		$this->display();
	}
	
	/*修改昵称 、密码等基本信息*/
	public function base() {
		$uid = $this->uid;
		$where = array('uid'=>$uid);
		$users = M("User")->where($where)->find();

		$this->assign("users",$users);
		if ( empty($users) ) {
			exit('未查到该用户信息');
		}
		if ( IS_POST ) {
			if (!$_POST['login']) {
				$this->error("请输入用户名");
				exit;
			}else {
				$map['login'] = $_POST['login'];
				$map['uid'] = array('neq',$_GET['uid']);
				$check = M("User")->where($map)->find();
				if (!empty($check)) {
					$this->error("该用户名已存在！请重新输入");
					exit;
				}
			}

			if (!$_POST['password']) {
				unset($_POST['password']);
			}else {
				$_POST['password'] = md5($_POST['password']);
			}

			import ( 'ORG.Net.UploadFile' );
			$upload = new UploadFile (); // 实例化上传类
			$upload->maxSize = 3145728; // 设置附件上传大小
			$upload->allowExts = array (
					'jpg',
					'gif',
					'png',
					'jpeg',
					'xlsx',
					'xls'
			); // 设置附件上传类型
			$upload->savePath = './Public/Uploads/';
			$wx_info = array();
			$wx_info = json_decode($users['wx_info'],true);
			if (! $upload->upload ()) { // 上传错误提示错误信息
				$wx_info['nickname'] = $_POST['login'];
				$_POST['wx_info'] = json_encode($wx_info);
			} else { 
				$info = $upload->getUploadFileInfo ();
				$path = $upload->savePath.$info[0]['savename'];
				$wx_info['nickname'] = $_POST['login'];
				$wx_info['headimgurl'] = $path;
				$_POST['wx_info'] = json_encode($wx_info);
			}
			M("User")->where($where)->save($_POST);
			$this->success("保存成功！",U('App/Index/member',array("uid"=>$users['uid'])) );
			exit;
		}

		$this->display();
	}

	//登录
	function login() {
		$uid = $this->uid;
		if( $uid > 0 ){
			showMsg(200,'您已登录','','html',"<script>alert('您已登录');
					setTimeout(function(){
						window.location.href = '".U('Member/index')."';
					}, 1500);
				</script>");
		}
		$this->display();
	}
	
	
	function logout() {
		unset($_SESSION["uid"]);
		$this->success("退出登录！",U('App/Member/login'));
		exit;
	}
	
	//注册
	function register() {
		if ( IS_POST ) {
			if (!$_POST['phone']) {
				$this->error("请输入用户名");
				exit;
			}else {
				$map['login'] = $_POST['phone'];
				$map['phone'] = $_POST['phone'];
				$map['_logic'] = 'OR';
				$check = M("User")->where($map)->find();
				if (!empty($check)) {
					$this->error("手机号已存在！请重新输入");
					exit;
				}
			}
			if (!$_POST['password']) {
				$this->error("请输入登陆密码");
				exit;
			}
			$_POST['uid'] = rand();
			$_POST['password'] = md5($_POST['password']);
			$_POST['login'] = $_POST['phone'];
			$id = M("User")->add($_POST);
			$new_user_id = $id;
			$user = array();
			$user['uid'] = $id;
			$wx_info = json_encode(array('nickname'=>$map['phone'],'subscribe_time'=>time()));
			$user['wx_info'] = $wx_info;
			
			if($_GET['mid']){
				$m = M ( "User" );
				include dirname(dirname(dirname(dirname(dirname(__FILE__))))).'/Public/Conf/button_config.php'; 
				$where = array();
				$where["id"] = (int)$_GET['mid'];
				$results = $m->where($where)->find ();
				
				if(!empty($results['id']))
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
				
					$user ["l_id"] = $results['id'];
					
					//增加分销人
					$a_info = array();
					$a_info['id'] = $results['id'];
					$a_info['a_cnt'] = $results['a_cnt']+1;
					$user_id = M ( "User" )->save ( $a_info );
					
					if(strlen($results['uid'])>10)
					{
						$data = array();
						$data['touser'] = $results['uid'];
						$data['msgtype'] = 'text';
						$data['text']['content'] = '【'.$map[login].'】通过分享链接，成为您的'.$message_name.'团队成员！';
						$weObj->sendCustomMessage($data);
					}
					
					if($results['l_id'])//b jibie
					{
						$where = array();
						$where["id"] = $results['l_id'];
						$b_results = $m->where($where)->find ();
						
						if(!empty($b_results))
						{
							$b_info = array();
							$b_info['id'] = $b_results['id'];
							$b_info['b_cnt'] = $b_results['b_cnt']+1;
							$user_id = M ( "User" )->save ( $b_info );
							
							$user["l_b"] = $b_results['id'];
							
							if(strlen($b_results['uid'])>10)
							{
								$data = array();
								$data['touser'] = $b_results["uid"];
								$data['msgtype'] = 'text';
								$data['text']['content'] = '【'.$map[login].'】通过分享链接，成为您的'.$message_name.'团队成员！';
								$weObj->sendCustomMessage($data);
							}
							
							if($b_results['l_id'])//c jibie
							{
								$where = array();
								$where["id"] = $b_results['l_id'];
								$c_results = $m->where($where)->find ();
								
								if(!empty($c_results))
								{
									$c_info = array();
									$c_info['id'] = $c_results['id'];
									$c_info['c_cnt'] = $c_results['c_cnt']+1;
									$user_id = M ( "User" )->save ( $c_info );
									
									$user["l_c"] = $c_results['id'];
									
									if(strlen($c_results['uid'])>10)
									{
										$data = array();
										$data['touser'] = $c_results["uid"];
										$data['msgtype'] = 'text';
										$data['text']['content'] = '【'.$map[login].'】通过分享链接，成为您的'.$message_name.'团队成员！';
										$weObj->sendCustomMessage($data);
									}
								}
							}
						}
					}
				}
			}
			
			M("User")->where($map)->save($user);
			$_SESSION["uid"] = $new_user_id;
			$this->success("登陆成功！",U('App/Index/member',array("uid"=>$id)));exit;
			
		}
		$this->display();
	}
	
}
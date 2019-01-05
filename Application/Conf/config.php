<?php
$arr1 =  array(
	//'配置项'=>'配置值'
	'DB_TYPE'   => 'mysql', // 数据库类型
	'DB_PORT'   => '3307', // 端口
	'DB_CHARSET'=> 'utf8',// 数据库编码默认采用utf8
// 	'URL_ROUTER_ON'   => true,
// 	'SHOW_PAGE_TRACE' => true,
	'URL_MODEL' => 0,
	'APP_GROUP_LIST' => 'App,Admin,Api', //项目分组设定
	'DEFAULT_GROUP'  => 'App', //默认分组
	'ERROR_LIST' => array(
		//通用错误
		101 =>'请先关注公众号',
		102 =>'用户不存在',
		
		
		//50001 订单、支付、购物车
		50101 => '订单总价有误',
		50102 => '请填写收货人姓名',
		50103 => '请填写收货人电话',
		50104 => '请填写完整的收货人地址',
		50105 => '请在微信公众号提交订单并支付',
		50106 => '订单不存在',
		50107 => '非法操作',
		50108 => '订单已支付',
		50109 => '请先选择商品',
		
		//用户登录相关的
		50201 => '请输入手机号',
		50202 => '请输入密码',
		50203 => '手机号或密码错误',
	),
	'ORDER_PREFIX' => 'D',
	//订单支付状态
	'PAY_STATUS' => array(
		0 => '未支付',
		1 => '已支付',
	),
	
	//订单状态
	'ORDER_STATUS' => array(
		0 => '未发货',
		1 => '已发货',
		2 => '已收货',
		3 => '已完成',
		4 => '已退款'
	),
	'ORDER_PAGESIZE'=>5,
);

include './Public/Conf/config.php';

$arr2 = array(
	'DB_HOST'   => DB_HOST, // 服务器地址
	'DB_NAME'   => DB_NAME, // 数据库名
	'DB_USER'   => DB_USER, // 用户名
	'DB_PWD'    => DB_PWD,  // 密码
	'DB_PREFIX' => DB_PREFIX, // 数据库表前缀
);

return array_merge($arr1 , $arr2);
?>
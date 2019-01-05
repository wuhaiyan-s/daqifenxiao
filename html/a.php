<?php
$str = file_get_contents('./a.txt');
$err = explode("||", $str);
$l = array();
foreach($err as $k=>$v){
	$v = explode("\n", $v);
	$key = $v[0];
	$arr = array();
	foreach($v as $kk=>$vv){
		if( $kk == 0 ){
			continue;
		}
		if( strlen($vv) > 1 ){
			$arr[] = trim($vv,'、');
		}
	}
	$l[$key] = $arr;
}

$bstr = '';
//var_dump($l);
foreach( $l as $lk=>$lv ){
	var_dump($lk);
	$bstr .= $lk."<br/>";
	foreach( $lv as $lvv ){
		$bstr .= "{$lvv}  ";
	}
	$bstr .= "<br/><br/>";
}
$bstr = trim($bstr,"<br/>");
$bstr = '<!DOCTYPE html>
<html><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,minimum-scale=1,user-scalable=no">
<meta content="telephone=no" name="format-detection">
<meta name="apple-touch-fullscreen" content="yes">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
</head>
<body>'.$bstr;
file_put_contents('./b.html', $bstr);
<?php
namespace Common\Lib\weixin;
class Wx{


	//接入微信
	public function index(){
		//读取Token
		$token="weixintest";
		if(!$token){
			echo "TOKEN IS NOT DEFINED!";
			exit;
		}
		$signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];
        		
		$tmpArr = array($token, $timestamp, $nonce);
        // use SORT_STRING rule
		sort($tmpArr, SORT_STRING);
		$tmpStr = implode( $tmpArr );
		$tmpStr = sha1( $tmpStr );
		//var_dump($tmpStr);exit;
		if( $tmpStr == $signature ){
			return true;
		}else{
			return false;
		}	
	}



}
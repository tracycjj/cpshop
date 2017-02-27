<?php
return array(
	//支付宝支付配置
	"ALIPAY_CONFIG"=>array(
			'PARTNER'=>'2008', //合作者ID  以2088开头由16位纯数字组成的字符串，查看地址：https://b.alipay.com/order/pidAndKey.htm

			'SELLER_ID'=>'2008',//seller_id 收款支付宝账号，以2088开头由16位纯数字组成的字符串，一般情况下收款账号就是签约账号

			'PRIVATE_KEY_PATH'=>__ROOT__ .'/pay/alipay/key/rsa_private_key.pem',//private_key_path  商户的私钥,此处填写原始私钥，RSA公私钥生成：https://doc.open.alipay.com/doc2/detail.htm?spm=a219a.7629140.0.0.nBDxfy&treeId=58&articleId=103242&docType=1
			
			'ALI_PUBLIC_KEY_PATH'=>__ROOT__ .'/pay/alipay/key/alipay_public_key.pem',//ali_public_key_path  支付宝的公钥，查看地址：https://b.alipay.com/order/pidAndKey.htm 
			
			'NOTIFY_URL'=>__ROOT__ .'/pay/alipay/notify_url.php',//notify_url  服务器异步通知页面路径  需http://格式的完整路径，不能加?id=123这类自定义参数，必须外网可以正常访问
			
			'RETURN_URL'=>__ROOT__ .'/pay/alipay/return_url.php',//return_url  页面跳转同步通知页面路径 需http://格式的完整路径，不能加?id=123这类自定义参数，必须外网可以正常访问
			
			'SIGN_TYPE'=>strtoupper('RSA'),// sign_type  签名方式
			
			'INPUT_CHARSET'=>strtolower('utf-8'),// input_charset 字符编码格式 目前支持utf-8

			'CACERT'=>__ROOT__ .'/pay/key/alipay/cacert.pem',//cacert  请保证cacert.pem文件在当前文件夹目录中	
			
			'TRANSPORT'=>'http', // transport 访问模式,根据自己的服务器是否支持ssl访问，若支持请选择https；若不支持请选择http
			
			'PAYMENT_TYPE'=>'1',//payment_type 支付类型
			
			'SERVICE'=>'alipay.wap.create.direct.pay.by.user', //service 产品类型，无需修改
		),
	);
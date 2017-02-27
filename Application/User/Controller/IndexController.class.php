<?php
// 本类由系统自动生成，仅供测试用途
namespace User\Controller;
use Common\Lib\Controller;
class IndexController extends Controller {
    public function index(){
    	echo __ROOT__;
    }

    public function payment(){
    	$way=I("post.wap","zfb");
    	switch ($way) {
    		case 'zfb':
    			$this->Alipay();
    			break;
    	}
    }
    public function Alipay(){
    	//一、根据配置文件 生成 alipaySubmit对象
    	$alipay_config=C("ALIPAY_CONFIG");
    	$alipaySubmit=new \Core\alipay\AlipaySubmit($alipay_config);
    	//二、构造要请求的参数数组,生成html
    	$out_trade_no=I("post.orderId");  //商户订单号，商户网站订单系统中唯一订单号，必填
		$subject=I("post.orderTitle");					  //订单名称，必填
		$total_fee=I("post.orderPaymoney");				  //付款金额，必填	
		$show_url=I("post.orderUrl");				  //收银台页面上，商品展示的超链接，必填	
		$body="";					  //商品描述，可空	

    	$parameter=array(
    		"service"       => $alipay_config['service'],
			"partner"       => $alipay_config['partner'],
			"seller_id"  	=> $alipay_config['seller_id'],
			"payment_type"	=> $alipay_config['payment_type'],
			"notify_url"	=> $alipay_config['notify_url'],
			"return_url"	=> $alipay_config['return_url'],
			"_input_charset"=> trim(strtolower($alipay_config['input_charset'])),
			"out_trade_no"	=> $out_trade_no,
			"subject"		=> $subject,
			"total_fee"		=> $total_fee,
			"show_url"		=> $show_url,
			"body"			=> $body,
		  );
    	$html_text=$alipaySubmit->buildRequestForm($parameter,"get","确认");
    	echo $html_text;
    }

}
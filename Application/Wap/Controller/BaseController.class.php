<?php
namespace Wap\Controller;
use Think\Controller;
class BaseController extends Controller{
	public static $WXSET;//全局静态配置
	public static $WAP;//WAP全局静态变量
	public static $SHOP;// Shop全局静态变量
	//微信缓存
	protected static $_wxappid;
	protected static $_wxappsecret;
	public function _initialize(){
		//检测用户是否授权登陆
		self::$WXSET=$this->getWx();
		self::$_wxappid=self::$WXSET['appid'];
		self::$_wxappsecret=self::$WXSET['wxappsecret'];
		//当前链接地址
		$_SESSION['oaurl']='http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

		//判断是否是微信浏览器 是留下openid  后面通过opeind来判断
		if(strpos($_SERVER["HTTP_USER_AGENT"],"MicroMessenger")){
			//判断是否存在授权session
			if(!$_SESSION['wap']['sqmode']){
				$options['wxappid']=self::$_wxappid;
				$options['wxappsecret']=self::$_wxappsecret;
				$wx=new \Myclass\wx\Wechat($optios);
				if($_GET['code'] && $_GET['code']!="authdeny" ){
					$re=$wx->getOAJoel($_GET['code']);//获取access_token和openid
					$access_token=$re['access_token'];
					$openid=$re['openid'];
					if($re){
						$_SESSION['wap']['sqmode']='wecha';
						$_SESSION['wap']['openid']=$openid;								
					}
					//正常处理完成，返回原链接
					$rurl=$_SESSION['oaurl'];
					$this->redirect($rurl);	
				}else{
					$_url='http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
					$squrl=$wx->getOauthRedirect($_url,'1','snsapi_base');
					header("Location:".$squrl);	
				}
			}		
		}

	}
	public function getWx(){
		$wxConf=M("wx_config")->select();
		return $wxConf[0];
	}
	//停止不动的信息通知页面处理
	public function diemsg($status,$msg){
		//成功为1，失败为0
		$status=$status?$status:'0';
		$this->assign('status',$status);
		$this->assign('msg',$msg);
		$this->display('Common@Common/diemsg');
		die();
	}
}
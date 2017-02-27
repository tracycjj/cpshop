<?php
namespace Home\Controller;
use Think\Controller;
class WxController extends Controller{
	protected $wx;
	public function _initialize(){
		$this->wx=new \Core\weixin\Wx();
	}
	public function index(){
		$echoStr = $_GET["echostr"];
		if(isset($echoStr)){
			if($this->wx->index()){echo $echoStr;exit;}
		}else{
			$openid=$this->wx->eventStart();
			$this->putOpenid($openid);
			//记录用户信息
			$this->writeUsermessage($openid);

		}
	}

	//记录openid
	public function putOpenid($openid){
		$wxuser=M("wxuser");
		$data=array();
		$data['openid']=$openid;
		$time=time();
		$data['createtime']=$time;
		$userArr=$wxuser->where("openid='{$openid}'")->field("openid")->select();
		if(!$userArr){
			$wxuser->query("insert `tp_wxuser`(openid,createtime) values('{$openid}','{$time}')");
			//$wxuser->add($data);
		}
	}
	//记录用户信息
	public function writeUsermessage($openid){
		$userMessage=$this->wx->getUserMessage($openid);
		file_put_contents(dirname(__FILE__)."/writeUsermessage.txt","记录用户信息");
	}
	//关注消息推送
	public function messagePush($openid){
		$messArr=array(
					array('title'=>"哈哈哈",'description'=>"首次关注消息自动推送","picUrl"=>"images/1.jpg","url"=>"www.baidu.com"),
					array('title'=>"哈哈哈",'description'=>"首次关注消息自动推送","picUrl"=>"images/1.jpg","url"=>"www.baidu.com")
				);
		$this->wx->transmitNews($openid,$messArr);
	}
	/*菜单生成*/
	public function createMenu(){
/*		$meunArr=array(
			'button'=>
				array(
					array(
						'name'=>urlencode("菜单一"),
						'sub_button'=>array(
							array("type"=>"click","name"=>urlencode("一-一"),"key"=>"001"),
							array("type"=>"click","name"=>urlencode("一-二"),"key"=>"002"),
							array("type"=>"click","name"=>urlencode("一-san"),"key"=>urlencode("列表")),
							)				
					),
					array(
						'name'=>urlencode("菜单二"),
						'sub_button'=>array(
							array("type"=>"view","name"=>urlencode("二-一"),"url"=>urlencode("http://xy.lx114.net/mydemo/index.php/home")),
							array("type"=>"view","name"=>urlencode("二-一"),"url"=>urlencode("http://xy.lx114.net/mydemo/index.php/home")),
							)				
					)

				)
			);*/
		$meunArr=array(
			'button'=>
				array(
					array(
						"type"=>"view",
						'name'=>urlencode("彩铃小助手"),
						"url"=>urlencode("http://www.91duofenxiang.com")			
					),
					array(
						"type"=>"view",
						'name'=>urlencode("推广者中心"),
						"url"=>urlencode("http://www.91duofenxiang.com/index.php/Home/Extension/index.html")			
					),
				)
			);
		//$wxMenu=M("wx_menu");
		//$meunArr=array();
		//$meunArr['button']=array();
		//$array=$wxMenu->select();
		//$meunArr=$this->infiniteClass($array,0);
		//var_dump($meunArr);exit;
		$xjson=json_encode($meunArr);
		$xjson=urldecode($xjson);
		echo $this->wx->meun($xjson);
	}

	//无限分类
	public function infiniteClass($array,$path=0){
		$newArr=array();

		foreach($array as $k=>$v){
			if($v['path'] == $path){
				$newArr[$k]=$v;
				$newArr[$k]['son']=$this->infiniteClass($array,$v['id']);
			}		
		}
		return $newArr;
	}



} 
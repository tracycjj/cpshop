<?php
namespace Admin\Controller;
use \Common\Lib\Controller;
class WxController extends Controller{
	public function index(){
		$wxConfig=M("wx_config");
		$configArr=$wxConfig->select();
		$this->assign('wxConfig',$configArr[0]);
		$this->display();
	}
	public function editHandler(){
		$data['token']=I("post.token");
		$data['appid']=I("post.appid");
		$data['appsecret']=I("post.appsecret");
		$data['machid']=I("post.machid");
		$data['machkey']=I("post.machkey");
		$data['wechatnumber']=I("post.wechatnumber");
		$relus=array(
				array('token','require','token为空','0','2'),
				array('appid','require','appid为空','0','2'),
				array('appsecret','require','appsecret为空','0','2'),
				array('machid','require','machid为空','0','2'),
				array('machkey','require','machkey为空','0','2'),
				array('wechatnumber','require','微信号为空','0','2'),
				);
		$wxConfig=M("wx_config");
		if(!$wxConfig->validate($relus)->create($data,2)){
			$this->error($wxConfig->getError());
		}
		if(!$wxConfig->where("id=1")->save($data)){
			$this->error("修改失败");
		}
		$this->redirect('Wx/index');
	}

	public function wxMenu(){
		$wxMenu=M("wx_menu");
		$wxMenuArr=$wxMenu->where("status=1")->select();
		//var_dump($wxMenuArr);
		$minPath=$wxMenu->order("path asc")->limit("0,1")->field("id")->select();
		$wxMenuArr=$this->infiniteClass($wxMenuArr,0);
		//var_dump($wxMenuArr);exit;
		$this->assign("wxMenuArr",$wxMenuArr);
		$this->display();
	}
	public function wxMenuAdd(){
		$wxMenu=M("wx_menu");
		$path=$wxMenu->where("path=0")->field("id,menuname")->select();
		$this->assign("path",$path);

		$this->display("addMenu");
	}
	public function wxMenuAddHanlder(){
		$data['menuname']=I("post.menuname");
		$data['type']=I("post.type");
		$data['path']=I("post.path");
		$data['keywords']=I("post.keywords");
		$wxMenu=M("wx_menu");
		$relus=array(
				array('menuname','require','菜单为空','0','3'),
				array('type','require','请选择菜单类型','0','3'),
				array('path','require','请选择菜单等级','0','3'),
				array('keywords','require','关键字为空','0','3'),
				);
		if(!$wxMenu->validate($relus)->create($data,3)){
			$this->error($wxMenu->getError());
		}
		if($wxMenu->where("path=0")->count() >= 3){
			$this->error('一级栏目最多只能存在三个！');
		}
		if(!$wxMenu->add($data)){
			$this->error("栏目添加失败！");
		}
		$this->redirect("Wx/wxMenu");
	}
	public function editMenu(){
		$id=I("get.id");
		$wxMenu=M("wx_menu");
		$menuArr=$wxMenu->where(array("id"=>array("eq","$id")))->select();
		foreach ($menuArr as $key => $value) {
			switch($value['path']){
				case 0:
				$menuArr[$key]['lever']="一级导航";
				break;
				case 1:
				$menuArr[$key]['lever']="二级导航";
				break;
			}

		}
		$path=$wxMenu->where("path=0")->field("id,menuname")->select();
		$this->assign("path",$path);
		$this->assign("item",$menuArr);
		$this->display();
	}
	public function editMenuHanlder(){
		$id=I("get.id");
		$data['menuname']=I("post.menuname");
		$data['type']=I("post.type");
		$data['path']=I("post.path");
		$data['keywords']=I("post.keywords");
		$wxMenu=M("wx_menu");
		$relus=array(
				array('menuname','require','菜单为空','0','3'),
				array('type','require','请选择菜单类型','0','3'),
				array('path','require','请选择菜单等级','0','3'),
				array('keywords','require','关键字为空','0','3'),
				);
		if(!$wxMenu->validate($relus)->create($data,3)){
			$this->error($wxMenu->getError());
		}
		if($wxMenu->where(array("path"=>array("eq",$id)))->select() &&  $data['path']!='0'){
			$this->error("请先修改其子导航！");
		}
		if(!$wxMenu->where(array("id"=>array("eq",$id)))->save($data)){
			$this->error("修改失败！");
		}
		$this->redirect("Wx/wxMenu");
	} 
	public function delMenuHanlder(){
		$id=I("get.id");
		$wxMenu=M("wx_menu");
		if($wxMenu->where(array("path"=>array("eq",$id)))->select()){
			$returnData=array("status"=>0,"content"=>"删除失败，请先删除子栏目！");
			$this->ajaxReturn($returnData);
		}
		if(!$wxMenu->where(array("id"=>$id))->delete()){
			$returnData=array("status"=>0,"content"=>"删除失败！");
			$this->ajaxReturn($returnData);
		}
		$returnData=array("status"=>1,"content"=>"删除成功！");
		$this->ajaxReturn($returnData);
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

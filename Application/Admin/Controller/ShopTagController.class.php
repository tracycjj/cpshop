<?php
namespace Admin\Controller;
use \Common\Lib\Controller;
class ShopTagController extends Controller{
	public  function index(){
		$list=M("shop_tag")->where('status=1')->select();
		$this->assign("list",$list);
		$this->display();
	}
	public function addShopTag(){
		$data['name']=I("post.name");
		$data['color']=I("post.color")?I("post.color"):"#e4e4e4";
		$data['ctime']=time();
		M("shop_tag")->add($data);
		$this->redirect("index");
	}
	public function save(){
		$type=I('post.type');
		$id=I('post.id');
		I("post.name")?$data['name']=I("post.name"):'';
		I("post.color")?$data['color']=I("post.color"):'';
		if(!M("shop_tag")->where("id={$id}")->save($data)){
			$this->ajaxReturn(array("status"=>0,"info"=>"操作失败"));
		}	
		$this->ajaxReturn(array("status"=>1,"info"=>"操作成功"));
	}
	public function delShopTag(){
		$id=I("get.id");
		M("shop_tag")->where(array("id"=>array("eq",$id)))->save(array("status"=>0));
		$this->redirect("index");
	}
}
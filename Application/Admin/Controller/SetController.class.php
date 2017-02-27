<?php
namespace Admin\Controller;
use \Common\Lib\Controller;
class SetController extends Controller{
	public function shopSet(){
		$list=M("shop_set")->select();
		$this->assign("list",$list[0]);
		$this->display();
	}
	public function editShopSetHandler(){
		$data['shopurl']=I("post.shopurl");
		$data['isyou']=I("post.isyou");
		$data['postage']=I("post.postage");
		$data['freepostage']=I("post.freepostage");
		M("shop_set")->where("id=1")->save($data);
		$this->redirect("shopSet");
	}
}
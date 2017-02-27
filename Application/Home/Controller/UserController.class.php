<?php
namespace Home\Controller;
use Home\Controller\BaseController;
class UserController extends BaseController{
	public function _initialize(){
		//一级导航
		parent::_initialize();
		$shopCateOne=M("shop_cate")->where("pid=0 and status=1")->select();
		$this->assign("shopCateOne",$shopCateOne);
		//dump($shopCateOne);
	}
	public function index(){
		$this->display();
	}
	public function addressesAdd(){
		$this->display();
	}
}
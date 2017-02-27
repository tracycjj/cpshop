<?php
namespace Admin\Controller;
use Common\Lib\Controller;
class ShopCardController extends Controller{
	public function cardList(){
		$cardList=M("shop_card")->where("status=1")->select();
		$this->assign("cardList",$cardList);
		$this->display();
	}
	public function cardAdd(){
		$this->display();
	}
	public function addCardHanlder(){
		$data['name']=I("post.name");
		$data['type']=I("post.type");
		$data['rule']=I("post.rule");
		$data['value']=I("post.value");
		$data['ctime']=time();
		
		$str1=array_merge(range("a","z"),range("0","9"));
		$str2=array_merge(range("A","Z"),range("0","9"));
		$str=array_merge($str1,$str2);
		shuffle($str);
		$str=implode('',$str);
		$data['code']=substr($str,'0','12');
		//dump($data);exit;
		$showimg=$_FILES['showimg'];
    	if(!empty($showimg['name'])){
	    	$Upload=new \Think\Upload($showimg);
	    	$Upload->maxSize=3145728;
	    	$Upload->ext=array("jpg","jpeg","gif","png");
	    	$Upload->root="/Uploads/";
	    	$Upload->savePath="Card/";
	    	$info=$Upload->Upload();
	    	if(!$info){
	    		$this->error($Upload->getError());
	    	}
	    	$data['showimg']="/Uploads/".$info['showimg']['savepath'].$info['showimg']['savename'];
    	}
    	M("shop_card")->add($data);
    	$this->redirect("cardList");
	}
}
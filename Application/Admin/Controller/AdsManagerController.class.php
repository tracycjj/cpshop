<?php
namespace Admin\Controller;
use Common\Lib\Controller;
class AdsManagerController extends Controller{
	public function adsCateList(){
		$list=M("ads_cate")->where("status=1")->select();
		$this->assign('list',$list);
		$this->display();
	}
	public function addAdsCateHandler(){
		$data['name']=I("post.name");
		$data['tag']=I("post.tag");
		$data['ctime']=time();
		M("ads_cate")->add($data);
		$this->redirect("adsCateList");
	}
	public function editAdsCate(){
		$type=I('post.type');
		$id=I('post.id');
		I("post.name")?$data['name']=I("post.name"):'';
		I("post.tag")?$data['tag']=I("post.tag"):'';
		if(!M("ads_cate")->where("id={$id}")->save($data)){
			$this->ajaxReturn(array("status"=>0,"info"=>"操作失败"));
		}	
		$this->ajaxReturn(array("status"=>1,"info"=>"操作成功"));
	}
	public function delAdsCate(){
		$id=I("get.id");
		M("ads_cate")->where("id={$id}")->save(array("status"=>0));
		$this->redirect("adsCateList");
	}

	public function adsList(){
		$adsCate=M("ads_cate")->where("status=1")->select();
		$this->assign('adsCate',$adsCate);

		$ads=M("ads");
		$pagesize=20;
		if((I("get.cid") && I("get.cid")!=0 )){
			$where='';
			I("get.cid")?$where=" and cid=".I("get.cid"):'';
			$count=$ads->where("status = 1 {$where}")->count();
			$page=new \Think\Page($count,$pagesize);
			$list=$ads->where("status=1  {$where}")->limit($page->firstRow.",".$page->listRows)->select();
		}else{
			$count=$ads->where("status = 1")->count();
			$page=new \Think\Page($count,$pagesize);
			$list=$ads->where("status=1")->limit($page->firstRow.",".$page->listRows)->select();	
		}
		$show=$page->show();
		$this->assign("page",$show);
		$this->assign("list",$list);
		$this->display();
	}
	public function addAds(){
		$adsCate=M("ads_cate")->where("status=1")->select();
		$this->assign('adsCate',$adsCate);
		$this->display();
	}
	public function addAdsHandler(){
		$data['name']=I("post.name");
		$data['tag']=I("post.tag");
		$data['cid']=I("post.cid");
		$data['profile']=I("post.profile");
		$data['link']=I("post.link");
		$data['ctime']=time();
		$relus=array(
    		array("name","require","广告名",0),
    		array("tag","require","标记为空",0),
    		array("cid","require","广告位未选择",0),
    		);
    	$picimg=$_FILES['picimg'];
    	$uploads=new \Think\Upload($picimg);
    	$uploads->maxSize=3145728;
    	$uploads->ext=array("jpg","jpeg","gif","png");
    	$uploads->root="/Uploads/";
    	$uploads->savePath="Ads/";
    	$info=$uploads->upload();
    	if(!$info){
    		$this->error($uploads->getError());
    	}
    	$data['picimg']="/Uploads/".$info['picimg']['savepath'].$info['picimg']['savename'];

   		$ads=M('ads');
    	if(!$ads->validate($relus)->create($data)){
    		$this->error($ads->getError());
    	}
    
    	if(!$ads->add($data)){
    		$this->error("添加失败!");
    	}
    	$this->redirect("adsList");

	}
	public function setPaixu(){
		$id=I("post.id");
		$data['paixu']=I("post.paixu");
		if(!M("ads")->where("id={$id}")->save($data)){
			$this->ajaxReturn(array("status"=>0,"info"=>"失败"));
		}
		$this->ajaxReturn(array("status"=>1,"info"=>"success"));
	}
	public function editAds(){
		$id=I("get.id");
		$adsCate=M("ads_cate")->where("status=1")->select();
		$ads=M("ads")->where("id={$id}")->select();
		$this->assign('ads',$ads[0]);
		$this->assign('adsCate',$adsCate);
		$this->display();
	}
	public function editAdsHandler(){
		$id=I("post.id");

		$data['name']=I("post.name");
		$data['tag']=I("post.tag");
		$data['cid']=I("post.cid");
		$data['profile']=I("post.profile");
		$data['link']=I("post.link");
		$data['ctime']=time();
		$relus=array(
    		array("name","require","广告名",0),
    		array("tag","require","标记为空",0),
    		array("cid","require","广告位未选择",0),
    		);
    	$picimg=$_FILES['picimg'];
    	if($picimg['name'] !=''){
    		$uploads=new \Think\Upload($picimg);
	    	$uploads->maxSize=3145728;
	    	$uploads->ext=array("jpg","jpeg","gif","png");
	    	$uploads->root="/Uploads/";
	    	$uploads->savePath="Ads/";
	    	$info=$uploads->upload();
	    	if(!$info){
	    		$this->error($uploads->getError());
	    	}
	    	$data['picimg']="/Uploads/".$info['picimg']['savepath'].$info['picimg']['savename'];
    	}
   		$ads=M('ads');
    	if(!$ads->validate($relus)->create($data)){
    		$this->error($ads->getError());
    	}
    	if(!M('ads')->where("id={$id}")->save($data)){
    		$this->error("修改失败!");
    	}
    	$this->redirect("adsList");
	}

	public function delAds(){
		$id=I("get.id");
		M("ads")->where("id={$id}")->save(array("status"=>0));
		$this->redirect("adsList");
	}

}
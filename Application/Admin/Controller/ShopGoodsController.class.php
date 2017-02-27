<?php
namespace Admin\Controller;
use Common\Lib\Controller;
class ShopGoodsController extends Controller{
	public function index(){
		$shopCate=D("ShopCate");
    	$cateList=$shopCate->getCate();
    	$this->assign("cateList",$cateList);

		$shopGoods=M("shop_goods");
		$pagesize=20;

		if((I("get.cid") && I("get.cid")!=0 ) || I("get.keyword")){
			$where='';
			I("get.cid")?$where=" and cid=".I("get.cid"):'';
			I("get.keyword")?$where.=" and name like '%".I("get.keyword")."%'":'';

			$count=$shopGoods->where("status = 1 {$where}")->count();
			$page=new \Think\Page($count,$pagesize);
			$list=$shopGoods->where("status=1 {$where}")->limit($page->firstRow.",".$page->listRows)->select();
		}else{
			$count=$shopGoods->where("status = 1")->count();
			$page=new \Think\Page($count,$pagesize);
			$list=$shopGoods->where("status=1")->limit($page->firstRow.",".$page->listRows)->select();
		}
		$show=$page->show();
		$this->assign("page",$show);
		$this->assign("list",$list);
		$this->display();

	}
	public function addGoods(){
		$shopCate=D("ShopCate");
    	$cateList=$shopCate->getCate();

    	$shopTag=M("shop_tag");
    	$tagList=$shopTag->where("status=1")->select();

    	$this->assign("cateList",$cateList);
    	$this->assign("tagList",$tagList);
		$this->display();
	}
	public function addGoodsHanlder(){
		$data['name']=I("post.name");
		$data['cid']=I("post.cid");
		$data['pricenow']=I("post.pricenow");
		$data['priceold']=I("post.priceold");
		$data['sales']=I("post.sales");
		$data['stocks']=I("post.stocks");
		$data['goodsattr']=I("post.goodsattr");
		$data['content']=I("post.content");
		$data['profile']=I("post.profile");

		$data['ctime']=time();
		I("post.tagid")?$data['tagid']=implode(',',I("post.tagid")):'';
		$fx=I("post.fx");
		//dump($fx);
		if($fx[0]){
			$datafx['o']=$fx[0];
			$datafx['t']=$fx[1];
			$datafx['s']=$fx[2];
			$data['fx']=serialize($datafx);
			//dump($data['fx']);
		}
		$picimg=$_FILES['picimg'];
    	if($picimg['name'] != ''){
	    	$Upload=new \Think\Upload();
	    	$Upload->maxSize=3145728;
	    	$Upload->ext=array("jpg","jpeg","gif","png");
	    	$Upload->root="/Uploads/";
	    	$Upload->savePath="ShopGoods/";
	    	$info=$Upload->UploadOne($_FILES['picimg']);
	    	if(!$info){
	    		$this->error($Upload->getError());
	    	}
	    	$data['picimg']="/Uploads/".$info['savepath'].$info['savename'];
    	}
    	$goodsimg=$_FILES['goodsimg'];
    	if($goodsimg['name'][0] != ''){
	    	$Upload=new \Think\Upload($_FILES['goodsimg']);
	    	$Upload->maxSize=3145728;
	    	$Upload->ext=array("jpg","jpeg","gif","png");
	    	$Upload->root="/Uploads/";
	    	$Upload->savePath="ShopGoods/";
	    	$info=$Upload->Upload();
	    	if(!$info){
	    		//echo $Upload->getError();
	    		$this->error($Upload->getError());
	    	}
	    	$goodsimg='';
	    	foreach($info as $ik=>$iv){
	    		$goodsimg.="/Uploads/".$iv['savepath'].$iv['savename'].",";
	    	}
	    	$data['goodsimg']=$goodsimg;
    	}

    	if(!M("shop_goods")->add($data)){
    		$this->error("添加失败!");
    	}
    	$this->redirect("index");
	}
	public function editGoods(){
		$shopCate=D("ShopCate");
    	$cateList=$shopCate->getCate();
    	$this->assign("cateList",$cateList);

    	$shopTag=M("shop_tag");
    	$tagList=$shopTag->where("status=1")->select();
    	$this->assign("tagList",$tagList);

    	$id=I("get.id");
    	$goods=M("shop_goods")->where("id={$id}")->select();
    	$img=explode(",",$goods[0]['goodsimg']);
    	array_pop($img);
    	$goods[0]['img']=$img;
    	//$goods['tagidArr']=explode(",",$goods[0]['tagid']);
    	$goods[0]['fxarr']=unserialize($goods[0]['fx']);
    	//dump($goods[0]['fxarr']);
    	$this->assign("goods",$goods[0]);
    	$this->assign("img",$img);
    	$this->display();

	}
	public function editGoodsHanlder(){
		$id=I("post.id");
		$data['name']=I("post.name");
		$data['cid']=I("post.cid");
		$data['pricenow']=I("post.pricenow");
		$data['priceold']=I("post.priceold");
		$data['sales']=I("post.sales");
		$data['stocks']=I("post.stocks");
		$data['goodsattr']=I("post.goodsattr");
		$data['content']=I("post.content");
		$data['profile']=I("post.profile");
		$data['ctime']=time();
		I("post.tagid")?$data['tagid']=implode(',',I("post.tagid")):'';
		$fx=I("post.fx");
		//dump($fx);
		if($fx[0]){
			$datafx['o']=$fx[0];
			$datafx['t']=$fx[1];
			$datafx['s']=$fx[2];
			$data['fx']=serialize($datafx);
			//dump($data['fx']);
		}
		$picimg=$_FILES['picimg'];
    	if($picimg['name'] != ''){
	    	$Upload=new \Think\Upload();
	    	$Upload->maxSize=3145728;
	    	$Upload->ext=array("jpg","jpeg","gif","png");
	    	$Upload->root="/Uploads/";
	    	$Upload->savePath="ShopGoods/";
	    	$info=$Upload->UploadOne($_FILES['picimg']);
	    	if(!$info){
	    		$this->error($Upload->getError());
	    	}
	    	$data['picimg']="/Uploads/".$info['savepath'].$info['savename'];
    	}
    	//商品图片
    	$oldgoodsimg=I("post.oldgoodsimg")?implode(',',I("post.oldgoodsimg")).",":'';
    	//dump($oldgoodsimg);exit;
    	$goodsimg=$_FILES['goodsimg'];
    	if($goodsimg['name'][0] != ''){
	    	$Upload=new \Think\Upload($_FILES['goodsimg']);
	    	$Upload->maxSize=3145728;
	    	$Upload->ext=array("jpg","jpeg","gif","png");
	    	$Upload->root="/Uploads/";
	    	$Upload->savePath="ShopGoods/";
	    	$info=$Upload->Upload();
	    	if(!$info){
	    		//echo $Upload->getError();
	    		$this->error($Upload->getError());
	    	}
	    	$goodsimgstr='';
	    	foreach($info as $ik=>$iv){
	    		$goodsimgstr.="/Uploads/".$iv['savepath'].$iv['savename'].",";
	    	}
	    }else{
	    	$goodsimgstr='';
	    }
	    $data['goodsimg']=$oldgoodsimg.$goodsimgstr;
	    if(!M("shop_goods")->where("id={$id}")->save($data)){
    		$this->error("修改失败!");
    	}
    	$this->redirect("index");
	}
	
	public function xiajia(){
		$id=I("get.id");
		$zt=I("get.zt");
		if(M("shop_goods")->where("id={$id}")->save(array('xiajia'=>$zt))){
    		$this->ajaxReturn(array("status"=>1,"info"=>"success"));	
    	}
    	
	}
	public function delGoods(){
		$id=I("get.id");
		if(M("shop_goods")->where("id={$id}")->save(array('status'=>0))){
    		$this->ajaxReturn(array("status"=>1,"info"=>"success"));	
    	}
	}
	public function goodsAttr(){
		$id=I("get.id");
		$goods=M("shop_goods")->where("id={$id}")->select();
    	$this->assign("goods",$goods[0]);
    	//属性
    	$shopAttr=M("shop_attr")->where("pid=0 and status=1")->select();
    	foreach($shopAttr as $k=>$v){
    		$attrTwo=M("shop_attr")->where("pid={$v['id']} and status=1")->select();
    		$shopAttr[$k]['son']=$attrTwo;
    	}
    	//goods_attr表gid=$id的属性
    	$gattr=M("goods_attr")->where("gid=$id and status=1")->select();
    	//单独得到gid=$id的attrid
    	$attrdb=array();
    	foreach($gattr as $ak=>$av){
    		$attrdb[]=$av['attrid'];
    	}
    	//dump($attrdb);
    	$this->assign("shopAttr",$shopAttr);
    	$this->assign("gattr",$gattr);
    	$this->assign("attrdb",$attrdb);
    	//dump($attrdb);
		$this->display();
	}
	public function addGoodsAttrHandler(){
		$gid=I('get.gid');
		$data['gid']=$gid;
		//得到当前gid随所选属性
		$gattr=M("goods_attr")->where("gid={$gid} and status=1")->field('attrid')->select();
		$attrdb=array();
    	foreach($gattr as $ak=>$av){
    		$attrdb[]=$av['attrid'];
    	}
    	$attr=I("post.sonattr");
    	$attrP=array();
		foreach($attr as $k=>$v){
			$arr=explode('-',$v);
			$data['attrpid']=$arr[0];
			$data['attrid']=$arr[1];
			$attrname=M("shop_attr")->where("id={$arr[1]}")->field("name,color")->select();
			$data['attrname']=$attrname[0]['name'];//attrname
			$data['color']=$attrname[0]['color'];//attrname
			$data['price']=0;
			if(!in_array($data['attrid'],$attrdb)){
				M("goods_attr")->add($data);
			}
			$attrP[]=$arr[0];
		}
		//dump($attrP);
		//查出gid现有的大属性id 
		$gattr=M("shop_goods")->where("id={$gid}")->field('attrid')->select();
		//dump($gattr);
		$gattrnew=array();
		if($gattr[0]['attrid'] && $gattr[0]['attrid'] != ''){
			foreach($gattr as $v){
				$gattrnew=explode(',',$v['attrid']);
			}
			$attrP=array_merge($gattrnew,$attrP);
		}
		//dump($attrP);
		//合并所有属性，去掉重复值
		$attrid=array_unique($attrP);
		$attrid=implode(',',$attrid);
		//echo $attrid;exit;
		M("shop_goods")->where("id={$gid}")->save(array("attrid"=>$attrid));
		$this->redirect("goodsAttr",array('id'=>$gid));
	}
	public function delGoodsAttr(){
		$id=I("get.id");

		//查一下这个的attrpid 是否还存在被添加的子属性
		$attrpid=M('goods_attr')->where("id={$id}")->field('attrpid,gid')->select();
		$count=M("goods_attr")->where("attrpid={$attrpid[0]['attrpid']} and id !={$id} and gid={$attrpid[0]['gid']} and status=1")->count();
		//echo $count;exit;
		if(!$count){
			//修改shop_goods表的attrid
			$goodsAttrid=M("shop_goods")->where("id={$attrpid[0]['gid']}")->field("attrid")->select();
			$goodsAttrid=explode(',',$goodsAttrid[0]['attrid']);
			foreach($goodsAttrid as $k=>$v){
				if($attrpid[0]['attrpid'] == $v){
					unset($goodsAttrid[$k]);
				}
			}
			//dump($goodsAttrid);
    		$data['attrid']=implode(",",$goodsAttrid);
    		//dump($data['attrid']);exit;
    		M("shop_goods")->where("id={$attrpid[0]['gid']}")->save($data);
		}
		//echo $count;exit;
		//删除此属性
		M("goods_attr")->where("id={$id}")->save(array("status"=>0));
		$this->redirect("goodsAttr",array('id'=>$attrpid[0]['gid']));

	}
	public function saveAttrPrice(){
		$id=I("get.id");
		$data['price']=I("get.price");
		if(!M("goods_attr")->where("id={$id}")->save($data)){
			$this->ajaxReturn(array('status'=>0,"info"=>'失败!'));
		}
		$this->ajaxReturn(array('status'=>1,"info"=>'成功!'));
	}
}
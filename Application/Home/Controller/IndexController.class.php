<?php
namespace Home\Controller;
use Home\Controller\BaseController;
class IndexController extends BaseController{
	public function _initialize(){
		//一级导航
        parent::_initialize();
		$shopCateOne=M("shop_cate")->where("pid=0 and status=1")->select();
		$this->assign("shopCateOne",$shopCateOne);
	}
    public function index(){
    	//首页展示栏目
        $cate=M("shop_cate")->where("status=1")->limit("0,1")->select();
    	$showCate=M("shop_cate")->where("pid={$cate[0]['id']} and status=1")->limit("0,6")->select();
    	$shopGoods=M("shop_goods");
    	foreach($showCate as $nk=>$nv){
			$goodsCount=$shopGoods->where("cid={$nv['id']} and status=1 and xiajia=1")->count();
			$showCate[$nk]['goodsCount']=$goodsCount;
    	}
        $this->assign('showCate',$showCate);
    	$this->assign('cate',$cate[0]);
    	$this->display();		
    }
    public function shopCate(){
        $cid=I("get.cid");
        $shopCate=M("shop_cate");
        $cate=$shopCate->where("id={$cid} and status=1")->select();
        if(!$cate){
            $this->error("此栏目不存在!");
        }
        $this->assign("cate",$cate[0]);
        //查找是否有子分类
        $cateSon=$shopCate->where("pid={$cid} and status=1")->select();
        if($cateSon){
            $shopGoods=M("shop_goods");
            foreach($cateSon as $nk=>$nv){
                $goodsCount=$shopGoods->where("cid={$nv['id']} and status=1 and xiajia=1")->count();
                $cateSon[$nk]['goodsCount']=$goodsCount;
            }
            $this->assign("cateSon",$cateSon);
            $this->display("cate");
        }else{
            //查找产品
            $shopGoods=M("shop_goods");
            $goodsList=$shopGoods->where("cid={$cid} and status=1 and xiajia=1")->select();
            //查找标签

            $this->assign("goodsList",$goodsList);
            $this->display("goodsList");
        }
    }
    public function index1(){
    	$this->display("index-ceshi");
    }
 
}
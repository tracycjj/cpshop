<?php
// 本类由系统自动生成，仅供测试用途
namespace Admin\Controller;
use Common\Lib\Controller;
class ShopCateController extends Controller {
    public function index(){
    	$shopCate=D("shop_cate");
    	$list=$shopCate->getCateList();
    	$this->assign("list",$list);
    	$this->display();
    }
    public function addCate(){
    	$shopCate=D("shop_cate");
    	$cateList=$shopCate->getCate();
    	$this->assign("cateList",$cateList);
    	$this->display();
    }
    public function addCateHanlder(){
    	$data['pid']=I("post.pid");
    	$data['name']=I("post.name");
    	$data['note']=I("post.note");
    	$data['ctime']=time();
    	$relus=array(
    		array("name","require","分类名为空！",0),
    		);
    	$picimg=$_FILES['picimg'];
    	if(!empty($picimg['name'])){
	    	$Upload=new \Think\Upload($picimg);
	    	$Upload->maxSize=3145728;
	    	$Upload->ext=array("jpg","jpeg","gif","png");
	    	$Upload->root="/Uploads/";
	    	$Upload->savePath="ShopCate/";
	    	$info=$Upload->Upload();
	    	if(!$info){
	    		$this->error($Upload->getError());
	    	}
	    	$data['picimg']="/Uploads/".$info['picimg']['savepath'].$info['picimg']['savename'];
    	}
    	$shopCate=D("shop_cate");
    	$data=$shopCate->getCatePath($data);
    	if(!$shopCate->validate($relus)->create($data)){
    		$this->error($shopCate->getError());
    	}
    	if(!$shopCate->add($data)){
    		$this->error("添加失败!");
    	}
    	$this->redirect("index");
    }
    public function editCate(){
    	$id=I('get.id');
    	$shopCate=D("shop_cate");
    	$cateList=$shopCate->getCate($id);
    	$this->assign("cateList",$cateList);

    	$cate=$shopCate->where("id={$id}")->select();
    	$this->assign("cate",$cate[0]);
    	$this->display();
    }
    public function editCateHanlder(){
    	$id=I("post.id");
    	$data['pid']=I("post.pid");
    	$data['name']=I("post.name");
    	$data['note']=I("post.note");
    	$data['ctime']=time();
    	$relus=array(
    		array("name","require","分类名为空！",0),
    		);
    	$picimg=$_FILES['picimg'];
    	if(!empty($picimg['name'])){
	    	$Upload=new \Think\Upload($picimg);
	    	$Upload->maxSize=3145728;
	    	$Upload->ext=array("jpg","jpeg","gif","png");
	    	$Upload->root="/Uploads/";
	    	$Upload->savePath="ShopCate/";
	    	$info=$Upload->Upload();
	    	if(!$info){
	    		$this->error($Upload->getError());
	    	}
	    	$data['picimg']="/Uploads/".$info['picimg']['savepath'].$info['picimg']['savename'];
    	}
    	$shopCate=D("shop_cate");
    	$data=$shopCate->getCatePath($data);
    	if(!$shopCate->validate($relus)->create($data)){
    		$this->error($shopCate->getError());
    	}
    	if(!$shopCate->where("id={$id}")->save($data)){
    		$this->error("修改失败!");
    	}
    	$this->redirect("index");
    }
    public function delCate(){
        $id=I("get.id");
        //看看是否存在下级了栏目
        $xiaji=M("shop_cate")->where("pid={$id} and status =1")->count();
        if($xiaji>0){
            $this->error("存在子栏目，请先删除子栏目!");    
        }
        M("shop_cate")->where("id={$id}")->save(array('status'=>0));
        $this->redirect("index");
        

    }
}
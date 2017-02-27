<?php
namespace Admin\Controller;
use Common\Lib\Controller;
class ArticleController extends Controller{
	public function _initialize(){
		$artCate=D("article");
		$list=M('article_cate')->where("status=1")->select();
		$list=$artCate->getArtcateList($list);
		$this->assign("artCatelist",$list);
	}
	public function artCateList(){
		$artCate=D("article");
		$list=M('article_cate')->where("status=1")->select();
		$list=$artCate->getArtcateList($list);
		$this->assign("list",$list);
		$this->display();
	}
	public function artCateAdd(){
		$artCate=D("article");
		$list=M('article_cate')->where("status=1")->select();
		$list=$artCate->getArtcateList($list);
		$this->assign("catelist",$list);
		$this->display();
	}

	public function artCateAddHandler(){
		$data['pid']=I("post.pid");
    	$data['name']=I("post.name");
    	$data['profile']=I("post.profile");
    	$data['tag']=I("post.tag");
    	$data['type']=I("post.type");
    	$data['show']=I("post.show");
    	$data['ctime']=time();
    	$relus=array(
    		array("name","require","分类名为空！",0),
    		);
    	$picimg=$_FILES['picimg'];
    	if(!empty($picimg['name'])){
	    	$uploads=new \Think\Upload($picimg);
	    	$uploads->maxSize=3145728;
	    	$uploads->ext=array("jpg","jpeg","gif","png");
	    	$uploads->root="/Uploads/";
	    	$uploads->savePath="Article/";
	    	$info=$uploads->upload();
	    	if(!$info){
	    		$this->error($uploads->getError());
	    	}
	    	$data['picimg']="/Uploads/".$info['picimg']['savepath'].$info['picimg']['savename'];
    	}
    	$articleCate=M("article_cate");
    	
    	if(!$articleCate->validate($relus)->create($data)){
    		$this->error($shopCate->getError());
    	}
    	//cate level path
    	$data=D("article")->getCatePath($data);
    	 //dump($data);exit;
    	if(!$articleCate->add($data)){
    		$this->error("添加失败!");
    	}
    	$this->redirect("artCateList");
	}
	public function editArtCate(){
		$id=I("get.id");
		$artCate=D("article");
		$list=M('article_cate')->where("status=1 and id!={$id}")->select();
		$list=$artCate->getArtcateList($list);
		$this->assign("catelist",$list);

		$artCate=M('article_cate')->where("status=1 and id={$id}")->select();
		$this->assign("artCate",$artCate[0]);
		$this->display();
	}
	public function editCateAddHandler(){
		$id=I("post.id");
		$data['pid']=I("post.pid");
    	$data['name']=I("post.name");
    	$data['profile']=I("post.profile");
    	$data['tag']=I("post.tag");
    	$data['type']=I("post.type");
    	$data['show']=I("post.show");
    	$data['ctime']=time();
    	$relus=array(
    		array("name","require","分类名为空！",0),
    		);
    	$picimg=$_FILES['picimg'];
    	if(!empty($picimg['name'])){
	    	$uploads=new \Think\Upload($picimg);
	    	$uploads->maxSize=3145728;
	    	$uploads->ext=array("jpg","jpeg","gif","png");
	    	$uploads->root="/Uploads/";
	    	$uploads->savePath="Article/";
	    	$info=$uploads->upload();
	    	if(!$info){
	    		$this->error($uploads->getError());
	    	}
	    	$data['picimg']="/Uploads/".$info['picimg']['savepath'].$info['picimg']['savename'];
    	}
    	$articleCate=M("article_cate");
    	
    	if(!$articleCate->validate($relus)->create($data)){
    		$this->error($shopCate->getError());
    	}
    	$data=D("article")->getCatePath($data);
    	if(!$articleCate->where("id={$id}")->save($data)){
    		$this->error("添加失败!");
    	}
    	$this->redirect("artCateList");
	}
	public function delArtCate(){
		$id=I('get.id');
		$xiaji=M("article_cate")->where("pid={$id} and status =1")->count();
        if($xiaji>0){
            $this->error("存在子栏目，请先删除子栏目!");    
        }
		if(!M('article_cate')->where("id={$id}")->save(array('status'=>0))){
			$this->error("删除失败!");
		}
		$this->redirect("artCateList");

	}

	//文章
	public function artAdd(){
		$this->display();
	}
	public function addArtHanlder(){
		$data['title']=I("post.title");
		$data['cid']=I("post.cid");
		$data['profile']=I("post.profile");
		$data['content']=I("post.content");
		$data['ctime']=time();
		$picimg=$_FILES['picimg'];
    	if(!empty($picimg['name'])){
	    	$uploads=new \Think\Upload($picimg);
	    	$uploads->maxSize=3145728;
	    	$uploads->ext=array("jpg","jpeg","gif","png");
	    	$uploads->root="/Uploads/";
	    	$uploads->savePath="Article/";
	    	$info=$uploads->upload();
	    	if(!$info){
	    		$this->error($uploads->getError());
	    	}
	    	$data['picimg']="/Uploads/".$info['picimg']['savepath'].$info['picimg']['savename'];
    	}
    	if(!M("article")->add($data)){
    		$this->error("添加失败!");    
    	}
    	$this->redirect("artList");
	}
	public function artList(){
		$article=M("article");
		$pagesize=20;
		if((I("get.cid") && I("get.cid")!=0 ) || I("get.keyword")){
			$where='';
			I("get.cid")?$where=" and cid=".I("get.cid"):'';
			I("get.keyword")?$where.=" and name like '%".I("get.keyword")."%'":'';
			$count=$article->where("status=1 {$where}")->count();

			$page=new \Think\Page($count,$pagesize);

			$where='';
			I("get.cid")?$where=" and ar.cid=".I("get.cid"):'';
			I("get.keyword")?$where.=" and ar.name like '%".I("get.keyword")."%'":'';
			$list=$article->table("tp_article as ar,tp_article_cate as ac")
							->where("ar.status=1 and ar.cid=ac.id {$where}")
							->field("ar.id,ar.title,ar.profile,ar.ctime,ac.name")
							->limit($page->firstRow.",".$page->listRows)
							->select();	
		}else{
			$count=$article->where("status=1")->count();
			$page=new \Think\Page($count,$pagesize);
			$list=$article->table("tp_article as ar,tp_article_cate as ac")
							->where("ar.status=1 and ar.cid=ac.id")
							->field("ar.id,ar.title,ar.profile,ar.ctime,ac.name")
							->limit($page->firstRow.",".$page->listRows)
							->select();
		}
		//echo $article->getLastSql();
		$show=$page->show();
		$this->assign("page",$show);
		$this->assign("list",$list);
		$this->display();
	}
	public function editArt(){
		$id=I("get.id");
		$art=M("article")->where("id={$id}")->select();
		$this->assign("art",$art[0]);
		$this->display();
	}
	public function editArtHanlder(){
		$id=I("post.id");
		$data['title']=I("post.title");
		$data['cid']=I("post.cid");
		$data['profile']=I("post.profile");
		$data['content']=I("post.content");
		$data['ctime']=time();
		$picimg=$_FILES['picimg'];
    	if(!empty($picimg['name'])){
	    	$uploads=new \Think\Upload($picimg);
	    	$uploads->maxSize=3145728;
	    	$uploads->ext=array("jpg","jpeg","gif","png");
	    	$uploads->root="/Uploads/";
	    	$uploads->savePath="Article/";
	    	$info=$uploads->upload();
	    	if(!$info){
	    		$this->error($uploads->getError());
	    	}
	    	$data['picimg']="/Uploads/".$info['picimg']['savepath'].$info['picimg']['savename'];
    	}
    	if(!M("article")->where("id={$id}")->save($data)){
    		$this->error("修改失败!");    
    	}
    	$this->redirect("artList");
	}
}
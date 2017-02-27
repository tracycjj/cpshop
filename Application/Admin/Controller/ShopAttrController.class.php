<?php
// 本类由系统自动生成，仅供测试用途
namespace Admin\Controller;
use Common\Lib\Controller;
class ShopAttrController extends Controller{
	public function index(){
		$list=M("shop_attr")->where("status=1 and pid=0")->select();
		foreach($list as $k=>$v){
			$attrValue=M("shop_attr")->where("pid={$v['id']}  and status = 1")->field("name")->select();
			$sonName='';
			foreach($attrValue as $kk=>$vv){
				$sonName.=$vv['name'].",&nbsp;&nbsp;&nbsp;";
			}
			$list[$k]['sonName']=$sonName;
		}
		//dump($list);
		$this->assign("list",$list);
		$this->display();
	}
	public function addAttrHandler(){
		$data['name']=I("post.name");
		$data['color']=I("post.color")?I("post.color"):"#5BC0DE";
		$data['ctime']=time();
		M("shop_attr")->add($data);
		$this->redirect("index");
	}
	public function delAttrHandler(){
		$id=I("get.id");
		$arr=M("shop_attr")->where("pid={$id}")->field('id')->select();
		$idArr=array();
		$idArr[]=$id;

		if(empty($arr)){
			M("shop_attr")->where(array("id"=>array("eq",$id)))->save(array("status"=>0));
			//echo M("shop_attr")->getLastSql();exit;
			$this->success('删除成功','',0);
		}else{
			foreach ($arr as $key => $value) {
				$idArr[]=$value['id'];
			}
			M("shop_attr")->where(array("id"=>array("in",$idArr)))->save(array("status"=>0));
			$this->redirect("index");
		}
		
		
	}	
	public function editAttr(){
		$pid=I("get.id");
		$attr=M("shop_attr")->where("id=$pid  and status = 1")->select();
		$attrSon=M("shop_attr")->where("pid=$pid and status = 1")->select();
		$this->assign("attr",$attr);
		$this->assign("attrSon",$attrSon);
		$this->assign("pid",$pid);
		$this->display();
	}
	public function editAttrHandler(){
		$pid=I("get.pid");
		$data['pid']=$pid;
		$data['name']=I("post.name");
		$data['color']=I("post.color")?I("post.color"):"#5BC0DE";
		$data['ctime']=time();
		M("shop_attr")->add($data);
		$this->redirect("editAttr",array("id"=>$pid));
	}
	public function save(){
		$type=I('post.type');
		$id=I('post.id');
		I("post.name")?$data['name']=I("post.name"):'';
		I("post.color")?$data['color']=I("post.color"):'';
		if(!M("shop_attr")->where("id={$id}")->save($data)){
			$this->ajaxReturn(array("status"=>0,"info"=>"操作失败"));
		}	
		$this->ajaxReturn(array("status"=>1,"info"=>"操作成功"));
	}
}
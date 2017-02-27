<?php
namespace Admin\Model;
use Think\Model;
class ShopCateModel extends Model{
	public function _intialize(){

	}
	//for addCate or editCate
	public function getCate($id){
		$shopCate=M("shop_cate");
		$cateList=$shopCate->where("status=1")->select();
		if($id){
			$cateList=$shopCate->where("status=1 and id != $id ")->select();
		}
		$cateList=$this->cateTree($cateList,0);
		return $cateList;	
	}
	public function cateTree($cate,$pid){
		$newList=array();
		foreach($cate as $k=>$v){
			if($v['pid']==$pid){
				if($pid >0 ){
					$str='';
					for($i=1;$i<$v['level'];$i++){
						$str.="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
					}
					$v['name']=$str.$v['name'];
				}
				$newList[]=$v;
				$newList=array_merge($newList,$this->cateTree($cate,$v['id']));
			}
		}
		return $newList;
	}
	//for list
	public function getCateList(){	
		$shopCate=M("shop_cate");
		$cateList=$shopCate->where("status=1")->select();
		$cateList=$this->shopCateTree($cateList,0);
		return $cateList;
	}
	public function shopCateTree($cate,$pid){
		$newList=array();
		foreach($cate as $k=>$v){
			if($v['pid']==$pid){
				$newList[]=$v;
				$newList=array_merge($newList,$this->shopCateTree($cate,$v['id']));
			}
		}
		return $newList;
	}
	public function getCatePath($data){
		$shopCate=M("shop_cate");
		if($data['pid'] == 0){
    		$data['level']=1;
    		$data['path']=0;
    	}else{
    		$data['level']=2;
    		$data['path']="0-".$data['pid'];
    		//查一查pid的pid是否存在
    		$pid=$shopCate->where("id ={$data['pid']} and status =1")->field("pid")->select();
    		if($pid[0]['pid']!=0){
    			$data['level']=3;
    			$data['path']="0-".$data['pid']."-".$pid[0]['pid'];
    		}
    	}
    	return $data;
	}

	public function delCate($id){
		$shopCate=M("shop_cate");
		//删除id=$id的和pid=$id的
		$idarr=$shopCate->where("pid={$id}")->field("id")->select();
	}

}

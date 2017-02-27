<?php
namespace Admin\Model;
use Think\Model;
class ArticleModel extends Model{
	public function _intialize(){

	}
	public function getArtcateList($cate,$pid=0){

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
				$newList=array_merge($newList,$this->getArtcateList($cate,$v['id']));
			}
		}
		return $newList;
	}
	public function getCatePath($data){
		$shopCate=M("article_cate");
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
}
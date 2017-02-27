<?php
namespace Common\Taglib;
use Think\Template\Taglib;
defined('THINK_PATH') or exit();
class Mytag extends Taglib{
	protected $tags=array(
		'test'=>array('attr'=>'src','close'=>'1'),
		'advert'=>array("attr"=>'limit,order','close'=>1),//广告列表
		'similar'=>array("attr"=>'gid,limit,order','close'=>1),//相似产品
		);

	public function _test($attr,$content){
		dump($attr);
		return "$content";
	}
	/*广告数据
	*<advert limit='1,9' tag='ceshi' order="id desc">
    *	<li><a href='[field:link]'><img src='[field:picimg]' /></a></li>
	*</advert>
	*/
	public function _advert($attr,$content){
		$advert=M('ads');
		$limit=$attr['limit'];
		$order=$attr['order'];
		$tag=$attr['tag'];
		$cateid=M('ads_cate')->where("tag='{$tag}'")->field("id")->select();
		$list=$advert->where("status=1 and cid={$cateid[0]['id']}")->limit("$limit")->order("$order")->select();
		$str=$this->tagCtList($content,$list);
		return $str;
	}
	/*文章数据
	*<advert limit='1,9' tag='ceshi' order="id desc">
    *	<li><a href='[field:link]'><img src='[field:picimg]' /></a></li>
	*</advert>
	*/

	/*商品数据
	*<similar gid="1" limit='1,9'  order="id desc">
    *	<li><a href='[field:link]'><img src='[field:picimg]' /></a></li>
	*</similar>
	*/
	public function _similar($attr,$content){
		$goods=M("goods");
		$gid=$attr['gid'];
		$limit=$attr['limit'];
		$order=$attr['order'];
		$goodsMess=$goods->where("id={$gid}")->select();
		dump($gid);

	}

	public function tagCtList($content,$list){
		preg_match_all('/\[field:(.*?)\]/',$content,$arry); //读取标签
	    $tag = $arry[0]; //匹配标签
	    $key = $arry[1]; //标签字段
	    $str='';
	    for($i=0;$i<count($list);$i++){
	        $c = $content; 
	        //替换标签
	        foreach($tag as $k=>$v){
	            //分割字符串，如果有函数那么执行函数后在输出
	            $arr = explode('|',$key[$k]);
	            $th = $list[$i][$arr[0]];
	            if($arr[1]){
	                $arr[1] = str_replace('###',$list[$i][$arr[0]],$arr[1]);
	                $a = '$th'." =$arr[1]";
	                eval($a.';');
	            }
	            $c = str_replace($v,$th,$c);
	        }
	        $str.=$c;
	    }
	    return $str;
	}
}

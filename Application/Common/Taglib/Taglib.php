<?php
namespace Common\Taglib;
use Think\Template;
defined('THINK_PATH') or exit();
class Taglib extends Taglib{
	protected $tags=array(
		'test'=>array('attr'=>'src','close'=>'0'),
		);

	public function _test($attr,$content){
		return "";
	}
}

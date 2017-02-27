<?php
namespace Admin\Controller;
use Think\Controller;

/**
* 异步获取JSON数据类
*/
class AjaxController extends Controller
{

	public function memberChart()
	{
		$json = array();
		//echo strtotime(date("Y-m-d"));;
		$t = strtotime(date("Y-m-d"));
		for ($i=0; $i < 10; $i++) {
			$member = M('log')
				-> where(array('type'=>4,'title'=>'登录成功','createtime'=>array('between',array($t-$i*24*3600,$t-($i-1)*24*3600))))
				-> count();
			$driver = M('log')
				-> where(array('type'=>3,'title'=>'登录成功','createtime'=>array('between',array($t-($i+1)*24*3600,$t-$i*24*3600))))
				-> count();
			//echo $member;
			$json[] = array(
				'period' => date("Y-m-d",$t-$i*24*3600),
				'member' => $member,
				'driver' => $driver,
				);
		}
		$this -> ajaxReturn($json);
	}

	public function userName()
	{
		$json = array();
		$json['username'] = session('username') ? session('username') : "Anonymous";
		$this -> ajaxReturn($json);
	}

	public function message()
	{
		$where = array('status' => 0);//新消息
		$json = array();
		$json['count'] = M('message') -> where($where) -> count();
		if($json['count']){
			$items = M('message') -> where($where) -> limit(5) -> select();
		}
		foreach ($items as $key => $value) {
			$items[$key]['createtime'] = date('Y-m-d H:i:s',$value['createtime']);
			if($value['type'] == 1){
				$items[$key]['icon'] = M('member') -> where(array('id' => $value['user_id'])) -> getField('icon');
			}elseif ($value['type'] == 2) {
				$items[$key]['icon'] = M('driver') -> where(array('id' => $value['user_id'])) -> getField('icon');
			}
			$items[$key]['url'] = U('Message/detail', 'id='.$value['id']);
		}
		$json['items'] = $items;
		$json['listAll'] = U('Message/listAll');
		$this -> ajaxReturn($json);
	}

}
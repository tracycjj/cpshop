<?php
namespace Admin\Controller;
//use Think\Controller;
use Common\Lib\Controller;
class NodeController extends Controller {
	public function listAll()
	{
		//$nodes = \Common\Lib\Rbac::getNodeList('Admin');
		//dump($nodes);die;
		$nodes = M('node') -> select();
		$nodes = node_arr_restructure($nodes);
		//dump($nodes);die;
		$this -> assign(array(
			//'item' => $nodes,
			'items' => $nodes,
			));
		$this -> display();
	}

	public function listAllHandler()
	{
		$nodes = I('post.node');
		M('node') -> where(array('id' => array('IN',$nodes))) -> save(array('status' => 1));
		M('node') -> where(array('id' => array('NOT IN',$nodes))) -> save(array('status' => 0));
		$this -> redirect('listAll');
	}

	/*配置控制器*/
	public function editController()
	{
		$id = I('get.id');
		$nodes = \Common\Lib\Rbac::getNodeList('Admin');
		$app = M('node') -> where(array('id' => $id)) -> field('name,title') -> find();
		$controllers = array();
		foreach ($nodes[$app['name']]['child'] as $key => $value) {
			$controllers[] = $key;
		}
		$list = M('node') -> where(array('pid' => $id, 'level' => 2)) -> select();
		//dump($list);die;
		$items = array();
		foreach ($list as $key => $value) {
			$items[] = $value['name'];
		}
		$items = array_diff($controllers, $items);
		$this -> assign(array(
			'items' => $items,
			'list' => $list,
			'id' => $id,
			'title' => $app['title'],
			));
		$this -> display();
	}

	public function addControllerHandler()
	{
		$pid = I('post.pid');
		$data = array(
			'name' => I('post.name'),
			'title' => I('post.title'),
			'status' => 1,
			'pid' => 1,
			'level' => 2
			);
		if(M('node')->add($data)){
			$this -> redirect('editController', array('id' => $pid));
		}else{
			$this -> error('操作失败！');
		}
	}

	public function editControllerHandler()
	{
		$id = I('post.id');
		$pid = I('post.pid');
		$data = array(
			'title' => I('post.title')
			);
		M('node') -> where(array('id' => $id)) -> save($data);
		$this -> redirect('editController', array('id' => $pid));
	}

	/*配置行为*/
	public function editAction()
	{
		$id = I('get.id');
		$pid = I('get.pid');
		$nodes = \Common\Lib\Rbac::getNodeList('Admin');
		$controller = M('node') -> where(array('id' => $id)) -> field('name,title') -> find();
		$nodes = $nodes['Admin']['child'];
		$actions = array();
		foreach ($nodes[$controller['name']]['child'] as $key => $value) {
			$actions[] = $key;
		}
		$list = M('node') -> where(array('pid' => $id, 'level' => 3)) -> select();
		$items = array();
		foreach ($list as $key => $value) {
			$items[] = $value['name'];
		}
		$items = array_diff($actions, $items);
		$this -> assign(array(
			'items' => $items,
			'list' => $list,
			'id' => $id,
			'pid' => $pid,
			'title' => $controller['title']
			));
		$this -> display();
	}

	public function addActionHandler()
	{
		$pid = I('post.pid');
		$gpid = I('post.gpid');
		$data = array(
			'name' => I('post.name'),
			'title' => I('post.title'),
			'status' => 1,
			'pid' => $pid,
			'level' => 3
			);
		if(M('node') -> add($data)){
			$this -> redirect('editAction', array('pid' => $gpid, 'id' => $pid));
		}else{
			$this -> error('操作失败！');
		}
	}

	public function editActionHandler()
	{
		$id = I('post.id');
		$pid = I('post.pid');
		$gpid = I('post.gpid');
		$data = array(
			'title' => I('post.title')
			);
		M('node') -> where(array('id' => $id)) -> save($data);
		$this -> redirect('editAction', array('pid' => $gpid, 'id' => $pid));
	}

	/*配置应用*/
	public function editApp()
	{
		// 获取有效应用
		$nodes = \Common\Lib\Rbac::getNodeList();
		$apps = array();
		foreach ($nodes as $key => $value) {
			$apps[] = $key;
		}
		// 获取已添加应用
		$list = M('node') -> where(array('pid' => 0, 'level' => 1)) -> select();
		$items = array();
		foreach ($list as $key => $value) {
			$items[] = $value['name'];
		}

		// 获取可添加应用
		$items = array_diff($apps, $items);
		$this -> assign(array(
			'items' => $items,
			'list' => $list
			));
		$this -> display();
	}

	public function addAppHandler()
	{
		$data = array(
			'name' => I('post.name'),
			'title' => I('post.title'),
			'status' => 1,
			'pid' => 0,
			'level' => 1
			);
		if(M('node') -> add($data)){
			$this -> redirect('editApp');
		}else{
			$this -> error('操作失败！');
		}
	}

	public function editAppHandler()
	{
		$id = I('post.id');
		$data = array(
			'title' => I('post.title')
			);
		M('node') -> where(array('id' => $id)) -> save($data);
		$this -> redirect('editApp');
	}

	public function delete()
	{
		$id = I('get.id',0);
		$pid = I('get.pid',0);
		$gpid = I('get.gpid',0);
		if($id){
			$nodes = M('node') -> field('id,pid') -> select();
			$nodes = array_get_suns($nodes, 'id', 'pid', $id);
			$nodes = array_get_values($nodes, 'id');
			$nodes[] = $id;
			M('node') -> where(array('id' => array('IN', $nodes))) -> delete();
		}
		if ($gpid) {
			$this -> redirect('editAction', array('pid' => $gpid, 'id' => $pid));
		}elseif ($pid) {
			$this -> redirect('editController', array('id' => $pid));
		}elseif ($id) {
			$this -> redirect('editApp');
		}else{
			$this -> redirect('listAll');
		}
	}
}
<?php
namespace Admin\Controller;
//use Think\Controller;
use Common\Lib\Controller;
class RoleController extends Controller {

	public function listAll()
	{
		$items = M('role') -> field('name,id,remark') -> select();
		$this -> assign(array(
			'items' => $items
			));
		$this -> display();
	}
	public function edit()
	{
		$id = I('get.id');
		$item = M('role') -> where(array('id' => $id)) -> find();
		$this -> assign(array(
			'id' => $id,
			'item' => $item
			));
		$this -> display();
	}

	public function editHandler()
	{
		$id = I('get.id');
		$data = array(
			'name' => I('post.name'),
			'remark' => I('post.remark'),
			'status' => I('post.status')
			);
		M('role') -> where(array('id' => $id)) -> save($data);
		$this -> redirect('listAll');
	}

	public function add()
	{
		$this -> display();
	}

	public function addHandler()
	{
		$name = I('post.name');
		$remark = I('post.remark');
		echo $remark;
		$status = I('post.status');
		if(!$name){
			$this -> error('角色名称为空！');
		}else{
			$data = array(
				'name' => $name,
				'remark' => $remark,
				'status' => $status
				);
			M('role') -> add($data);
			$this -> redirect('listAll');
		}
	}

	public function access()
	{
		$id = I('get.id');
		$remark = M('role') -> where(array('id' => $id)) -> getField('remark');
		$nodes = M('node') -> where(array('status' => 1)) -> select();
		$access = M('access') -> where(array('role_id' => I('get.id'))) -> getField('node_id', true);
		foreach ($nodes as $key => $value) {
			if(in_array($value['id'], $access)){
				$nodes[$key]['status'] = 1;
			}else{
				$nodes[$key]['status'] = 0;
			}
		}
		$nodes = node_arr_restructure($nodes);
		//dump($id);die;
		$this -> assign(array(
			'items' => $nodes,
			'id' => $id,
			'remark' => $remark,
			));
		$this -> display();
	}

	public function accessHandler()
	{
		$id = I('get.id');
		$nodes = I('post.node');
		//dump($id);die;
		$data = array();
		foreach ($nodes as $key => $value) {
			$data[] = array(
				'role_id' => $id,
				'node_id' => $value,
				'level' => 3
 				);
		}
		$Access = M('access');
		$Access -> where(array('role_id' => $id)) -> delete();
		$Access -> addAll($data);
		$this -> redirect('access', array('id' => $id));
	}
}
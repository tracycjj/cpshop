<?php

/**
 * 将一维的节点名称数组扩展成二维的节点数组
 * @param  array $arr   一维的节点名称数组
 * @param  int $level description
 * @return array        二维的节点数组
 */
function node_arr_extend($arr, $level)
{
	foreach ($arr as $key => $value) {
		$a['name'] = $value;
		$a['title'] = $value;
		$a['level'] = $level;
		$b[$value] = $a;
	}
	return $b;
}

/**
 * 递归重构节点数组，将二维的节点数组按id和pid的值层叠起来构成多维数组。
 * @param  array  $arr 原始数组
 * @param  [integer] $pid 父节点id
 * @return array       重构后的多维节点数组
 */
function node_arr_restructure($arr, $pid = 0)
{
	foreach ($arr as $key => $value) {
		if($value['pid'] == $pid){
			$value['child'] = node_arr_restructure($arr, $value['id']);
			if(is_null($value['child']))unset($value['child']);
			$a[$value['name']] = $value;
		}
	}
	return $a;
}

/**
 * 递归获取关联数组中隶属于某个节点的所有子节点。
 * @param  array $arr    关联数组
 * @param  string $sun    关联键中的子键名
 * @param  string $parent 关联键中的父键名
 * @param  string|number $id     当前节点的子键值
 * @return array         隶属于当前节点的所有子节点数组
 */
function array_get_suns($arr, $sun, $parent, $id)
{
	foreach ($arr as $key => $value) {
		if ($value[$parent]==$id) {
			$a[] = $value;
			$b = array_get_suns($arr, $sun, $parent, $value[$sun]);
			if(!is_null($b))$a = array_merge($a, $b);
		}
	}
	return $a;
}

/**
 * 将二维数组中的某个键的值取出来构成一个一维索引数组
 * @param  array $arr 二维数组
 * @param  string $key 键名
 * @return array 一维索引数组
 */
function array_get_values($arr, $key)
{
	$a = array();
	foreach ($arr as $v) {
		if(isset($v[$key])){
			$a[] = $v[$key];
		}
	}
	return $a;
}


function checked_pos($arr, $val)
{
	if(is_array($arr)){
		if(is_array($val)){
			$num = count($arr);
			for ($i=0; $i < $num; $i++) {
				if(in_array($arr[$i]['value'], $val))$a[] = $i;
			}
			return $a;
		}else if (!is_null($val)) {
			$num = count($arr);
			for ($i=0; $i < $num; $i++) {
				if($arr[$i]['value']===$val)return $i;
			}
		}
	}

}

//检查节点权限
function P($node)
{
	return \Common\Lib\Rbac::checkAuth($node);
}

?>
<?php
/*
*  -------------------------------------------------
*   @author		: bqq<506615054@qq.com>
*   @date		: 2013-09-05
*  -------------------------------------------------
*/
/*获取结果集中所有的数据*/
function getAll($sql) {
	$query=mysql_query($sql);
	if($query) {
		$temp=array();
		while($res=mysql_fetch_assoc($query)) {
			$temp[]=$res;
		}
		return $temp;
	}
	else{
		return false;
	}
}

/*获取一条数据*/
function getOne($sql) {
	$query=mysql_query($sql);
	if($query) {
		$res=mysql_fetch_assoc($query);
		return $res;
	}
	else{
		return false;
	}
}
?>
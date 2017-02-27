<?php
	//连接数据库
	mysql_connect('主机','账号','密码');//连接数据库
	mysql_select_db('数据库名');//选择数据库
	mysql_query('SET NAMES UTF8');//设置编码为utf8
	//连接数据库结束
	require_once 'function.php';//调用函数的功能
?>
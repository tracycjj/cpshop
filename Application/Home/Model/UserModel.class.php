<?php
namespace Home\Model;
use \Think\Model;
/**
* 
*/
class UserModel extends Model
{
	protected $_validate=array(
				array('username','','帐号名称已经存在！',0,'unique',1),
				array('password','require',"密码不能为空",0,'',1),
				array("email",'/[a-z0-9]{1,}@[a-z0-9]{2,}\.\w{3,}/','邮件格式错误',0,'regex',1)
				);

}
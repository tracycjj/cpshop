<?php
namespace Common\Lib;

/**
* RBAC类扩展补丁
* 修复了官方自带的RBAC类的部分不足，扩展了配置项设置。
* 1、修复了配置项分隔符认定方法。配置项中分隔符“,”号前后可含有空格，更符合英文书写习惯；
* 2、修正了配置项名称。将“REQUIRE_AUTH_MODULE”和“NOT_AUTH_MODULE”改为了“REQUIRE_AUTH_CONTROLLER”和“NOT_AUTH_CONTROLLER”；
* 3、添加了配置项“REQUIRE_AUTH_MODULE”和“NOT_AUTH_MODULE”。可用来配置模块的验证与排除；
* 4、添加了配置项“REQUIRE_AUTH_NODE”和“NOT_AUTH_NODE”。可用来配置指定的节点，节点内的模块、控制器和操作名称用“.”分隔；
* 5、添加了配置项“REQUIRE_AUTH_ACTION_REG”和“NOT_AUTH_ACTION_REG”。可用正则表达式来批量配置操作名；
* 6、添加了getNodeList函数，可用来获取需要验证的所有节点列表。
*/
class Rbac extends \Org\Util\Rbac
{


	//检查当前操作是否需要认证
	static function checkAccess() {
		//如果项目要求认证，并且当前模块需要认证，则进行权限认证
		if( C('USER_AUTH_ON') ){
			self::parseConfig($_module, $_controller, $_action, $_node, $_action_reg);
			//检查当前模块是否需要认证
			if(self::_checkModule(MODULE_NAME, $_module, $_node)){
				//检查当前控制器是否需要认证
				if (self::_checkController(CONTROLLER_NAME, $_controller, $_node, MODULE_NAME)) {
					//检查当前操作是否需要认证
					if(self::_checkAction(ACTION_NAME, $_action, $_action_reg, $_node, MODULE_NAME, CONTROLLER_NAME)){
						return true;
					}else {
						return false;
					}
				}else {
					return false;
				}
			}else{
				return false;
			}
		}
		return false;
	}

	/**
	 * 检查节点是否有操作权限
	 * @param  string $node 节点名称，节点中模型、控制器和操作之间用'/'隔开
	 * @return boolean 是否有操作权限
	 */
	static public function checkAuth($node){
		//如果项目要求认证，且当前用户非开发者，进行判断
		if( C('USER_AUTH_ON') && empty($_SESSION[C('ADMIN_AUTH_KEY')])){
			if (C('USER_AUTH_TYPE')==2) {
				//加强验证和即时验证模式 更加安全 后台权限修改可以即时生效
				//通过数据库进行访问检查
				$accessList = self::getAccessList($_SESSION[C('USER_AUTH_KEY')]);
			}else{
				//登录验证模式，比较登录后保存的权限访问列表
				$accessGuid = md5($node);
				if($_SESSION[$accessGuid]) {
                    return true;
                }
				$accessList = $_SESSION['_ACCESS_LIST'];
			}
			$nodes = explode('/',$node);
			$c= count($nodes);
			//解析配置参数
			self::parseConfig($_module, $_controller, $_action, $_node, $_action_reg);
			//检查当前模块是否需要认证
			$result = false;
			if(self::_checkModule($nodes[0], $_module, $_node)) {
				//dump($accessList);
				if(isset($accessList[strtoupper($nodes[0])])){
					if($c === 1){
						$result = true;
					}else{
						//检查当前控制器是否需要认证
						if(self::_checkController($nodes[1], $_controller, $_node, $nodes[0])){
							if(isset($accessList[strtoupper($nodes[0])][strtoupper($nodes[1])])){
								if($c===2){
									$result = true;
								}else{
									//检查当前操作是否需要认证
									if(self::_checkAction($nodes[2], $_action, $_action_reg, $_node, $nodes[0], $nodes[1])){
										if(isset($accessList[strtoupper($nodes[0])][strtoupper($nodes[1])][strtoupper($nodes[2])])){
											$result = true;
										}else{
											$result = false;
										}
									}else{//操作无需验证
										$result = true;
									}
								}
							}else{
								$result = false;
							}
						}else{//控制器无需验证
							$result = true;
						}
					}
				}else{
					$result = false;
				}
			}else{//模块无需验证
				$result = true;
			}
			return $result;
		}else{//项目无需验证或为管理员
			return true;
		}
	}

	/**
	 * 批量检查操作是否通过认证
	 * @param  mixed $nodes   操作节点（列表），节点中模型、控制器和操作之间用'/'隔开
	 * @return array         是否需要认证的布尔值列表，需要认证为true
	 */
	static public function checkActions($nodes) {
		//如果项目要求认证，且当前用户非开发者
		if( C('USER_AUTH_ON') && empty($_SESSION[C('ADMIN_AUTH_KEY')])){
			if (C('USER_AUTH_TYPE')==2) {
				//加强验证和即时验证模式 更加安全 后台权限修改可以即时生效
				//通过数据库进行访问检查
				$accessList = self::getAccessList($_SESSION[C('USER_AUTH_KEY')]);
			}else{
				//登录验证模式，比较登录后保存的权限访问列表
				$accessList = $_SESSION['_ACCESS_LIST'];
			}
			self::parseConfig($_module, $_controller, $_action, $_node, $_action_reg);
			$result = array();
			if(!is_array($nodes)){
				$nodes = (array)$nodes;
			}
			foreach ($nodes as $key => $value) {
				$node = explode('/', $value);
				//检查当前模块是否需要认证
				if(self::_checkModule($node[0], $_module, $_node)){
					//检查当前控制器是否需要认证
					if (self::_checkController($node[1], $_controller, $_node, $node[0])) {
						//检查当前操作是否需要认证
						if(self::_checkAction($node[2], $_action, $_action_reg, $_node, $node[0], $node[1])){
							if (isset($accessList[strtoupper($node[0])][strtoupper($node[1])][strtoupper($node[2])])) {
								$result[] = true;
							}else{
								$result[] = false;
							}
						}else {
							$result[] = true;
						}
					}else {
						$result[] = true;
					}
				}else{
					$result[] = true;
				}
			}
			if(count($result) === 1){
				return $result[0];
			}else{
				return $result;
			}
		}
		return array_fill(0, count($nodes), true);
	}


	static function parseConfig(&$_module, &$_controller, &$_action, &$_node, &$_action_reg)
	{
		$_module	 =  array();
		$_controller =	array();
		$_action	 =	array();
		$_node       =  array();
		$_action_reg['yes'] = C('REQUIRE_AUTH_ACTION_REG');
		$_action_reg['no'] = C('NOT_AUTH_ACTION_REG');
		//生成需验证节点和不需验证节点列表
		if("" != C('REQUIRE_AUTH_NODE')) {//需要认证的节点
			$_node['yes'] = explode(',', strtoupper(C('REQUIRE_AUTH_NODE')));
			array_walk($_node['yes'], function(& $value){
				$value = trim($value);
			});
		}else if("" != C('NOT_AUTH_NODE')) {//无需认证的节点
			$_node['no'] = explode(',', strtoupper(C('NOT_AUTH_NODE')));
			array_walk($_node['no'], function(& $value){
				$value = trim($value);
			});
		}
		if ("" != C('REQUIRE_AUTH_MODULE')) {
			//需要认证的模块
			$_module['yes'] = explode(',', strtoupper(C('REQUIRE_AUTH_MODULE')));
			array_walk($_module['yes'], function(& $value){
				$value = trim($value);
			});
		}else{
			//无需认证的模块
			$_module['no'] = explode(',', strtoupper(C('NOT_AUTH_MODULE')));
			array_walk($_module['no'], function(& $value){
				$value = trim($value);
			});
		}
		if("" != C('REQUIRE_AUTH_CONTROLLER')) {
			//需要认证的控制器
			$_controller['yes'] = explode(',', strtoupper(C('REQUIRE_AUTH_CONTROLLER')));
			array_walk($_controller['yes'], function(& $value){
				$value = trim($value);
			});
		}else {
			//无需认证的控制器
			$_controller['no'] = explode(',', strtoupper(C('NOT_AUTH_CONTROLLER')));
			array_walk($_controller['no'], function(& $value){
				$value = trim($value);
			});
		}
		if("" != C('REQUIRE_AUTH_ACTION')) {
			//需要认证的操作
			$_action['yes'] = explode(',', strtoupper(C('REQUIRE_AUTH_ACTION')));
			array_walk($_action['yes'], function(& $value){
				$value = trim($value);
			});
		}else {
			//无需认证的操作
			$_action['no'] = explode(',', strtoupper(C('NOT_AUTH_ACTION')));
			array_walk($_action['no'], function(& $value){
				$value = trim($value);
			});
		}

	}


	// 登录检查
	static public function checkLogin() {
        //检查当前操作是否需要认证
        if(self::checkAccess()) {
            //检查认证识别号
            if(!$_SESSION[C('USER_AUTH_KEY')]) {
                if(C('GUEST_AUTH_ON')) {
                    // 开启游客授权访问
                    if(!isset($_SESSION['_ACCESS_LIST']))
                        // 保存游客权限
                        self::saveAccessList(C('GUEST_AUTH_ID'));
                }else{
                    // 禁止游客访问跳转到认证网关
                    redirect(PHP_FILE.C('USER_AUTH_GATEWAY'));
                }
            }
        }
        return true;
	}

    //权限认证的过滤器方法
    static public function AccessDecision($appName=MODULE_NAME) {
        //检查是否需要认证
        if(self::checkAccess()) {
            //存在认证识别号，则进行进一步的访问决策
            $accessGuid   =   md5($appName.CONTROLLER_NAME.ACTION_NAME);
            if(empty($_SESSION[C('ADMIN_AUTH_KEY')])) {
                if(C('USER_AUTH_TYPE')==2) {
                    //加强验证和即时验证模式 更加安全 后台权限修改可以即时生效
                    //通过数据库进行访问检查
                    $accessList = self::getAccessList($_SESSION[C('USER_AUTH_KEY')]);
                }else {
                    // 如果是管理员或者当前操作已经认证过，无需再次认证
                    if( $_SESSION[$accessGuid]) {
                        return true;
                    }
                    //登录验证模式，比较登录后保存的权限访问列表
                    $accessList = $_SESSION['_ACCESS_LIST'];
                }
                //判断是否为组件化模式，如果是，验证其全模块名
                if(!isset($accessList[strtoupper($appName)][strtoupper(CONTROLLER_NAME)][strtoupper(ACTION_NAME)])) {
                    $_SESSION[$accessGuid]  =   false;
                    return false;
                }
                else {
                    $_SESSION[$accessGuid]	=	true;
                }
            }else{
                //管理员无需认证
				return true;
			}
        }
        return true;
    }

	/**
	 * 获取所有需要验证节点列表的关联数组
	 * @param  string $fileter 默认获取所有模块下的权限，设置该值将指定模块目录
	 * @return array          所有需要验证的节点列表
	 */
	static public function getNodeList($module_folder = null)
	{
		self::parseConfig($_module, $_controller, $_action, $_node, $_action_reg);
		if(is_null($module_folder)){
			$modulearr = array_diff(ls(APP_PATH, 'FOLDER'), array('Common', 'Runtime'));
		}else{
			$modulearr = explode(',', $module_folder);
			$modulearr = array_trim($modulearr);
			$modulearr = array_filter($modulearr);
		}
		$arr = array();
		foreach ($modulearr as $val) {
			if (self::_checkModule($val, $_module, $_node)) {
				$arr[] = $val;
			}
		}
		$controllerarr = $arr;
		unset($arr);
		$modulearr = node_arr_extend($modulearr, 1);
		foreach ($modulearr as $key => $value) {
			$controllerarr = ls(APP_PATH.'/'.$value['name'].'/'.'Controller', 'FILE', 'Controller.class.php');
			$controllerarr = str_ireplace('Controller.class.php', '', $controllerarr);
			$arr = array();
			foreach ($controllerarr as $val) {
				if(self::_checkController($val, $_controller, $_node, $value))$arr[] = $val;
			}
			$controllerarr = $arr;
			unset($arr);
			$controllerarr = node_arr_extend($controllerarr, 2);
			if(!is_null($controllerarr))$modulearr[$key]['child'] = $controllerarr;
			foreach ($controllerarr as $key1 => $value1) {
				$actionarr = array_diff(get_class_methods($value['name'].'\\'.'Controller'.'\\'.$value1['name'].'Controller'), get_class_methods('Think\Controller'));
				$arr = array();
				foreach ($actionarr as $val) {
					if(self::_checkAction($val, $_action, $_action_reg, $_node, $value, $value1)){
						$arr[] = $val;
					}
				}
				$actionarr = $arr;
				$actionarr = node_arr_extend($actionarr, 3);
				if(!is_null($actionarr))$modulearr[$key]['child'][$key1]['child'] = $actionarr;
			}
		}
		return $modulearr;
	}

	/**
	 * 检查操作是否需要验证
	 * @param  string $val         操作名
	 * @param  array $_action     需要验证或不需验证的操作配置列表
	 * @param  array $_action_reg 需要验证或不需验证的操作名应匹配的正则表达式
	 * @param  array $_node       指定的需要验证或不需验证的节点列表
	 * @param  string $module      当前模块名
	 * @param  string $controller  当前控制器名
	 * @return boolean              当前操作需要验证返回true
	 */
	static private function _checkAction($val, $_action, $_action_reg, $_node, $module, $controller)
	{
		$flag = true;
		if(empty($_action['no'])){
			if(!empty($_action['yes']) && !in_array(strtoupper($val), $_action['yes'])){
				$flag = false;
			}
		}elseif(in_array(strtoupper($val), $_action['no'])){
			$flag = false;
		}

		if($_action_reg['no'] && preg_match($_action_reg['no'], $val)){
			$flag = false;
		}
		if(!$flag && $_action_reg['yes'] && preg_match($_action_reg['no'], $val)){
			$flag = true;
		}

		if(!empty($_node['no']) && in_array(strtoupper($module.'.'.$controller.'.'.$val), $_node['no'])){
			$flag = false;
		}
		if(!$flag && !empty($_node['yes']) && in_array(strtoupper($module.'.'.$controller.'.'.$val), $_node['yes'])){
			$flag = true;
		}
		return $flag;
	}

	/**
	 * 检查控制器是否需要验证
	 * @param  string $val         控制器名
	 * @param  array $_controller 需验证或不需验证的控制器配置列表
	 * @param  array $_node       指定的需要验证或不需验证的节点列表
	 * @param  string $module      当前模块名
	 * @return boolean              当前控制器需要验证返回true
	 */
	static private function _checkController($val, $_controller, $_node, $module){
		$flag = true;
		if(empty($_controller['no'])){
			if(!empty($_controller['yse']) && !in_array(strtoupper($val), $_controller['yes'])){
				$flag = false;
			}
		}elseif (in_array(strtoupper($val), $_controller['no'])) {
			$flag = false;
		}

		if(!empty($_node['no']) && in_array(strtoupper($module.'.'.$val), $_node['no'])){
			$flag = false;
		}
		if(!$flag && !empty($_node['yes']) && in_array(strtoupper($module.'.'.$val), $_node['yes'])){
			$flag = true;
		}
		return $flag;
	}

	/**
	 * 检查模块是否需要验证
	 * @param  string $val     模块名
	 * @param  array $_module 需要验证或不需验证的模块配置列表
	 * @param  array $_node   需要验证或不需验证的节点配置列表
	 * @return boolean          当前模块需要验证返回true
	 */
	static private function _checkModule($val, $_module, $_node){
		$flag = true;
		if(empty($_module['no'])){
			if(!empty($_module['yes']) && !in_array($val, $_module['yes'])){
				$flag = false;
			}
		}elseif (in_array($val, $_module['no'])) {
			$flag = false;
		}

		if (!empty($_node['no']) && in_array(strtoupper($val), $_node['no'])) {
			$flag = false;
		}
		if (!empty($_node['yes']) && in_array(strtoupper($val), $_node['yes'])) {
			$flag = true;
		}
		return $flag;
	}

}



?>
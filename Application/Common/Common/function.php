<?php

/**
 * [ls 列出目录中所有文件或文件夹]
 * @param  [string] $dir  [目录路径，默认值为当前目录。]
 * @param  [string] $type [设定读取文件或文件夹的类型，
 * 可选 FILE|FOLDER|BOTH|ALL（只列出文件|只列出文件夹|列出两者|列出包括当前目录.
 * 和上级目录..在内的所有文件和文件夹）其中之一，默认值ALL]
 * @param  [string] $filter  [要过滤的后缀名，默认不过滤。后缀名前应包含分隔符.，
 * 若希望结果不包含某后缀名，可在后缀名前添加!号，如!.php表示在结果中不包含php文件]
 * @param  [int] $options  [pathinfo常量，1|2|4|8或者
 * PATHINFO_DIRNAME | PATHINFO_BASENAME | PATHINFO_EXTENSION | PATHINFO_FILENAME
 * （结尾不含斜线的目录名|含后缀名的文件名|文件后缀名|不含后缀名的文件名）]
 * @return boolean|array       成功执行则返回文件或文件夹名称的数组，否则返回false。
 */
function ls($dir = '.', $type = 'ALL', $filter = '', $options = '')
{
	$type = strtoupper($type);
	$arr = false;
	if ($dh = @opendir($dir)) {
		while (($file = readdir($dh))!==false) {
			if ($type == 'FILE' || $type == 'FOLDER' || $type == 'BOTH' and $file == '.' || $file == '..') continue;
			if(substr($dir, -1)=='/' ) $dir = substr($dir, 0, strlen($dir)-1);
			if ($type == 'FILE' && is_dir($dir.'/'.$file) or $type == 'FOLDER' && !is_dir($dir.'/'.$file) ) continue;
			if ( !!$filter and is_file($dir.'/'.$file) and $type != 'FOLDER') {
				if (substr($filter, 0, 1)=='!') {
					if (strtolower(substr($filter, 1)) == strtolower(substr($file, -(strlen($filter) - 1)))) continue;
				}else{
					if (strtolower($filter) != strtolower(substr($file, -strlen($filter)))) continue;
				}
			}
			if (!!$options)$file = pathinfo($file, $options);
			$arr[] = mb_convert_encoding($file, 'UTF-8', 'UTF-8, ASCII, GBK, GB2312, BIG5, JIS, eucjp-win, sjis-win, EUC-JP');
		}
		closedir($dh);
		return $arr;
	}else{
		return false;
	}
}

/**
 * 去掉数组中字符串的首尾空格
 * @param  array $arr 输入数组
 * @return array 去掉空格后的数组
 */
function array_trim($arr){
    if (!is_array($arr))
        return trim($arr);
    return array_map('array_trim', $arr);
}

/**
 * 生成20位订单号
 * @return string 20位字符串
 */
function create_sn()
{
	return date('Ymdhis') . str_pad(mt_rand(1, 999999), 6, '0', STR_PAD_LEFT);
}

/**
 * 交换二维数组中的某个值作为数组的键值
 * @param  array $arr 二维数组
 * @param  string $item 指定作为键值的字段
 * @param  mixed $fields 欲保留的字段，默认保留所有字段，可以是数组和用英文逗号分隔的字符串
 * @return array 新的数组
 */
function array_flip_2d($arr, $item, $fields)
{
	$a = array();
	if (empty($fields)) {
		$fields = array();
	}elseif (is_string($fields)) {
		$fields = explode(',', $fields);
	}
	if (!empty($arr) && is_array($arr)) {
		foreach ($arr as $key => $value) {
			if (empty($fields)) {
				$a[$value[$item]] = $value;
			}elseif (count($fields) === 1) {
				$a[$value[$item]] = $value[$fields[0]];
			}else{
				$fields = array_flip($fields);
				$a[$value[$item]] = array_intersect_key($value, $fields);
			}
		}
	}
	return $a;
}

/**
 * 取出二维数组中的某个键，新结果以一维数组的方式返回
 * @param  array $arr   二维数组
 * @param  string $field 欲取出的字段
 * @return array 结果
 */
function array_value($arr, $field)
{
	$a = array();
	foreach ($arr as $value) {
		$a[] = $value[$field];
	}
	return $a;
}

/**
 * 图片上传函数，图片将上传至`上传根目录/上传路径/上传图片分类/年月日/年月日时分秒_随机数.图片类型`
 * @param  string $img  图片字段名称
 * @param  string $path 上传路径
 * @param  string $type 上传图片分类
 * @return array
 * 	        code $integer 图片状态码：0-成功|1-图片传输错误|2-图片大小超过限制|3-文件格式不支持|4-上传根目录不存在|5-文件拷贝失败检查上传目录的写权限
 * 	        url $string 图片成功上传后的地址或者null值
 */
function upload_img($img = 'icon', $path, $type)
{
	$save_path = realpath(dirname($_SERVER["SCRIPT_FILENAME"]) . '/' . C('UPLOAD_FOLDER')) . '/';
	$save_url  = __ROOT__ . '/' . C('UPLOAD_FOLDER') . '/';
	if ($_FILES[$img]["error"] > 0){//图片传输错误
		$code = 1;
	}else{
		$file_size = $_FILES[$img]['size'];
		if ($file_size > 600 * 1024) {//图片尺寸大小超过限制//600K
			$code = 2;
		}else{
			//允许的文件类型
			$_type = array('gif', 'jpg', 'jpeg', 'png', 'bmp');
			//服务器上临时文件名
			$tmp_name = $_FILES[$img]['tmp_name'];
			//原始文件名
			$file_name = $_FILES[$img]['name'];
			//获得文件扩展名
			$temp_arr = explode(".", $file_name);
			$file_ext = array_pop($temp_arr);
			$file_ext = strtolower(trim($file_ext));
			if(!in_array($file_ext, $_type)){//图片类型不支持
				$code = 3;
			}else{
				if (@is_dir($save_path) === false) {
					$code = 4;//上传根目录不存在
				}else{
					$path = trim(str_replace('\\', '/', $path), '/');
					if($path){
						$save_path .= $path.'/';
						$save_url .= $path.'/';
						if (@is_dir($save_path) === false) {
							mkdir($save_path);
						}
					}
					$type = trim(str_replace('\\', '/', $type), '/');
					if($type){
						$save_path .= $type.'/';
						$save_url .= $type.'/';
						if (@is_dir($save_path) === false) {
							mkdir($save_path);
						}
					}
					$ymd = date("Ymd");
					$save_path .= $ymd . '/';
					$save_url .= $ymd . '/';
					if (@is_dir($save_path) === false) {
						mkdir($save_path);
					}
					//新文件名
					$new_file_name = date("YmdHis") . '_' . rand(10000, 99999) . '.' . $file_ext;
					//移动文件
					$file_path = $save_path . $new_file_name;
					if (move_uploaded_file($tmp_name, $file_path) === false) {
						$code = 5;//文件拷贝失败
					}else{//文件移动成功
						@chmod($file_path, 0644);
						$file_url = $save_url . $new_file_name;
						return array(
							'code' => 0,
							'url' => $file_url
							);
					}
				}
			}
		}
		return array(
			'code' => $code,
			'url' => null
			);
	}
}
function gerPicError(){
	$data = array(
		1=>60003,
		2=>45001,
		3=>43004,
		4=>46003,
		5=>60001,
		);
	return $data;
}


/**
 * 写日志文件
 * @author chick 2015-10-14
 * @param  mixed $data 要写的数据
 */
function log_()
{
	$args  = func_get_args();
	$name  = func_arg_names();
	$debug = debug_backtrace();
	$user_IP = ($_SERVER["HTTP_VIA"]) ? $_SERVER["HTTP_X_FORWARDED_FOR"] : $_SERVER["REMOTE_ADDR"];
	$user_IP = ($user_IP) ? $user_IP : $_SERVER["REMOTE_ADDR"];
	
	$data_  = "\n【".date('Y-m-d H:i:s',time())."】:\n";
	$data_ .= "\n[----------------DEBUG----------------]\n";
	$data_ .= "\n[USER_IP]   ".$user_IP;
	$data_ .= "\n[CLASS]     ".$debug['1']['class'];
	$data_ .= "\n[FUNCTION]  ".$debug['1']['function'];
	$data_ .= "\n[LINE]      ".$debug['1']['line'];
	unset($debug);
	if ($_GET) {
		$data_ .= "\n\n[----------------GET----------------]\n\n";
		$data_ .= var_export($_GET,ture);
	}
	if ($_POST) {
		$data_ .= "\n\n[----------------POST----------------]\n\n";
		$data_ .= var_export($_POST,ture);
	}
	if (count($args)) {
		$data_ .= "\n\n[----------------DATA----------------]\n";
		foreach ($args as $k => $v) {
			$data_ .= "\n[".$name[$k]."]:\n";
			$data_ .= var_export($v,ture);
			$data_ .= "\n-----------------------------------------------";
		}
	}
	$data_ .= "\n==========================================================================\n";
	$fp = fopen('./log_log', 'a+');
	fwrite($fp, $data_);
	fclose($fp);
}
//截取中文字符串
function mysubstr($str,$start,$end){
	$str=htmlspecialchars_decode($str);
	$str=mb_strimwidth($str,$start,$end,'...','utf8');
	return $str;
}

?>
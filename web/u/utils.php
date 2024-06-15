<?php

/** $Id: utils.php 2556 2023-11-17 06:09:40Z zhangxh $ */

// 验证 FORM 有效性
function validate($conf = array(), $data = array())
{
  $data = empty($data) ? $_POST : $data;
  $err = array();

  if (empty($data) || empty($conf))
    return $err;
  foreach ($conf as $key => $val) {
    $rules = explode('|', $val);
    foreach ($rules as $rule) {
      switch ($rule) {
        case 'required':
          if (!isset($data[$key]) || !$data[$key])
            $err[$key] = "不能为空";
          break;
        case 'numonly':
          if (!isset($data[$key]) || !is_numeric($data[$key]))
            $err[$key] = "只能是数字";
          break;
        case 'email':
          if (!isset($data[$key]) || !is_email($data[$key]))
            $err[$key] = "email地址错误";
          break;
        default:
          if (!function_exists($rule))
            exit('Validate function ' . $rule . '  does exist');
          $res = $rule($data[$key]);
          if ($res !== true)
            $err[$key] = $res;
      }

      if (isset($err[$key]) && sizeof($err[$key]) > 0)
        break;
    }
  }

  if (sizeof($err) > 0)
    return $err;
  return true;
}

// 跳转函数
// $sec zhangxinghua 停留时间
function redirect($url, $msg = '', $ext_msg = '', $sec = 0) //跳转
{
  if ($sec == 0) {
    header("location: $url");
    exit();
  }

  $param = array(
    'url' => $url,
    'msg' => $msg,
    'ext_msg' => $ext_msg,
    'sec' => $sec
  );
  view('v/redirect', $param);
  exit();
}

// 生成 select options
function select_option($list, $active = false) // 利用数组 生成 selecct 的 Opitons
{
  $out = "";
  foreach ($list as $k => $v) {
    $out .= "<option value='$k'" . ($k == $active ? 'selected ' : '') . ">$v</option>\n";
  }
  return $out;
}

function select_option2($klist, $vlist, $active = false) // 利用数组 生成 selecct 的 Opitons
{
  $out = "";
  $cnt = min(count($klist), count($vlist));
  for ($i = 0; $i < $cnt; $i++) {
    $k = $klist[$i];
    $v = $vlist[$i];
    $out .= "<option value='$k'" . ($k == $active ? 'selected ' : '') . ">$v</option>\n";
  }
  return $out;
}

// 显示更加友好的日期
function __time($then) // 格式化时间 例如 ： 10分钟钱
{
  $now = time();
  $time = intval(($now - $then) / 60);
  if ($time > 0) {
    if ($time < 60)
      return "$time 分钟前";
    else {
      $time = intval($time / 60);
      if ($time < 12)
        return "$time 小时前";
    }
  }
  return date('Y-m-d', $then);
}

// 生成任意字符串
function randstr($n = 8) // 生成随机字符串
{
  $str = '0123456789abcdefghijklmnopqrstuvwxyz';
  $s = '';
  $len = strlen($str) - 1;
  for ($i = 0; $i < $n; $i++) {
    $s .= $str[rand(0, $len)];
  }
  return $s;
}

// 生成任意字符串
function strcmpcnt($s1, $s2) // 生成随机字符串
{
  $len1 = strlen($s1);
  $len2 = strlen($s2);
  $cnt = 0;

  if (strcmp($s1, $s2) == 0) {
    return 0;
  }

  for ($i = 0; $i < $len1 && $i < $len2; $i++) {
    if ($s1[$i] == $s2[$i]) continue;

    $cnt++;
  }
  $cnt += abs($len1 - $len2);
  return $cnt;
}

function array_to_ini($arr, &$out)
{
  foreach ($arr as $c => $d) {
    if (is_array($d)) {
      $out .= "[$c]\r\n";
      $out .= array_to_ini($d, $out);
    } else {
      if ($d === intval($d)) {
        $out .= "$c=$d\r\n";
      } else {
        $out .= "$c=\"$d\"\r\n";
      }
    }
  }
}

// 保存数组到ini
function save_ini_file($arr, $file)
{
  $str = "";
  array_to_ini($arr, $str);
  //print_object($str);

  $ffl = @fopen($file, "w");
  @fwrite($ffl, $str);
  @fclose($ffl);
}

// 切断 utf8 代码辅助
function utf8_trim($str) // 用于 substr utf8 时截去最后的乱码
{
  $hex = '';
  $len = strlen($str);
  for ($i = strlen($str) - 1; $i >= 0; $i -= 1) {
    $hex .= ord($str[$i]);
    $ch = ord($str[$i]);
    if (($ch & 128) == 0)
      return (substr($str, 0, $i));
    if (($ch & 192) == 192)
      return (substr($str, 0, $i));
  }
  return ($str . $hex);
}

// 验证 email
function is_email($email)
{
  return preg_match(
    '|^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]{2,})+$|i',
    $email
  );
}

// 文件缓存
function cache_start($time = 0)
{
  global $uri;
  $file = APP . 'cache/' . md5($uri);
  if ($time && is_file($file) && filemtime($file) > time() - $time) {
    $fp = fopen($file, 'rb');
    fpassthru($fp);
    exit;
  }
}

function cache_end()
{
  global $uri;
  $file = APP . 'cache/' . md5($uri);
  $buffer = ob_get_contents();
  file_put_contents($file, $buffer);
}

function dir_delete($directory)
{
  if (!file_exists($directory)) {
    return;
  }

  if ($dir_handle = @opendir($directory)) {
    while ($filename = readdir($dir_handle)) {
      if ($filename != '.' && $filename != '..') {
        $subFile = $directory . "/" . $filename;
        if (is_dir($subFile)) {
          dir_delete($subFile);
        }
        if (is_file($subFile)) {
          unlink($subFile); //直接删除这个文件
        }
      }
    }

    closedir($dir_handle);
    rmdir($directory);
  }
}

function dir_clean($dir)
{
  echo "dir_clean--$dir<br>";
  //$dir = APP . 'cache';
  if (strtoupper(substr(PHP_OS, 0, 3)) == 'WIN') {
    $str = "rmdir /s /q " . $dir;
  } else {
    $str = "rm -Rf " . $dir;
  }
  exec($str);
}

function cache_clean()
{
  $dir = APP . 'cache';
  dir_clean($dir);
  mkdir($dir);
}

function md5s($str) //short version of md5
{
  return substr(md5($str), 8, 16);
}

function browser()
{
  $agent = $_SERVER["HTTP_USER_AGENT"];
  if (strpos($agent, "Chrome"))
    return "html5";
  return "html4";
}

function json_encode_ex($value)
{
  if (version_compare(PHP_VERSION, '5.4.0', '<')) {
    $str = json_encode($value);
    $str = preg_replace_callback(
      "#\\\u([0-9a-f]{4})#i",
      function ($matchs) {
        return iconv('UCS-2BE', 'UTF-8', pack('H4', $matchs[1]));
      },
      $str
    );
    return $str;
  }
  return json_encode($value, JSON_UNESCAPED_UNICODE);
}

function utf2gbk($str)
{
  $str = mb_convert_encoding($str, 'utf-8', 'gbk');
  return $str;
}

function gbk2utf($str)
{
  $str = mb_convert_encoding($str, 'gbk', 'utf-8');
  return $str;
}

function retrieve($name)
{
  $pos = strrchr($name, '.');
  //die;
  //$pos = substr(strrchr($name, '.'), 1);
  $result = basename($name, $pos);

  return $name;
}

function security_replace($str)
{
  $str = str_ireplace('select', 'selec_', $str);
  $str = str_ireplace('update', 'updad_', $str);
  $str = str_ireplace('insert', 'inser_', $str);
  $str = str_ireplace('delete', 'delet_', $str);
  $str = str_ireplace('alter',  'alte_)',  $str);
  $str = str_ireplace('drop',   'dro_)',   $str);
  $str = str_ireplace(';',   '_',   $str);
  $str = str_ireplace('#',   '_',   $str);

  return $str;
}

function isMobile()
{
  // 如果有HTTP_X_WAP_PROFILE则一定是移动设备
  if (isset($_SERVER['HTTP_X_WAP_PROFILE'])) {
    return TRUE;
  }
  // 如果via信息含有wap则一定是移动设备,部分服务商会屏蔽该信息
  if (isset($_SERVER['HTTP_VIA'])) {
    return stristr($_SERVER['HTTP_VIA'], "wap") ? TRUE : FALSE; // 找不到为flase,否则为TRUE
  }
  // 判断手机发送的客户端标志,兼容性有待提高
  if (isset($_SERVER['HTTP_USER_AGENT'])) {
    $clientkeywords = array(
      'mobile',
      'nokia',
      'sony',
      'ericsson',
      'mot',
      'samsung',
      'htc',
      'sgh',
      'lg',
      'sharp',
      'sie-',
      'philips',
      'panasonic',
      'alcatel',
      'lenovo',
      'iphone',
      'ipod',
      'blackberry',
      'meizu',
      'android',
      'netfront',
      'symbian',
      'ucweb',
      'windowsce',
      'palm',
      'operamini',
      'operamobi',
      'openwave',
      'nexusone',
      'cldc',
      'midp',
      'wap'
    );
    // 从HTTP_USER_AGENT中查找手机浏览器的关键字
    if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT']))) {
      return TRUE;
    }
  }
  if (isset($_SERVER['HTTP_ACCEPT'])) { // 协议法，因为有可能不准确，放到最后判断
    // 如果只支持wml并且不支持html那一定是移动设备
    // 如果支持wml和html但是wml在html之前则是移动设备
    if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== FALSE) &&
      (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === FALSE ||
        (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html')))
    ) {
      return TRUE;
    }
  }
  return FALSE;
}
